<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductControllerMix extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        //dd($request);
        $this->request = $request;
        // $this->middleware('auth');

        //Aplica so n oque for mencionado
        // $this->middleware('auth')->only([
        //     'create','store'
        // ]);
        
        //Aplica em todos, exceto os mencionados
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teste = '<h1>TEMIAS</h1>';
        // return view('teste',[
        //     'teste' =>  $teste
        // ]);
        
        //Usando função PHP Compact: criar um array a partir do nome das variáveis
        //Compact recebe a referencia da variável (varia´vel sem o $)
        return view('admin.pages.index',compact('teste'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
