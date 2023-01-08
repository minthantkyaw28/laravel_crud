<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Customer Create
    public function create(){
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        //dd($posts);
        return view('create',compact('posts'));
    }

    //Post Create
    public function postCreate(Request $request){

        //Validation code
        $this->postValidationCheck($request,"create");

        $data=$this->getPostData($request);
        Post::create($data);
        //return view('create');
        //return back();
        return redirect()->route('post#createPage')->with(['insertSuccess'=>"Post Creation Success!"]);
    }

    //Post Delete
    public function postDelete($id){
        //first way

        // Post::where('id', $id)->delete();
        // return back();
        // return redirect()->route('post#createPage');

        //Secondy way
        Post::find($id)->delete();
        return back();
    }

    //Update Post

    public function updatePage($id){
        // dd($id);
        //$post = Post::where('id', $id)->get()->toArray();
        $post = Post::where('id', $id)->first()->toArray();
        //dd($post);
        return view('update',compact('post'));
    }

    //Edit Page
    public function editPage($id){
        $post = Post::where('id', $id)->first()->toArray();
        return view('edit',compact('post'));
    }

    public function update(Request $request){
       // dd($request->all());

    //Validating incoming update data
    $this->postValidationCheck($request,"update");

    $updateData= $this->getPostData($request);
    $id = $request->postId;
    Post::where('id', $id)->update($updateData);
    return redirect()->route('post#createPage')->with(['updateSuccess'=>"Post Updating Success!"]);
    }

    //get update data
    private function getUpdateData($request){
         return [

            'title' => $request->updateName,
            'description' => $request->updateDescription,
        ];
    }



    //Get post data
    private function getPostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,

        ];
    }


    //Post Validation function
    private function postValidationCheck($request,$status){

        //dd($status);

        if($status=="create"){

            $validationRules = [
            'postTitle' => 'bail|required|min:5|unique:posts,title',
            'postDescription' => 'required',
            ];

        }else{

            $validationRules = [
            'postTitle' => 'bail|required|min:5|unique:posts,title,'.$request->postId,
            'postDescription' => 'required',
            ];

        }

        $validationMessage = [
            'postTitle.required'=>'Need to fill Post Title',
            'postTitle.min'=>'Need to fill more than 5 character',
            'postTitle.unique'=>'Post Title already exists',
            'postDescription.required'=>'Need to fill Post Description'
        ];

        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }

}
