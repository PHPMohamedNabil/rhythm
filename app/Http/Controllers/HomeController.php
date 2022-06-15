<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ShortCut;
use App\Models\Wall;
use App\Models\Question;
use App\Models\Page;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();

        $walls = Wall::orderBy('id','DESC')->orderBy('is_important','DESC')->paginate(5);

        $questions = DB::table('questions')->select('title')->orderBy('created_at','DESC')->limit(5)->get();

       // return dd($questions);
          
        $pages     = DB::table('pages')->select('title','slug')->where('published',1)->where('is_history',0)->whereNull('deleted_at')->orderBy('created_at','DESC')->limit(5)->get();

        return view('home',['categories'=>$categories,'templates'=>ShortCut::select(['title','properties'])->paginate(50),'walls'=>$walls,'questions'=>$questions,'pages'=>$pages]);
    }
}
