<?php

namespace App\Repositories;
use App\Models\Comment;
use App\Models\Business;
use Illuminate\Support\Carbon;

class CommentRepository
{
   
    public function addComment($commentable_id, $type, $request)
    {
        $commentable = $type::find($commentable_id);
        
        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->rating = $request->input('rating');
        $comment->updated_at = Carbon::now();
        $comment->created_at = Carbon::now();
        $comment->user_id = $request->user()->id;
        
        $commentable->comments()->save($comment);

        $rating = Comment::where('commentable_type', $type)->where('commentable_id', $commentable_id)->get();

        if(!$rating->isEmpty()){

            $avg = 0;
            foreach($rating as $rate)
            {
                $avg += $rate->rating['value'];   
            }
    
            $avg /= count($rating);
            
            Business::where('id', $commentable_id)->update([
                'rating' =>	$avg,
            ]);
        }
    }

    public function editComment($commentable_id, $type, $request)
    {
        Comment::where('commentable_id', $commentable_id)->where('commentable_type', $type)->where('user_id',auth()->user()->id)->update([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        $rating = Comment::where('commentable_type', $type)->where('commentable_id', $commentable_id)->get();

        if(!$rating->isEmpty()){

            $avg = 0;
            foreach($rating as $rate)
            {
                $avg += $rate->rating['value'];   
            }
    
            $avg /= count($rating);
            
            Business::where('id', $commentable_id)->update([
                'rating' =>	$avg,
            ]);
        }
    }

    public function deleteComment($commentable_id, $type)
    {
        Comment::where('commentable_id', $commentable_id)->where('commentable_type', $type)->where('user_id',auth()->user()->id)->delete();

        $rating = Comment::where('commentable_type', $type)->where('commentable_id', $commentable_id)->get();
        
        if(!$rating->isEmpty()){

            $avg = 0;
            foreach($rating as $rate)
            {
                $avg += $rate->rating['value'];   
            }
    
            $avg /= count($rating);
            
            Business::where('id', $commentable_id)->update([
                'rating' =>	$avg,
            ]);
        }
    }

}
