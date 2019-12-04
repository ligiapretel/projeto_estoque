<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Criando função para redirecionar para o Google ao fazer o login
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function receiveDataGoogle(){
        $userGoogle = Socialite::driver('google')->user();
        $userDb = $this->findOrCreate($userGoogle);

        // Login do usuário que veio do BD, coloco true como seundo parâmetro para que ele fique logado.
        Auth::login($userDb, true);

        return redirect($this->redirectTo);
    }

    // Função para achar ou criar um usuário. No parâmetro vou passar o dado do Google para procurar no meu BD se aquele usuário já existe
    public function findOrCreate($userGoogle){
        // where - verifico dois dados no BD, o campo da tabela e o que estou recebendo do Google. O where traz uma lista de objetos que atendem essa condição. Com o first limito a um registro.
        // first - para retornar o primeiro registrp que estiver no banco.
        $user=User::where('email',$userGoogle->email)->first();

        if($user){
            return $user;
        }

        // Caso seja falso, cria o usuário
        $newUser = new User();
        // Depois da seta do newUser coloco o nome da tabela no BD
        $newUser->name = $userGoogle->name;
        $newUser->email = $userGoogle->email;
        $newUser->img_profile = $userGoogle->avatar;
        $newUser->provider_id = $userGoogle->id;
        $newUser->active = 1;
        // Salvando usuario no BD]
        $newUser->save();

        return $newUser;

    }
}
