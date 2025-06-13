<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('local_government')->nullable();
            $table->string('profile_photo')->nullable();
            $table->text('bio')->nullable();
            $table->json('preferences')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'state',
                'local_government',
                'profile_photo',
                'bio',
                'preferences'
            ]);
        });
    }
};
