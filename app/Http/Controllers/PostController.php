<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller             //StudlyCase
{
    public function firstAction()         // Action Methods , camelCase
    {    
        $localName = 'ahmed';
        $books = ['css','html','js'];
        return view('test',['name' => $localName, 'booksarray' => $books]);

    }
    public function index()
    {
        //Select * from posts
        $postsFromDB = Post::all(); //collection object

        return view('Posts.index',['posts' => $postsFromDB]);
        /*        $allPosts = [
            ['id'=> 1 ,'title' => 'PHP' , 'posted by' =>'Roaa', 'created by' => '2025-10-25'],
            ['id'=> 2 ,'title' => 'HTML' , 'posted by' =>'Ahmed', 'created by' => '2025-09-15'],
            ['id'=> 3 ,'title' => 'Java' , 'posted by' =>'Mohamed', 'created by' => '2025-08-11']

        ];
        */
    }

    public function show(Post $post) //type hinting
     { 
        //select * from posts where id = $postid limit 1
//        $singlePostFromDB = Post::where('id',$postid)->first(); // model object
//        $singlePostFromDB = Post::where('id',$postid)->get(); //collection object (better for searching about word)
        
//        $singlePostFromDB = Post::findOrFail($postid);  //model object
/*        if(is_null($singlePostFromDB)){
            return to_route('posts.index');
        }
 */
       return view('Posts.show',['post' => $post]);
        /*  $singlePost = [
                'id'=> 2 ,'title' => 'HTML' ,'description' => 'good language', 'posted_by' =>'Ahmed', 'email' => 'aa@gamail.com', 'created_at' => '2025-09-15'

            ];
        */ 

    }
    
    public function create()
    {
        //select * from users;
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {

    //code to validate
    request()->validate([
        'title' => ['required','min:3'],
        'description' => ['required','min:5'],
        'post_creator' => ['required','exists:users,id'],
    ]);
    // 1- get the user data    
//  $data=$_POST;
        
//  $request= request();
//  dd(request->title,request->all();

        $data = request()->all(); 

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

//      dd($data, $title);     

    // 2- store the submitted data in database
//    $post = new Post;
 
//    $post->title = $title ;
//    $post->description = $description;

//    $post->save(); // insert into posts
  

    Post::create([
        'title' => $title,
        'description' => $description,
        'user_id' => $postCreator
    ]);

    // 3- redirection to posts.index
    return to_route('posts.index');   
    }

    public function edit(Post $post)
    {
    //select * from users; 
        $users = User::all();        

        return view('posts.edit',['users'=> $users , 'post' => $post]);
    }

    public function update($postid)
    {
//      1- get the user data    

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
     
//       dd( $title,$description,$postCreator); 

        //code to validate
        request()->validate([
            'title' => ['required','min:3'],
            'description' => ['required','min:5'],
            'post_creator' => ['required','exists:users,id'],
        ]);

//       2- update the user data in database
            //select or find post
            //update the post

        $singlePostFromDB = Post::find($postid);
        $singlePostFromDB -> update(
            [
                'title' => $title,
                'description' => $description,
                'user_id' =>$postCreator
            ]);


//       3- redirection to singlw post.index
        return to_route('posts.show',$postid);  
    }

    public function destroy($postid)
    {
        //1- delete the post from the database
           //select or find post
           //update the post
        $post = Post::find($postid);
        $post->delete();
    
    
           //2- redirect to posts.index
        return to_route('posts.index');

    }
}
