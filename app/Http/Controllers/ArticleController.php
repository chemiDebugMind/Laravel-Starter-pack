<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $articles = Article::query()->with('user','categories');
            return DataTables::of($articles)
                    ->addColumn('author',function($row){
                        return $row->user->name;
                    })
                    ->addColumn('categories', function($row){
                        $cate = [];
                        foreach ($row->categories as $category) {
                            array_push($cate,$category->name);
                        }
                        return $cate;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="'.route('articles.edit',$row->id).'" class="edit btn btn-sm"><i style="color:blue" class="fa fa-edit" aria-hidden="true"></i></a>';
                        $btn .= '<a href="javascript:void(0)" data-target="#modal-danger-article"  data-toggle="modal" data-id='.$row->id.' class="btn btn-sm deletes"> <i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['author','categories','action'])
                    ->make('true');
        }
        return view('sections.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('sections.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        $storeArticle  = $article->StoreArticle($request);
        if($storeArticle['status']){
            return redirect()->route('articles.index')->with('success',$storeArticle['message']);
        }
        else{
            return redirect()->back()->with('error',$storeArticle['message']);

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
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $cate = [];
        foreach ($article->categories as $category) {
            array_push($cate,$category->id);
        }

        return view('sections.articles.edit',compact('categories','article','cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = new Article();
        $storeArticle  = $article->updateArticle($request,$id);
        if($storeArticle['status']){
            return redirect()->route('articles.index')->with('success',$storeArticle['message']);
        }
        else{
            return redirect()->back()->with('error',$storeArticle['message']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Article::findorFail($id);
            $article->categories()->detach();
            $article->delete();

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!'
            ]);
        }

        return response()->json([
            'success' => 'Article has been deleted!'
        ]);

    }
}
