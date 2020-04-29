<!-- Diretiva extends -->
@extends('admin.layouts.template')

<!-- Diretiva section  sem fechamento -->
@section('title','Gestão de produtos')

<!-- Diretiva section com fechamento  -->
@section('content')
<h1>EXIBINDO OS PRODUTOS</h1>

<a href="{{ route('products.create') }}" class="btn btn-primary">Cadastrar</a>

<form action="{{ route('products.search') }}" method="post" class="form form-inline">
    @csrf
    <input type="text" name="filter"  placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
    <button type="submit" class="btn btn-info">Pesquisar</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th width="100">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $item)
            <tr>
                <td>
                    @if($item->image)
                        <img src='{{ url("storage/{$item->image}") }}' alt="{{ $item->image }}" style="max-width: 100px;"> 
                    @else
                        TOTORO
                    @endif
                </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    <a href="{{ route('products.edit', $item->id) }}">Editar</a>
                    <a href="{{ route('products.show', $item->id) }}">Detalhes</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if(isset($filters))
    {!! $products->appends($filters)->links() !!}
@else
    {!! $products->links() !!}
@endif




{{-- 
    @component('admin.components.card')
        @slot('title')
            Titulo Card
        @endslot
            Corpo do card
    @endcomponent
   
    <hr>

    @include('admin.includes.alerts',['conteudoDoAlert' => 'Meu alert'])

    <hr>


    {{ $teste }}

    @foreach($produtos as $produto)
        <p class="@if($loop->last) last @endif">{{ $produto }}</p>
        <!-- Tambem pode-se usar ($loop->first) -->
    @endforeach


    <hr>

    @forelse($produtos2 as $produto)
        <p>{{ $produto }}</p>
    @empty
        Não tem nada no array
    @endforelse

    <hr>

    <!-- IF comumente conhecido -->
    @if($teste2 === '123')
        É igual
    @elseif($teste2 === 123)
        É igual a 123
    @else
        É diferente
    @endif

    <!-- Oposto do IF -->
    @unless($teste2 === '123')
        Qualquer coisa!
    @else
        Outra coisa!
    @endunless

    <!-- ISSET do PHP -->
    @isset($naoexiste)
        Algo!
    @else
        Outro algo!
    @endisset

    <!-- Empty do PHP -->
    @empty($teste3)
        Vazio!
    @endempty

    <!-- Realiza algo caso esteja autenticado -->
    @auth
        <!-- autenticado -->
    @else 
        <!-- não autenticado  -->
    @endauth

    <!-- Realiza algo caso NÃO esteja autenticado -->
    @guest
        <!-- não autenticado  -->
    @endguest

    <!-- Switch comumente conhecido -->
    @switch($teste2)
        @case(1)
            <!-- ação 1 -->
            @break
        @case(2)
            <!-- ação 2 -->
            @break
        @default
            <!-- ação default -->
    @endswitch
    --}}
@endsection

{{-- 
@push('styles')
    <style>
        .last{background: #CCC}
    </style>
@endpush

@push('scripts')
    <script>
        document.body.style.background = '#987';
    </script>
@endpush
--}}