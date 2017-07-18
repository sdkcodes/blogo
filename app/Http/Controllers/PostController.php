<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Comment;
use App\Category;

/**
 * Controller for handling frontend posts actions
 */
class PostController extends Controller
{
    /**
     * Show all published posts
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$posts = Post::where("active", 1)->orderBy("created_at", "DESC")
    		->get();
    	
    	return view('index', ['title' => "All Posts", "posts" => $posts]);
    }
    /**
     * Fetch and return a single post
     * @param String $slug 
     * @return \Illuminate\Http\Response
     */
    public function viewPost($slug){
    	
    	$post = Post::where("slug", $slug)
    	->first();
	    
	    $comments = $post->comments()->orderBy("created_at", "DESC")->get();

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
    	return view('index', ['title' => "All Posts", "posts" => $posts, "search_query" => $query]);
    }
}
