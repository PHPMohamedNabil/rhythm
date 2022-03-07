<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;

trait CategoriesHelper{


   public function getCategoryPages($id)
   {      
      $category_parent_name = Category::where('id',$id)->pluck('name');
   	$categories           = Category::where('category_id',$id)->get();
   	$pages                = Page::where('category_id',$id)->where('published',1)->where('is_history',0)->paginate(15);
         
         if(count($category_parent_name) < 1)
            return abort(404);
     // return dd($category_parent_name);
   	return view('category_page',compact('categories','pages','category_parent_name','id'));
   }

   public function getCategoryAll()
   {    
      $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();

        return view('category_all',compact('categories'));
   }

}