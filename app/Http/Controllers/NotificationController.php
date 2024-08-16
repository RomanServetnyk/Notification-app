<?php

// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Jobs\SendNotificationJob;
use App\Jobs\RealTimeNotificationJob;
use Illuminate\Http\Request;
use App\Models\NotificationType;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{

    public function __construct(){

    }

    public function triggerNotification(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'type' => 'required|int|exists:notification_types,type',
        //     'message' => 'required|string',
        // ]);
        $users = User::all();
        $notificationType = $request->input('type');
        $message = $request->input('message');
        Log::debug("creating notification");
        foreach($users as $user) {
            if ($user->notificationTypes()->where('id', $notificationType)->exists()) {
                $notification = Notification::create([
                    'user_id' => $user->id,
                    'type' => $notificationType,
                    'message' => $message,
                    'status' => 'pending',
                ]);
    
                SendNotificationJob::dispatch($user, $notification);
    
            }    
        }
        RealTimeNotificationJob::dispatch($notification);
        return response()->json(['status' => 'Notification queued successfully!']);
    }

    public function createNotificationType(Request $request){
        Log::debug("creating notification type ===>");
        $notification_type = $request->input('notification_type');

        $notificationType = NotificationType::create([
            'type'=>$notification_type
        ]);
        return $notificationType;
    }

    public function updateNotificationType(Request $request){
        $notification_id = $request->input('notification_id');
        $notification_type = $request->input('notification_type');
        $notificationType = NotificationType::findOrFail($notification_id);
        $notificationType->type = $notification_type;
        $notificationType->save();
        return $notificationType;
    }


    public function getAllNotificationType(Request $request){
        $notificationTypes = NotificationType::all();
        return $notificationTypes;
    }

    public function deleteNotificationType(Request $request){
        $notificationType = NotificationType::findOrFail($request->input('notification_type_id'));
        $notificationType->destroy();
        return response()->json([
            'message' => 'Deleted successfully.',
        ]);
    }

    public function getNotifications(Request $request){
        $notifications = Notification::where('user_id', $request->input('user_id'))->where('status', 'sent')->get();
        return $notifications;
    }

    public function subscribeToNotifications(Request $request){
        $user = User::findOrFail($request->input('user_id'));
        //todo: process array
        $notificationTypes = $request->input('types');
        foreach($notificationTypes as $type){
            $notificationType = NotificationType::findOrFail($type);
            $user->notificationTypes()->attach($notificationType->id);
            $user->save();
        }
    }

    public function markAsReadNotification(Request $request){
        $notification = Notification::findOrFail($request->input('notification_id'));
        $notification->status = 'read';
        $notification->save();
        return $notification;
    }

}

