<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('twochat_id')->nullable()->unique();
            $table->string('source')->nullable();
            $table->string('currency')->nullable();
            $table->string('availability')->nullable();
            $table->string('image_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['twochat_id', 'source', 'currency', 'availability', 'image_url']);
        });
    }
};
