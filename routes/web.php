<?php

use Illuminate\Support\Facades\Route;
//Comando de Artisan para View
//php artisan view:clear

//Usando Middleware (Filtros)
// Route::resource('products','ProductControllerMix')->middleware('auth');

//Comandos de Artisan para controller
//php artisan make:controller ProductController --resource -> cria Controller com 

// Controllers Resources 
//Gera todo o código do Controller CRUD comentado abaixo
Route::resource('products','ProductControllerMix');

//Controlers de CRUD
// Route::delete('/products/{id}','ProductController@destroy')->name('products.destroy');
// Route::put('/products/{id}','ProductController@update')->name('products.update');
// Route::get('/products/{id}/edit','ProductController@edit')->name('products.edit');
// Route::get('/products/create','ProductController@create')->name('products.create');
// Route::get('/products/{id}','ProductController@show')->name('products.show');
// Route::get('/products','ProductController@index')->name('products.index');
// Route::post('/products','ProductController@store')->name('products.store');

//################## DICIONARIO BOAS PRÁTICAS #######################
/*
lsitar, list, exibir = index
exibir algo específico de uma lista = show
add, adicionar, registrar = create
update = update
deletar, apagar = destroy

*/


//################### APRENDIZADO SOBRE ROTAS #######################
//Comandos de Artisan para rotas
//php artisan route:list -> Lista todas as rotas criadas
//php artisan route:cache -> Limpa as rotas que estão em cache

//Login de suporte aos grupos de rotas
Route::get('/login',function(){
    return 'Login!';
})->name('login');


//Grupo de rotas #3
Route::middleware('auth')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard',function(){
            return 'Dashboard Admin!';
        });
        
        Route::get('/financeiro',function(){
            return 'Financeiro Admin!';
        });
        
        Route::get('/produtos',function(){
            return 'Produtos Admin!';
        });
    });
});

//Grupo de rotas #2
// Route::middleware('auth')->group(function(){
//     Route::get('/admin/dashboard',function(){
//         return 'Dashboard Admin!';
//     });
    
//     Route::get('/admin/financeiro',function(){
//         return 'Financeiro Admin!';
//     });
    
//     Route::get('/admin/produtos',function(){
//         return 'Produtos Admin!';
//     });
// });

//Grupo de rotas #1
// Route::get('/admin/dashboard',function(){
//     return 'Dashboard Admin!';
// })->Middleware('auth');

// Route::get('/admin/financeiro',function(){
//     return 'Financeiro Admin!';
// })->middleware(['auth', 'outro middleware']);

// Route::get('/admin/produtos',function(){
//     return 'Produtos Admin!';
// })->middleware('auth');

//Rotas nomeadas
Route::get('/temias',function(){
    return redirect()->route('nomeParaAUrl');
});

Route::get('/url-name',function(){
    return 'Hey hey hey!!';
})->name('nomeParaAUrl');

//Retornando uma View (Não é indicado, pois isto ignora o Controller)
Route::get('/view',function(){
    return view('welcome');
});

//Retornando view quando esta for simples e não precisar de nada importante!
//No caso, view estática, sem variações.
Route::view('/view2','welcome');

//Redirecionamento de rota
Route::get('/rota1', function(){
    return redirect('/rota2');
});

Route::get('/rota2',function(){
    return 'Rota 2';
});

Route::get('/rota3',function(){
    return 'Rota 3';
});

Route::redirect('/rota3','/rota2');

//Rotas com parêmetros ('/valor_da_rota/valor_dinamico/prefixo')

//Rota dinâmica com parâmetros opcionais
//Acrescenta '?' na indicação da variável e define um valor vazio para variável!!
Route::get('/produtos/{idProduct?}',function($idProduct = ''){
    if($idProduct == ''){
        return "Lista de todos os produtos";
    }else{        
        return "Produto(s): {$idProduct}";
    }
});

//rota dinâmica com prefixo
Route::get('/categoria/{flag}/post',function($flag){
    return "Produto da categoria: {$flag} + Post";
});

//rota dinâmico. 
//{flag} não é a variável, é a indicação da variável!!
Route::get('/categorias/{flag}',function($flag){ 
    return "Produto da categoria: {$flag}";
});

//MATCH = Define quais métodos são permitidos.
Route::match(['get','post'], '/match', function(){
    return 'match';
});

//ANY = Aceita qualquer tipo de requisição. Uso desaconselhado.
Route::any('/any', function(){
    return 'any';
});

//POST = Não funciona desta forma porq requer token de validação!!
Route::post('/registrar',function(){
    return '';
});

//GET = Método default dos navegadores
Route::get('/empresa',function(){
    return 'Sobre a empresa';
});

Route::get('/contato',function(){
    return view('site.contact'); //diretorio.arquivo
});

Route::get('/', function () {
    return view('welcome');
});
