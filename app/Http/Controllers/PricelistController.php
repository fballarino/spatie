<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Pricelist;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->input('cat'))
        {
            $pricelist = Pricelist::with('article')
                ->where('is_active',1)
                ->get();
            //dd($articles);
            return view('articles.index', compact('pricelist'));
        }
        //dd(Pricelist::with(['article'])->get());
        dd(Article::with('pricelists')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::with('category')
            ->orderBy('code','asc')
            ->get();
        return view('articles.create', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'article_id' => 'required|integer',
            'price'      => 'required|integer|min:1|max:9999999',
            'is_active'  => 'required|integer',
            'valid_from' => 'nullable|date',
            'valid_to'   => 'required|date'
        ]);
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
