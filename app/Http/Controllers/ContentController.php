<?php

namespace App\Http\Controllers;

//model classes and utility classes to run the app
use Illuminate\Http\Request;
use App\Content;
use App\Comment;
use App\User;
use Illuminate\Contracts\Validation\Validator;

use DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$posts = DB::select("SELECT * FROM contents WHERE publish_status=1 ORDER by created_at DESC LIMIT 5");
		$user = new User;
		
		return view('blog.index',compact('posts'))->with(['title'=>'My Story Board Home','userInstance'=>$user]);
		//return $posts->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		
		 }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		
		$rules = [
		'post_title'=>'required|max:140',
		'description'=>'required',
		'post_body'=>'required',
		
		];
		
		$messages = [
		'description'=>'A befitting description is very important here',
		'required'=>'This field is required'
		];
		
		$validate = Validator::make($request->all(),$rules,$messages)->validate();
		
		
		$content = new Content;
		$content->post_title = $request->story_title;
		$content->post_body = $request->post_body;
		$content->description = $request->description;
		$content->author = $request->author;
		$content->publish_status = 0;
		$content->category = $request->category;
		
    }

/***save new post to DB 
**via the API instead of via the web interface
*/

public function saveStore(Request $request){
	
	
	$user = User::where('api_token', $request->get('api_token'))->first();

 $content = Content::create(
 $request->input()
 );

 if ($request->has('published'))
 {
 $content->published = 1;
 $content->save();
 }


 return response()->json([ 'message' => 'The event has been created',], 200);

	
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
		$singlePost = Content::find($id);
		
		//fetching the comments
		$comments = DB::select("SELECt *FROM comments WHERE post_id=? AND pub_status=?",[$id,1]);
		
		//initializing the user's model
		$user = new User;
		
		//related stories
		$related = $this->relatedStories($singlePost->category);
		
		return view('blog.show',['post'=>$singlePost,'comments'=>$comments,'userModel'=>$user,'content'=>$this,'title'=>$singlePost->post_title, 'relatedStoryModel'=>$related]);
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


/**
*To show the privacy policy page
*
*/

public function privacypolicy(){	
return view('blog.privacypolicy');	
}


//this returns the comoments from the comments table using the one-to-many relationship model
public function comments(){
return 	$this->hasMany('App\Comment')->where('pub_status',true);
}


//using the eloquent ORM model to get related stories based on the category of the current story been read by the reader
public function relatedStories($category){
	
$related = Content::where(['publish_status'=>1, 'category'=>$category])->orderBy('created_at','DESC')->take(4)->skip(1)->get();
//$related = DB::select("SELECT post_bg_img, post_title, description FROM contents WHERE publish_status=? AND category=?",[1,$category]);

return $related;
	
	
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//custom functions to handle content filtering
public function findByCategory($cat){
	$postByCategory = DB::select("SELECT *FROM contents WHERE category =? AND publish_status=? ORDER BY created_at DESC",[$cat,1]);
	return view('blog.cat')->with('postByCategory',$postByCategory);
	
}

/***
 * API methods starts here
 * 
 */

public function getApiContent(){

$blogPosts = Content::where(['publish_status'=>1])->orderBy('created_at','asc')->take(7)->get();

return $blogPosts->toArray();

}

//establishing a one-to-one relationship between the content and user tables
public function user(){
	
	return $this->hasOne('App\User');
	
}


}
