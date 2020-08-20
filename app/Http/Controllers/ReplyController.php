<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Discussion;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReplyRequest;
use App\Notifications\AddReplyNotification;
use Illuminate\Support\Facades\Notification;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
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
    public function store(CreateReplyRequest $request, Discussion $discussion)
    {
        auth()->user()->replies()->create([
            'discussion_id' => $discussion->id,
            'content' => $request->content
        ]);

        if (auth()->user()->id != $discussion->author->id) {
            $discussion->author->notify(new AddReplyNotification($discussion));
            // Notification::send($discussion->author, new AddReplyNotification($discussion));
        }

        session()->flash('success', 'Reply added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
