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

    public function create(){
        return 'Exibindo um form para cadastrar novo produto';
    }

    public function edit($id){
        return "Form para editar o produto: {$id}";
    }

    public function store(){
        return "Cadastrando um novo produto";
    }

    public function update($id){
        return "Editando o produto: {$id}";
    }

    public function destroy($id){
        return "Deletando o produto: {$id}";
    }


}
