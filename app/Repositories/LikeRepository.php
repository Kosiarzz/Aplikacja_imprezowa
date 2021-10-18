<?php

namespace App\Repositories;

class LikeRepository
{
   
    public function like($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);
      
        return $likeable->users()->attach($request->user()->id);
    }
    
    public function unlike($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);
      
        return $likeable->users()->detach($request->user()->id);
    }

}
