<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('notifications', static function (Blueprint $table) {
            $table->unsignedBigInteger('type')->change();

            // Define the foreign key constraint
            $table->foreign('type')->references('id')->on('notification_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('notifications', static function (Blueprint $table) {
            $table->string('type')->change();
        });
    }
};
