@if($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>    
@endif

{{-- 
<div class="alert">
    <!-- Se $conteudoDoAlert for vazio, imprime o valor 'default' -->
    <p>Alert - {{ $conteudoDoAlert ?? 'default'}}!!</p>
</div>
--}}