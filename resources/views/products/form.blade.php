<!-- Incluindo o template -->
@extends('layouts.app')
<!-- Função section do blade, é aqui que entra o conteúdo personalizado da página -->
@section('content')

<section class="container d-flex flex-column">
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="pb-2">Cadastro de produto</h2>
            <form action="/produtos/cadastrar" method="POST" enctype="multipart/form-data">
                <!-- Token de segurança do Laravel para forms. Deve ser colocado em todos os forms. -->
                @csrf
                    <label class="pt-2" for="nameProductId">Nome do produto</label>
                    <input class="form-control" type="text" name="nameProduct" id="nameProductId">
                    <label class="pt-2" for="descriptionProductId">Descrição</label>
                    <input class="form-control" type="text" name="descriptionProduct" id="descriptionProductId">
                    <label class="pt-2" for="quantityProductId">Quantidade</label>
                    <input class="form-control" type="number" name="quantityProduct" id="quantityProductId">
                    <label class="pt-2" for="priceProductId">Preço</label>
                    <input class="form-control" type="number" step="0.01" name="priceProduct" id="priceProductId">
                    <label class="pt-2 w-100" for="imageProductId">Imagem</label>
                    <input type="file" name="imageProduct" id="imageProductId">
                    <button class="btn btn-success w-100 mt-4" type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
        <!-- Verificando se a variável $result existe -->
        @if(isset($result))
            <!-- Verificando se a variável result é verdadeira -->
            @if($result)
                <h1>Fechou, deu certo.</h1>
            @else
                <h1>Ferrou, não deu certo.</h1>
            @endif
        @endif
        </div>
    </div>
</section>

<!-- Aqui encerro meu conteúdo personalizado. -->
@endsection