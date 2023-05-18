<?php

namespace App\Http\Resources\Api\v1\Comment;

use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'user'              => $this->user,
            'admin'             => $this->admin,
            'text'              => $this->lastname,
            'status'            => $this->status,
            'replies'           => $this->whenLoaded('replies'),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'OK',
            'message' => 'Success',
            'isSuccess' => true,
            'errors' => [],
        ];
    }
}
