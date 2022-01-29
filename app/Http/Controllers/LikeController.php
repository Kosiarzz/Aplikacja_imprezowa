<?php

namespace App\Http\Controllers;

use App\Repositories\LikeRepository;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(LikeRepository $lRepository)
    {
        $this->middleware('auth')->only(['like','unlike']);

        $this->lRepository = $lRepository;
    }

    public function like($likeable_id, $type, Request $request)
    {
        $this->lRepository->like($likeable_id, $type, $request);

        return redirect()->back();
    }
    
    public function unlike($likeable_id, $type, Request $request)
    {
        $this->lRepository->unlike($likeable_id, $type, $request);
        
        return redirect()->back();
    }
}