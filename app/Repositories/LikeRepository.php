<?php

namespace App\Repositories;

use App\Models\Statistic;
use Illuminate\Support\Carbon;

class LikeRepository
{
   
    public function like($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);

        if($type = "App\Models\Business")
        {
            $date = Carbon::now();

            Statistic::firstOrCreate([
                "business_id" => $likeable_id,
                "date" => $date->toDateString(),
            ])->increment('likes', 1);
        }

        return $likeable->users()->attach($request->user()->id);
    }
    
    public function unlike($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);
      
        if($type = "App\Models\Business")
        {
            $date = Carbon::now();

            Statistic::firstOrCreate([
                "business_id" => $likeable_id,
                "date" => $date->toDateString(),
            ])->decrement('likes', 1);
        }

        return $likeable->users()->detach($request->user()->id);
    }

}
