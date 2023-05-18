<?php

namespace App\Http\Resources\Api\v1\User;

use App\Http\Resources\Api\v1\Comment\CommentCollection;
use App\Http\Resources\Tag\TagResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'lastname'          => $this->lastname,
            'phone'             => $this->phonenumber,
            'national_code'     => $this->national_code,
            'email'             => $this->email,
            'thumbnail'         => $this->image_path,
            'gender'            => $this->gender,
            'comments'          => new CommentCollection($this->whenLoaded('comments'))
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
