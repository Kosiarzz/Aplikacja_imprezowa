<?php

namespace App\Repositories;
use App\Models\Comment;

class CommentRepository
{
   
    public function addComment($commentable_id, $type, $request)
    {
        $commentable = $type::find($commentable_id);
        
        $comment = new Comment;
        
        $comment->content = $request->input('content');
        $comment->rating = $request->input('rating');
        $comment->user_id = $request->user()->id;
        
        return $commentable->comments()->save($comment);
    }

}
