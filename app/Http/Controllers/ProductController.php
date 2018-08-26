<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Auth;
use Session;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     * We're calling the middleware clearance to check if the user can see this stuff
     */
    public function __construct()
    {
        $this->middleware(['auth', 'product']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Shows 10 items per page in descending order
        $items = Product::orderby('id', 'desc')->paginate(3);

        return view('products.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
        $this->validate($request, [
            'item'        => 'required|max:50',
            'difficulty'  => 'required',
            'buyers'      => 'required|integer',
            'boosters'    => 'required|integer',
            'overbooking' => 'required',
        ]);

        $data = [
            'item'        => $request->input('item'),
            'difficulty'  => $request->input('difficulty'),
            'buyers'      => (int)$request->input('buyers'),
            'boosters'    => (int)$request->input('boosters'),
            'overbooking' => (int)$request->input('overbooking')
        ];

        //dd($data);
        $product = Product::create($data);

        //Display a successful message upon save
        return redirect()->route('products.index')
            ->with('flash_message', 'Product:
             '. $product->item.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Need for auth";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
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
        $this->validate($request, [
            'item'        => 'required|max:50',
            'difficulty'  => 'required|max:10',
            'buyers'      => 'required|integer',
            'boosters'    => 'required|integer',
            'overbooking' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->item = $request->input('item');
        $product->difficulty = $request->input('difficulty');
        $product->buyers = $request->input('buyers');
        $product->boosters = $request->input('boosters');
        $product->overbooking = $request->input('overbooking');
        $product->save();

        return redirect()->route('products.index',
            $product->id)->with('flash_message',
            'Product: '. $product->item.' updated');

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
