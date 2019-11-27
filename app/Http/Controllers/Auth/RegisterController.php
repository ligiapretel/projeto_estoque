<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // Validações no campo do formulário, gerando mensagens de erro ao usuário
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // No controle do registro tenho que adicionar os outros campos
    protected function create(array $data)
    {
        // Para salvar a imagem do perfil de usuário. Normalmente criamos uma regra via artisan que libera o acesso a pasta storage a outros usuários (como se fosse pública, já que o uusário precisará acessar a imagem de perfil dele). Por padrão, o Laravel salva as imagens na pasta storage.
        $nomeArquivo = $data['imgProfile']->getClientOriginalName();
        // Não preciso especificar a pasta app e public, o Laravel já entende que é a única pasta que posso acessar
        $caminhoImg = "storage/profile/$nomeArquivo";
        // No storeAs - funçaõ para salvar na storage - preciso passar aonde vou salvar e o nome do meu caminho. Aqui preciso especificar o caminho usando o public.
        $resultado = $data['imgProfile']->storeAs('public/profile',$nomeArquivo);
        
        // dd($data['imgProfile']->getClientSize());

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // Salvo no BD o caminho da imagem que criei mais acima
            'img_profile' => $caminhoImg,
            'active' => 1
        ]);
    }
}
