<?php

namespace App\Http\Controllers;

use App\Models\MessageGroup;
use Illuminate\Http\Request;

class MessageGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $message = New MessageGroup();
            $message->name = $request->name;
            $message->save();
            $message->members()->sync($request->user);
            $success['data'] = $message;
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
     * @param  \App\Models\MessageGroup  $messageGroup
     * @return \Illuminate\Http\Response
     */
    public function show(MessageGroup $messageGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageGroup  $messageGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageGroup $messageGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageGroup  $messageGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageGroup $messageGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageGroup  $messageGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageGroup $messageGroup)
    {
        //
    }
}
