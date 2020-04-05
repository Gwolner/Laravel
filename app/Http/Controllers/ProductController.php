<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $produtos = ['Sabão', 'Pizza', 'Guaraná'];
        return $produtos; //O Laravel converte pra JSON
    }

    public function show($id){
        return "Produto de id: {$id}";
    }
}
