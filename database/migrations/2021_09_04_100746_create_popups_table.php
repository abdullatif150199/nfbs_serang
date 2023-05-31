<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->enum('type', ['text', 'image', 'video']);
            $table->string('url')->nullable();
            $table->enum('status', ['show', 'hide'])->default('hide');
            $table->enum('frequency', ['every', 'once'])->comment('Every Load and Once Load');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popups');
    }
}
