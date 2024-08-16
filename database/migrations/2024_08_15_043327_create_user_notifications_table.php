<?php

// database/migrations/yyyy_mm_dd_create_user_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('notification_type_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('notification_type_id')->references('id')->on('notification_types')->onDelete('cascade');
            $table->primary(['user_id', 'notification_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
}
