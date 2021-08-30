<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=0)
    {
        try {
            $limit = 50;
            $offset = 0;
            if($request->page>0)
            {
                $offset = ($request->page - 1) *$limit;
            }
            if($id>0){
                $user = $id;
                 $data = DB::select(DB::raw("CALL `getPost`($user, $limit, $offset)"));
            }else{
                  $user = auth()->user()->id;
                   $data = DB::select(DB::raw("CALL `getTimelinepost`($user, $limit, $offset)"));
            }
           // $post = $user->timeline->getAllPost();
            $success['data'] = $data;
            $success['success'] = true;
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = $e->getMessage();
            return $this->sendResponse($success, 401);
        }
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
        try {
            $post = New Post();
            $post->validate($request->all());
            $data =$post->store();
            $success['data'] = $data->load('user');
            $success['success'] = true;
            $success['message'] = "Post Created";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = $e->getMessage();
            return $this->sendResponse($success, 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        try {
            $user = (auth()->user())?auth()->user()->id:0;
            $data = DB::select(DB::raw("CALL `getSinglePost`($id, $user)"));
            $success['data'] = $data;
            $success['success'] = true;
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = $e->getMessage();
            return $this->sendResponse($success, 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
