<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PagesDataTable;
use App\Models\Category;
use App\Http\Helpers\PageImageHandler;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Helpers\PagesHelper;
use App\Http\Helpers\BulkHelper;

class PageController extends Controller
{
    use PageImageHandler;
    use PagesHelper;
    use BulkHelper;


    public function __construct()
    {
      $this->authorizeResource(Page::class,'page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PagesDataTable $table,Page $page)
    {   

        return $table->render('admin.pages.index',['page'=>$page]);
      //  return view('admin.pages.index',['pages'=>Page::all()]);
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
        return view('admin.pages.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Page $page)
    {    
        $this->validateReq($request);
         Page::create([
                  'slug'=>Str::slug($request->title,'-'),
                  'title'=>$request->title,
                  'short_description'=>$request->short_description,
                  'long_description'=>$request->long_description,
                  'content'=>$request->content,
                  'category_id'=>$request->category_id,
                  'published'=>($request->published && $request->user()->can('publish',$page))?1:0,
                  'publisher_id'=>($request->published && $request->user()->can('publish',$page))?auth()->user()->id:null,
                  'user_id'  =>auth()->user()->id
         ]);
        return redirect()->route('page.index')->with('msg','Page Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.pages.show',['paeg'=>Page::findOrfail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {   
        $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();
        $is_history_exists = $this->countPageHistory($page);
        return view('admin.pages.edit',['page'=>$page,'categories'=>$categories,'is_history_exists'=>$is_history_exists]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Page $page)
    {
         $this->validateReq($request,true,$page);         
       
       //return dd(auth()->user()->id);
         if($page->content != $request->content)
         { 

           $newPage =  Page::create([
                  'slug'=>Str::slug($request->title,'-'),
                  'title'=>$request->title,
                  'short_description'=>$request->short_description,
                  'long_description'=>$request->long_description,
                  'content'=>$request->content,
                  'category_id'=>$request->category_id,
                  'published'=>($request->published && $request->user()->can('publish',$page))?1:0,
                  'refer_to' => ($page->refer_to !== null)?$page->refer_to:$page->id,
                  'user_id'=>$page->user_id,
                  'editor_id'=>auth()->user()->id,
                  'publisher_id'=>($request->published && $page->published != 1 && $request->user()->can('publish',$page))?auth()->user()->id:$page->publisher_id
         ]);
        

             $page->is_history  = 1;
             $page->refer_to    =$newPage->refer_to;
             $page->editor_id   =auth()->user()->id;

             
             $page->save();
             return redirect()->route('page.index')->with('msg','Page Updated');
         } 

         $page->update([
                  'slug'=>Str::slug($request->title,'-'),
                  'title'=>$request->title,
                  'short_description'=>$request->short_description,
                  'long_description'=>$request->long_description,
                  'content'=>$request->content,
                  'category_id'=>$request->category_id,
                  'published'=>( ($request->published && $request->user()->can('publish',$page) ) || ($request->user()->cannot('publish',$page) ) && !$request->published  )?1:0,
                  'publisher_id'=>($request->published && $page->published != 1 && $request->user()->can('publish',$page))?auth()->user()->id:$page->publisher_id,
                  'editor_id'=>auth()->user()->id
         ]);
        return redirect()->route('page.index')->with('msg','Page Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page,Request $request)
    {

         $name  = $page->title;
         $page->Delete();

        return redirect()->route('page.index')->with('del', $name);
    }

    public function validateReq($req,$update=null,$update_id=null)
    {  
      //  return dd($update_id);

        if($update)
        {
 
          return $this->validate($req,[
                'title'=>"required|string|max:255|min:3",
                'short_description'=>"required|string|min:3|max:255",
                'long_description'=>"required|string|min:3|max:255",
                'content'=>"required|string",
                'category_id'=>"required|integer",
                'published'=>"string"

            ]);
        }

          return $this->validate($req,[
                'title'=>"required|string|max:255|min:3|unique:pages,title",
                'short_description'=>"required|string|min:3|max:255",
                'long_description'=>"required|string|min:3|max:255",
                'content'=>"required|string",
                'category_id'=>"required|integer",
                'published'=>"string"

            ]);
    }
}
