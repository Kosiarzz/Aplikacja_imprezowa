<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $uRepository)
    {
        $this->uRepository = $uRepository;
    }

    public function index()
    {
        return view('user.index');
    }

    public function profile()
    {
        $data = $this->uRepository->getProfileUser(Auth::user()->id);
        return view('user.profile', ['user' => $data]);
    }

    public function like()
    {
        return view('user.like');
    }

    public function events()
    {
        return view('user.events');
    }
}
