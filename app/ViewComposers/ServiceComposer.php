<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ServiceComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('notifications', Notification::where('notification_id', session('service'))->where('notification_type', 'App\Models\Business')->where('status', 0)->get());
    }
}

