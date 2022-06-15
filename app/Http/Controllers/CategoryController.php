<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\DataTables\CategoryDatatable;
use App\Http\Helpers\CategoriesHelper;

class CategoryController extends Controller
{  
    use CategoriesHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {  
        $this->middleware('auth')->except(['getCategoryPages','getCategoryAll']);
        $this->authorizeResource(Category::class,'category');
    }
    public function index(CategoryDatatable $table)
    {
       // return(Category::find(6)->toArray());
        $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();
        
        // $categories = Category::all();

         return $table->render('admin.category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
         $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();
        return view('admin.category.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             //return dd($request->all());
         Category::create($this->validateReq($request));

         return redirect()->route('category.index')->with('msg','Category Added Successfully');
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
    public function edit(Category $category)
    {
         $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();

        return view('admin.category.edit',['categories'=>$categories,'cate'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {    
         
         $category->update($this->validateReq($request,true,$category));

         return redirect()->route('category.edit',$category->id)->with('msg','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {   
        $pages_count = DB::table('pages')->select('id')->where('category_id',$category->id)->where('is_history',0)->count();
        if($pages_count >0)
        {
           $name = $category->name;

           return redirect()->route('category.index')->with('err', $name);
        }
        $name = $category->name;
        $category->delete();

        return redirect()->route('category.index')->with('del', $name);
    }

    public function validateReq($req,$update=null,$update_id=null)
    {
        if($update)
        {
            if($update_id->id == $req->category_id)
            {
                return redirect()->route('category.index')->with('msg','you can not assign this data try again');
            }

          return $this->validate($req,[
                'name'=>"required|string|max:120|min:3|unique:categories,name,$update_id->id",
                'category_id'=>'numeric|nullable|exists:categories,id'
            ]);
        }

          return $this->validate($req,[
                'name'=>'required|string|max:120|min:3|unique:categories,name',
                'category_id'=>'numeric|nullable|exists:categories,id'
            ]);
    }
}
