<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWritingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_writing', function (Blueprint $table) {
            $table->foreignId('user')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('writing')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->text('student_writing');
            $table->text('check_writing');
            $table->decimal('mark', 8, 2);
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
        Schema::dropIfExists('user_writing');
    }
}
