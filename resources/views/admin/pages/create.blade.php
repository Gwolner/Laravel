<!-- Create é o nome do método que exibe esta view -->

@extends('admin.layouts.template')

@section('title', 'Cadastrar novo produto')


@section('content')
    <h1>Cadastrar Novo produto</h1>

    <form class="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        <!-- Envia o token para este caso de alidação do próprio Laravel!! -->
        <!-- <input type="text" name="_token" value="{{ csrf_token() }}"> -->
        <!-- Ou pode-se usar apenas a diretiva abaixo: -->
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Nome:">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="description" placeholder="Descrição:">
        </div>
        <div class="form-group">
            <input class="form-control" type="file" name="photo">
        </div>
        <div class="form-group"></div>
        <button class="btn btn-success" type="submit">Enviar</button>
    </form>

@endsection