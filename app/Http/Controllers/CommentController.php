<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(CommentRepository $cRepository)
    {
        $this->middleware('auth')->only(['addComment']);

        $this->cRepository = $cRepository;
    }

    public function addComment($commentable_id, $type, Request $request)
    {
        $this->cRepository->addComment($commentable_id, $type, $request);
        
        return redirect()->back();
    }

    public function editComment($commentable_id, $type, Request $request)
    {
        $this->cRepository->editComment($commentable_id, $type, $request);
        
        return redirect()->back();
    }

    public function deleteComment($commentable_id, $type)
    {
        $this->cRepository->deleteComment($commentable_id, $type);
        
        return redirect()->back();
    }
}
