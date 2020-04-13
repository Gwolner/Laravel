<!-- Create é o nome do método que exibe esta view -->

@extends('admin.layouts.template')

@section('title', 'Cadastrar novo produto')


@section('content')
    <h1>Cadastrar Novo produto</h1>

    <form action="{{ route('products.update', $id) }}" method="post">
         <!-- Envia o token para este caso de alidação do próprio Laravel!! -->
        <!-- <input type="text" name="_token" value="{{ csrf_token() }}"> -->
        <!-- Ou pode-se usar apenas a diretiva abaixo: -->
        @csrf
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <button type="submit">Enviar</button>
    </form>

@endsection