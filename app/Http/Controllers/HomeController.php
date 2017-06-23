<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Events\UserCommented;
use App\Exceptions\InsufficientPermissionException;
use App\Http\Requests\AddCategory;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orderBy="NULL")
    {   
        $posts = Post::orderBy("created_at", $orderBy)->get();
        // $posts = DB::table("posts")
        //     ->join("users", "users.id", "=", "posts.user_id")
        //     ->get(['posts.*', 'users.name as user_name', 'users.email as user_email']);
        return view('author/home', ["posts" => $posts]);
    }

    public function newPost(){
        return view('author/newpost');
    }

    public function storePost(Request $request){
        // $image_path = $request->file("preview_image")->storeAs("app", Auth::user()->name . getClientOriginalExtension());
        
        $this->validate($request, [
            'title' => "required",
            'body' => 'required']);
        // $image_path = $request->file("preview_image")->store();
        $status = 0;
        if ($request->action == "publish"){
            $status = 1;
        }
        $post = array("title" => $request->input("title"),
            "body" => $request->input("body"),
            "user_id" => Auth::user()->id,
            "active" => $status,
            "slug" => str_slug($request->input("title")),
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"));
        DB::table("posts")

            ->insert($post);

        session()->flash("message", "Your post has been published");
        return redirect("/home");
    }

    public function editPost($slug){
        $post = DB::table("posts")->where("slug", '=', $slug)->first();
        if (!Gate::allows('update-post', $post)){
            try{
            throw new InsufficientPermissionException("You are not authorized to edit this post.");
            }
            catch(InsufficientPermissionException $ex){
                die("No permission, duh");
            }
            
        }
        if ($post){
            return view("author/editpost", ["post" => $post, "title" => "Edit - " . $post->title]);
        }
        return redirect('/home')->withErrors("Post does not exist");
    }

    public function updatePost(Request $request){
        $post = DB::table("posts")->where("id", "=", $request->post_id)->first();
        $status = 0;
        $message = "Post has been saved as draft";
        if ($request->action == "publish"){
            $status = 1;
            $message = "Post has been published successfully";
        }
        
        
        if ($post){
            if(Auth::user()->id === $post->user_id){
                $post = array("title" => $request->input("title"),
                    "body" => $request->input("body"),
                    "user_id" => Auth::user()->id,
                    "active" => $status,
                    "slug" => str_slug($request->input("title")),
                    
                    "updated_at" => date("Y-m-d H:i:s"));
                DB::table("posts")
                    ->where("id", '=', $request->post_id)
                    ->update($post);
                return back()->withMessage($message);
            }
            else{
                return back()->withInput()
                ->withErrors("You do not have permission to update this post");
            }
        }
        return redirect('/home')->withErrors("You are trying to access an invalid post");
    }

    public function publishPost($slug, $action){
        $post = DB::table("posts")
            ->where('slug', '=', $slug)
            ->first();
        if (!$post){
            return back()->withInput()
                ->withErrors("You are trying to modify an invalid post");
        }
        if (Auth::user()->id !== $post->user_id){
            return back()
                ->withInput()
                ->withErrors("You do  not have permission to update this post");
        }
        if ($action == "publish"){
            DB::table("posts")
                ->where("slug", '=', $slug)
                ->update(["active" => 1]);
                $message = "Publisehd successfully";
        }

        elseif ($action == "draft") {
            # code...
            DB::table("posts")
                ->where("slug", '=', $slug)
                ->update(["active" => 0]);
                $message = "Saved as draft";   
        }
        else{
            return back()->withInput
                ->withErrors("Invalid action specified.");
        }
        return back()->withMessage($message);
    }

    public function publishComment(Request $request){
        $this->validate($request, 
            ["name" => "required",
            "body" => "required"]);
        $comment = new Comment();
        $comment->name = $request->input("name");
        $comment->post_id = $request->input("post_id");
        $comment->body = $request->input("body");
        try{
            $comment->save();  
            event(new UserCommented($comment))  ;
        }
        catch(Exception $e){

        }
        return back()->withMessage("Your comment has been published.");

    }

    public function viewCategory(){
        $categories = Category::all();

        return view('author.category', ['categories' => $categories]);
    }

    public function addCategory(AddCategory $request){
        $category = new Category();
        $category->title = $request->title;
        $category->save();
        return back()->withMessage("Added successfully.");
    }

    public function indexAction(){
        return view()->make("home.index");
    }

    public function send(){
        Log::info("Request cycle with Queues begins");
        $this->dispatch((new SendWelcomeEmail())->delay(60 * 5));
        Log::info("Request cycle with Queues ends");
    }
}
