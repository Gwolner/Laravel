<!-- Create é o nome do método que exibe esta view -->

@extends('admin.layouts.template')

@section('title', 'Cadastrar novo produto')


@section('content')
    <h1>Cadastrar Novo produto</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        <!-- Envia o token para este caso de alidação do próprio Laravel!! -->
        <!-- <input type="text" name="_token" value="{{ csrf_token() }}"> -->
        <!-- Ou pode-se usar apenas a diretiva abaixo: -->
        @csrf
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <input type="file" name="photo">
        <button type="submit">Enviar</button>
    </form>

@endsection