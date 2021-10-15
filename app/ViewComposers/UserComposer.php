<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class UserComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('notifications', Notification::where('notification_id', Auth::user()->id)->where('notification_type', 'App\Models\User')->where('status',0)->get());
    }
}

