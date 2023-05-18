<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\comment\ReplyRequest;
use App\Http\Requests\admin\comment\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all()->sortByDesc('created_at');

        return view('admin.comment.index', compact('comments'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('admin.comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.comments.index')->with([ 'message' => __('messages.success')]);
    }

    public function reply(Comment $comment, ReplyRequest $request)
    {
        Comment::create([
            'parent_id'     => $comment->id,
            'admin_id'      => auth()->user()->id,
            'text'          => $request->text
        ]);

        return redirect()->back()->with([ 'message' => __('messages.success')]);
    }
}
