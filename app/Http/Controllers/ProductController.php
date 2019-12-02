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

        return view('products.formRegister',['result'=>$result]);

    }

    // Nome da função como index: é comum no mercado, e o dev sabe que é a primeira função a ser realizada, e normalmente exibe uma view. A equipe escolhe se terá o padrão index ou se terá um nome mais específico. Nesse caso vou preferir usar como viewFormProduct, e comento a função chamada index.
    // public function index(){

    // }

    public function viewFormProduct(Request $request){
        // Aqui em vez da barra, uso . para indicar subpastas, já que o arquivo não está na raiz views.
        return view('products.formRegister');
    }

    // No parâmetro, passo um id=0, pois caso o usuário não tenha passado esse parâmetro, ele assume que id é igual a 0
    public function viewFormUpdate(Request $request, $id=0){
        // Dentro do () do find estou recuperando o que veio pela rota
        $product = Product::find($id);
        if($product){
            // Passar um array associativo como parâmetro da view: primeiro o nome da associação, que pode ser qualquer nome, e depois a variável aonde armazenei o esse parâmetro.
            return view('products.formUpdate',["product"=>$product]);
        }else{
            return view('products.formUpdate');
        }
    }

    // Toda rota gera um objeto do tipo request, então preciso recebê-lo na função e dar um nome para ela
    public function update(Request $request){
        // Para atualizar devemos buscar um objeto ao invés de criar.
        // Devemos usar o método find($idProduto)
        // Será necessário usar rotas como parâmetro

        // No find, o request traz tudo que foi enviado pelo usuário, então seleciono a informação pelo nome do atributo - igual ao que está no form    
        $product = Product::find($request->idProduct);
        $product->name = $request->nameProduct;
        $product->description = $request->descriptionProduct;
        $product->quantity = $request->quantityProduct;
        $product->price = $request->priceProduct;

        // O result é um booleano, então coloco como parâmetro da view para que a view exiba a informação de acordo com o booleano.
        $result = $product->save();

        return view('products.formUpdate',["result"=>$result]);
    }

    public function deleteProduct(Request $request, $id=0){
        // Para deletar, usar Product::destroy($idProduto)
        $result = Product::destroy($id);
        if($result){
            return redirect('/produtos');
        }
    }

    public function viewAllProducts(Request $request){
        // Usar Product::All
        $listProducts = Product::all();
        return view('products.products',["listProducts"=>$listProducts]);
    }

    // public function viewOneProducts(Request $request)
    // // Usar Product::find($idProduto)
    // }
}
