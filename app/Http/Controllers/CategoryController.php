<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Category::query()->with('childrenCategories','childCategory');
            return Datatables::of($data)
                    ->editColumn('name', function($category){
                        if( $category->childCategory){
                                    return $category->name.' (sub Category)</br> --'.$category->childCategory->name;
                        }
                        return $category->name;
                       
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="'.route('categories.edit',$row->id).'" class="edit btn btn-sm"><i style="color:blue" class="fa fa-edit" aria-hidden="true"></i></a>';
                        $btn .= '<a href="javascript:void(0)" data-target="#modal-danger-category"  data-toggle="modal" data-id='.$row->id.' class="btn btn-sm deletes"> <i style="color:red" class="fa fa-trash" aria-hidden="true"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['name','action'])
                    ->make('true');
        }
        $categories = Category::whereNull('category_id')
                        ->with('childrenCategories')
                        ->get();
        return view('sections.categories.index')->with(['categories'=>$categories]);
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
    public function store(StoreCategoryRequest $request)
    {
        try {
            $input = $request->all();
            $category = Category::create($input);
            
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong!');
        }

        return redirect()->back()->with('success','Category has been created');

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
        $category = Category::where('id',$id)->with('childrenCategories')->first();
        $parentCategories = Category::whereNull('category_id')->get();
        return view('sections.categories.edit',compact('category','parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category  = Category::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->category_id = $request->category_id;
            $category->save();
    
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went Wrong!');
            
        }

        return redirect()->route('categories.index')->with('success','Category Updated Successful');

       
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
            Category::findorFail($id)->delete();

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Something went wrong!'
            ]);
        }

        return response()->json([
            'success' => 'Category has been deleted!'
        ]);

    }
}
