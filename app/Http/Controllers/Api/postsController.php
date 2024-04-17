<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait; // Corrected the trait import name
use Illuminate\Support\Facades\Validator;

class postsController extends Controller
{
    use ApiResponseTrait;

public function index(){
$post=PostResource::collection(Post::get());

return $this->successResponse($post,"done");
}

public function show($id){

$post=Post::find($id);

if ($post) {
    return $this->successResponse(new PostResource($post),"done",200);
}

return $this->successResponse(null,"there is no id by this number",404);

}

public function store(Request $request){

    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'body' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->successResponse(null,$validator->errors(),400);
    }

$post=Post::create($request->all());

if ($post) {
    return $this->successResponse(new PostResource($post),"done",200);
}
return $this->successResponse(null,"not save in database",400);


}

public function Update(Request $request,$id){

    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'body' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->successResponse(null,$validator->errors(),400);
    }

    $post=Post::find($id);

    if (!$post) {
        return $this->successResponse(null,"there is no id by this number",404);
    }

    $post->Update($request->all());
    if ($post) {
        return $this->successResponse(new PostResource($post),"the post updated successfully",201);
    }
}


public function delet($id){

$post=Post::find($id);

if (!$post) {
    return $this->successResponse(null,"there is no id by this number",404);
}

if ($post) {
    $post->delete($id);
    return $this->successResponse(null,"the post delet succcessfully",200);
}
}
}
