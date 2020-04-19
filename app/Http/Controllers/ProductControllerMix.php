<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageUpdateProductsRequest;
use App\Product;
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
        // $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $teste = '<h1>TEMIAS</h1>';
        // $teste2 = 123;
        // $produtos = ['Sofá', 'TV', 'Geladeira', 'Cama'];
        // $produtos2 = [];
        // return view('teste',[
        //     'teste' =>  $teste
        // ]);
        
        //Usando função PHP Compact: criar um array a partir do nome das variáveis
        //Compact recebe a referencia da variável (varia´vel sem o $)
        // return view('admin.pages.index',compact('teste', 'teste2', 'produtos', 'produtos2'));

        // $produtos = Product::all(); //Exibe todos os itens
        $produtos = Product::paginate(); //Exibe certa quantidade de itens por página. Default são 15!
        // $produtos = Product::lateste()->paginate(); //Exibe ultimos 15 itens.

        return view('admin.pages.index',[
            'products' => $produtos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorageUpdateProductsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorageUpdateProductsRequest $request)
    {   
        //Validações no Controller (Não é o indicado)
        // $request->validate([
        //     'name' => 'required|min:3|max:255',
        //     'description' => 'required|min:3|max:10000',
        //     'photo' => 'image|nullable',
        // ]); 
        //Se existir erro, ele volta para a página de origem com as mensagens de erro

        // dd('Cadastrando......');
        // dd($request->all()); //Exibe todos os dados pegos na requisição
        // dd($request->only(['name','description'])); //Exibe dados específicos da requisição
        // dd($request->name); //Pega um dado específico
        // dd($request->has('name')); //Retorna true se um dado existe, retorna false se não.
        // dd($request->input('name2','default')); //Retorna o valor 'default' se o campo o param 1 não existe
        // dd($request->except('_token')); //Exibe todos os campos, exceto o informado.

        //Manipulação de arquivos:
        // dd($request->file('photo')); //Exibe todos os dados do arquivo
        // dd($request->file('photo')->isValid()); //Verifica se é um arquivo válido (true ou false)

        if($request->file('photo')->isValid()){
            // dd($request->photo->extension()); // == $request->file('photo'); Exibe a extensão do file!
            // dd($request->photo->getClientOriginalName()); //Exibe p nome original do arquivo

            // Armazena arquivo no diretório informado. Se el não existir, ele será criado
            // Para armazenar os arquivos no diretório raíz (storage) use o parametro '' (vazio).
            // dd($request->file('photo')->store('products')); 
            
            //Armazena o arquivo com nome personalizado
            $nameFile = $request->name . '.' . $request->photo->extension();
            dd($request->file('photo')->storeAs('products', $nameFile));         

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return "Detalhe do produto: $id";

        //Recuperando item:
        // $product = Product::where('id', $id)->first();  //Ou da forma abaixo
        $product = Product::find($id);

        if(!$product) //Ou if(!$product = Product::find($id)) 
            return redirect()->back();

        return view('admin.pages.show',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.edit',compact('id'));
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
        dd("Editando o produto {{$id}}");
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
