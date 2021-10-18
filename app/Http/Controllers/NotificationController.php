<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->middleware('auth')->only(['notifications','setReadNotification','getNotShownNotify']);

        $this->notificationRepository = $notificationRepository;
    }

    public function notifications(Request $request)
    {
        $notifications = $this->bGateway->getNotifications($request, $request->user()->id);

        return view('user.notification',  ['notifications' => $notifications]);
    }

    public function setReadNotification(Request $request)
    {
        $reservation = $this->uRepository->setReadNotification($request);
    }

    public function getNotShownNotify(Request $request)
    {
        $reservation = $this->uRepository->checkNotificationStatus($request);
    }
}
