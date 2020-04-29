<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageUpdateProductsRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductControllerMix extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Product $produto )
    {
        //dd($request);
        $this->request = $request;
        $this->repository = $produto;
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
        //Pegando todos os dados:
        // $data = $request->all();

        //Pegando dados específicos:
        $data = $request->only('name','description','price','image');

        if($request->hasFile('image') && $request->image->isValid()){
            //dd($request->image->store('products'));
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        };

        //Cria/persiste os dados e retorna um objeto que pode ou não ser usado!
        // $product = Product::create($data);

        $this->repository->create($data);

        return redirect()->route('products.index');


        //Validações no Controller (Não é o indicado)
        // $request->validate([
        //     'name' => 'required|min:3|max:255',
        //     'description' => 'required|min:3|max:10000',
        //     'image' => 'image|nullable',
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
        // dd($request->file('image')); //Exibe todos os dados do arquivo
        // dd($request->file('image')->isValid()); //Verifica se é um arquivo válido (true ou false)

        // if($request->file('image')->isValid()){
        //     // dd($request->image->extension()); // == $request->file('image'); Exibe a extensão do file!
        //     // dd($request->image->getClientOriginalName()); //Exibe p nome original do arquivo

        //     // Armazena arquivo no diretório informado. Se el não existir, ele será criado
        //     // Para armazenar os arquivos no diretório raíz (storage) use o parametro '' (vazio).
        //     // dd($request->file('image')->store('products'));

        //     //Armazena o arquivo com nome personalizado
        //     $nameFile = $request->name . '.' . $request->image->extension();
        //     dd($request->file('image')->storeAs('products', $nameFile));

        // }

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
        // $product = Product::find($id);
        $product = $this->repository->find($id);

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
        if(!$product = Product::find($id))
            return redirect()->back();

        return view('admin.pages.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorageUpdateProductsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorageUpdateProductsRequest $request, $id)
    {
        // if(!$product = Product::find($id))
        if(!$product = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid()){

            if($product->image && Storage::exists($product->image) ){
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        };

        // $product->update($request->all());
        $product->update($data);

        return redirect()->route('products.index');

        // dd("Editando o produto {{$id}}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!$product = Product::find($id))
        if(!$product = $this->repository->find($id))        
            return redirect()->back();

        if($product->image && Storage::exists($product->image) ){
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');

        // dd("Deletando o produto: $id");
    }

    public function search(Request $request){
        
        // $filters = $request->all();
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.index',[
            'products' => $products,
            'filters' => $filters,
        ]);
        // dd($request->all());
    }


}
