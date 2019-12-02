<!-- Incluindo o template -->
@extends('layouts.app')
<!-- Função section do blade, é aqui que entra o conteúdo personalizado da página -->
@section('content')

<section class="container d-flex flex-column">
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="pb-2">Atualização de produto</h2>
            <!-- Se existir produto sendo passado pelo parâmetro, ele abre o formulário com os dados do produto a ser atualizado -->
            @if(isset($product))
                <form action="/produtos/atualizar" method="POST" enctype="multipart/form-data">
                    <!-- Token de segurança do Laravel para forms. Deve ser colocado em todos os forms. -->
                    @csrf
                        <input type="text" name="idProduct" value="{{$product->id}}" hidden>
                        <label class="pt-2" for="nameProductId">Nome do produto</label>
                        <input class="form-control" type="text" name="nameProduct" id="nameProductId" value="{{$product->name}}">
                        <label class="pt-2" for="descriptionProductId">Descrição</label>
                        <input class="form-control" type="text" name="descriptionProduct" id="descriptionProductId" value="{{$product->description}}">
                        <label class="pt-2" for="quantityProductId">Quantidade</label>
                        <input class="form-control" type="number" name="quantityProduct" id="quantityProductId" value="{{$product->quantity}}">
                        <label class="pt-2" for="priceProductId">Preço</label>
                        <input class="form-control" type="number" step="0.01" name="priceProduct" id="priceProductId" value="{{$product->price}}">
                        <label class="pt-2 w-100" for="imageProductId">Imagem</label>
                        <input type="file" name="imageProduct" id="imageProductId">
                        <button class="btn btn-success w-100 mt-4" type="submit">Salvar alterações</button>
                </form>
                <!-- Se a variável result existe, eu não exibirei esse formulário, e trato esse resultado mais abaixo -->
                @elseif(isset($result))
                @else
                    <h3 class="pb-2">Você não selecionou nenhum produto.</h3>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
        <!-- Verificando se a variável $result existe -->
        @if(isset($result))
            <!-- Verificando se a variável result é verdadeira -->
            @if($result)
                <h1>Produto atualizado com sucesso.</h1>
            @else
                <h1>Atualização não deu certo.</h1>
            @endif
        @endif
        </div>
    </div>
</section>

<!-- Aqui encerro meu conteúdo personalizado. -->
@endsection