<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Tasks\Comment\GetCommentByIdTask;
use App\Tasks\Comment\StoreReplyTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreReplyAction
{
    public function run(Request $request, Comment $comment): Comment|Exception
    {
        DB::beginTransaction();

        try {
            $commentID = app(StoreReplyTask::class)->run(request: $request, comment: $comment);

            $comment = app(GetCommentByIdTask::class)->run(commentId: $commentID);

            DB::commit();

            return $comment;
            //
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
