<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //

    public function viewCategories(){
    	$categories = Category::all();
    	return view('viewcategories', ["title" => "All Categories", "categories" => $categories]);
    }

    /**
     * View a single category based on title
     * @param String $title 
     * @return view (\Illuminate\Http\Response)
     */
    public function viewCategory($title){
    	
    	$category = Category::where("title", $title)->first();
    	$posts = $category->posts;
    	return view("viewcategory", ["title" => $category->title, "category" => $category, "posts" => $posts]);
    }
}
