<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->comment("message token");
            $table->enum('user_type',['0','1'])->default("1")->comment("sender user type 0 = guest, 1 = registered");
            $table->string('ip_addr')->comment("sender ip address")->nullable();
            $table->text('content')->comment("message content");
            $table->enum('isPrivate',['0','1'])->default("0")->comment("is private 1 = private, 0 = public");
            $table->enum('type',['1','2','3'])->default("1")->comment("message type 1 = text, 2 = image, 3 = video");
            $table->enum('is_read',['0','1'])->default("0")->comment("message read status  1 = yes , 0 = no");
            $table->dateTime('read_at')->nullable()->comment("message read date time");
            $table->string('password')->nullable()->comment("message encrypt password");
            $table->integer('duration')->comment("message duration");
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
        Schema::dropIfExists('messages');
    }
}
