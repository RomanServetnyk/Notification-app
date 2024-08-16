<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegistrationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route to register
Route::post('/register', [RegistrationController::class, 'register']);
// Route to trigger notification
Route::post('/trigger-notification', [NotificationController::class, 'triggerNotification']);

// Route to create a new notification type
Route::post('/notification-type', [NotificationController::class, 'createNotificationType']);

// Route to update an existing notification type
Route::put('/notification-type', [NotificationController::class, 'updateNotificationType']);
 
// Route to get all notification types
Route::get('/notification-types', [NotificationController::class, 'getAllNotificationType']);

// Route to delete a notification type
Route::delete('/notification-type', [NotificationController::class, 'deleteNotificationType']);

// Route to get notifications for a user
Route::get('/notifications', [NotificationController::class, 'getNotifications']);

// Route to subscribe a user to notifications
Route::post('/subscribe-notifications', [NotificationController::class, 'subscribeToNotifications']);

// Route to mark a notification as read
Route::put('/notification/read', [NotificationController::class, 'markAsReadNotification']);

