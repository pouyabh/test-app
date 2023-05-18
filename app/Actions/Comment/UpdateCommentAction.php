<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Tasks\Comment\GetCommentByIdTask;
use App\Tasks\Comment\UpdateCommentTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateCommentAction
{
    public function run(Request $request, Comment $comment): Comment|Exception
    {
        DB::beginTransaction();

        try {
            app(UpdateCommentTask::class)->run(request: $request, comment: $comment);

            $comment = app(GetCommentByIdTask::class)->run(commentId: $comment->id);

            DB::commit();

            return $comment;
            //
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
