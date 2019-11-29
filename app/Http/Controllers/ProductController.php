<?php

// Substitui o include e permite que eu utilize o use para incluir em outro arquivo.
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Importando o model User
use App\User;
// Importando o model Product
use App\Product;

// use Auth;

class ProductController extends Controller
{
    // Toda vez que usamos rotas, passamos dados por request. O Request do Laravel armazena todas as informações passadas pela superglobal
    public function create(Request $request){
        // // Verificando de que forma estou recebendo o dado
        // if($request->isMethod('GET')){
        //     return view('formulario');
        // }else{
        //     // Faço o cadastro do produto
        // }
        // Os dados enviados pelo formulário viram atributos dentro do objeto $request. Sendo assim, acesso chamando o $request->name_do_input 
        // dd($request->nameProduct);

        $newProduct = new Product();
        // objeto->nome_do_campo_da_tabela = $request->name_do_input
        $newProduct->name = $request->nameProduct;
        $newProduct->description = $request->descriptionProduct;
        $newProduct->quantity = $request->quantityProduct;
        $newProduct->price = $request->priceProduct;
        // Classe Auth é uma classe global, e toda vez que alguém loga o Laravel gera um objeto e armazena todos os dados do usuário na classe user.
        $newProduct->user_id = Auth()->user()->id;
        // Para usar a sintaxe abaixo, com :: após o Auth, preciso colocar use Auth lá no topo
        // $newProduct->user_id = Auth::user()->id;
        // A imagem do produto não está salvo na tabela products no BD, então não preciso passar ela aqui

        // Save - método pronto do Laravel que faz a inserção de dados na tabela
        $result = $newProduct->save();

        // if($result){
        //     echo "Deu certo";
        // }else{
        //     echo "Lascou, deu ruim";
        // }

        return view('products.form',['result'=>$result]);

    }

    // Nome da função como index: é comum no mercado, e o dev sabe que é a primeira função a ser realizada, e normalmente exibe uma view. A equipe escolhe se terá o padrão index ou se terá um nome mais específico. Nesse caso vou preferir usar como viewFormProduct, e comento a função chamada index.
    // public function index(){

    // }

    public function viewFormProduct(Request $request){
        // Aqui em vez da barra, uso . para indicar subpastas, já que o arquivo não está na raiz views.
        return view('products.form');
    }

    public function update(Request $request){
        // Para atualizar devemos buscar um objeto ao invés de criar.
        // Devemos usar o método find($idProduto)
        // Será necessário usar rotas como parâmetro

        $newProduct = Product::find(3);
        $newProduct->name = $request->nameProduct;
        $newProduct->description = $request->descriptionProduct;
        $newProduct->quantity = $request->quantityProduct;
        $newProduct->price = $request->priceProduct;
        $newProduct->user_id = Auth()->user()->id;
    }

    // public function delete(Request $request)
    //     // Para deletar, usar Product::destroy($idProduto)
    // }

    // public function viewAllProducts(Request $request)
    //     // Usar Product::All
    // }

    // public function viewOneProducts(Request $request)
    // // Usar Product::find($idProduto)
    // }
}
