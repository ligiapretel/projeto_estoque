<!-- Incluindo o template -->
@extends('layouts.app')
<!-- Função section do blade, é aqui que entra o conteúdo personalizado da página -->
@section('content')

<section class="container">
    <div class="row">
        <div class="col-12">
            <h2>Produtos</h2>
        </div>
        <div class="col-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Criado em</th>
                    <th scope="col">Atualizado em</th>
                    <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listProducts as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>R$ {{$product->price}}</td>
                        <td>{{$product->user->name}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                        <td>
                            <a class="btn btn-success" href="/produtos/atualizar/{{$product->id}}">Editar</a>
                            <a class="btn btn-danger" href="/produtos/deletar/{{$product->id}}">Deletar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Aqui encerro meu conteúdo personalizado. -->
@endsection