<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Events\StoreCommentEvent;
use App\Actions\Comment\{GetAllCommentsAction, StoreReplyAction, UpdateCommentAction};
use App\Actions\LogActivity\StoreLogActivityAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\comment\{
    ReplyRequest,
    UpdateCommentRequest
};
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = app(GetAllCommentsAction::class)->run();

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
        app(UpdateCommentAction::class)->run(request: $request, comment: $comment);

        app(StoreLogActivityAction::class)->run(subject: 'comment status updated successfully');

        return redirect()->route('admin.comments.index')->with(['message' => __('messages.success')]);
    }

    public function reply(Comment $comment, ReplyRequest $request)
    {
        app(StoreReplyAction::class)->run(request: $request, comment: $comment);

        app(StoreLogActivityAction::class)->run(subject: 'reply sent successfully');

        //send notification for user
        event(new StoreCommentEvent($comment));

        return redirect()->back()->with(['message' => __('messages.success')]);
    }
}
