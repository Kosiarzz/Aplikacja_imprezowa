<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class AppComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('eventSession', Event::where('id',session('event'))->get());
    }
}

