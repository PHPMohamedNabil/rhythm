<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ShortCut;
use App\Models\Wall;

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

        return view('home',['categories'=>$categories,'templates'=>ShortCut::select(['title','properties'])->paginate(50),'walls'=>$walls]);
    }
}
