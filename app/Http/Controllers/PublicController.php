<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Comment;
use App\Category;
class PublicController extends Controller
{
    //
    public function index(){
    	$posts = Post::where("active", 1)
    		->get();
    	// $categories = Category::all();
    	// $posts = DB::table("posts")
    	// ->where("active", "=", 1)
    	// ->join("users", "users.id", "=", "posts.user_id")
    	// ->get(['posts.*', 'users.name as user_name', 'users.email as user_email']);
    	return view('index', ['title' => "All Posts", "posts" => $posts]);
    }

    public function viewPost($slug){
    	
	    
    	$post = Post::where("slug", $slug)
    	->first();
	    
	    $comments = $post->comments()->orderBy("created_at", "DESC")->get();

    	// $post = DB::table("posts")->where("slug", "=", $slug)
    	// ->join("users", "users.id", "=", "posts.user_id")
    	// ->where('posts.active', "=", 1)
    	// ->first(['posts.*', 'users.name as user_name', 'users.email as user_email']);
    	if ($post){
	    	return view('viewpost', ["title" => $post->title, "post" => $post, "comments" => $comments]);
    	}
    	return redirect('/')->withErrors("We are sorry, that is not available.");
    }

    public function searchPosts(Request $request){
    	$query = $request->q;
    	if (is_null($query)){
    		return back();
    	}
    	$posts = Post::where('active', 1)->where('title', 'like', "%".$query."%")->get();
    	return view('index', ['title' => "All Posts", "posts" => $posts]);
    }

    public function viewCategories(){
    	$categories = Category::all();
    	return view('viewcategories', ["title" => "All Categories", "categories" => $categories]);
    }

    public function viewCategory($title){
    	
    	$category = Category::where("title", $title)->first();
    	$posts = $category->posts;
    	return view("viewcategory", ["title" => $category->title, "category" => $category, "posts" => $posts]);
    }
}
