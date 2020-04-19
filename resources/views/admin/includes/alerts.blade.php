{{-- 
<div class="alert">
    <!-- Se $conteudoDoAlert for vazio, imprime o valor 'default' -->
    <p>Alert - {{ $conteudoDoAlert ?? 'default'}}!!</p>
</div>
--}}

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif