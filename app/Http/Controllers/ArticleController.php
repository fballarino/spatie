<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category')->get();
        return view('articles.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('description', 'id');
        return view('articles.new', compact('categories'));
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
            'category_id'  => 'required|integer',
            'description' => 'required|string|max:40',
            'code'        => 'required|string|max:13',
            'note'        => 'nullable|string|max:255',
        ]);

        try {
            $article = new Article;
            $article->category_id = $request->input('category_id');
            $article->description = $request->input('description');
            $article->code = $request->input('code');
            $article->note = $request->input('note');
            $article->save();

            return redirect()->route('articles.index')
                ->with('flash_message', 'Article successfully added');
        }

        catch(\Exception $e){
            //return redirect()->route('articles.index')
                //->with('flash_message', 'Article not inserted');
            echo $e;
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
        $article = Article::with('category')->find($id);
        $categories = Category::pluck('description', 'id');
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'category_id'  => 'required|integer',
            'description' => 'required|string|max:40',
            'code'        => 'required|string|max:13',
            'note'        => 'nullable|string|max:255',
        ]);

        try {

            $article->category_id = $request->input('category_id');
            $article->description = $request->input('description');
            $article->code = $request->input('code');
            $article->note = $request->input('note');
            $article->save();

            return redirect()->route('articles.index')
                ->with('flash_message', 'Article successfully updated');
        }

        catch(\Exception $e){
            return redirect()->route('articles.index')
            ->with('flash_message', 'Article not updated');
            echo $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();

            return redirect()->route('articles.index')
                ->with('flash_message', 'Article successfully deleted');
        }

        catch(\Exception $e){
            return redirect()->route('articles.index')
                ->with('flash_message', 'Article not deleted');
            echo $e;
        }
    }
}
