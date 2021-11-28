<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiveMinuteJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('five_minute_journals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedInteger('admin_id')->default(0);
            $table->date('date')->nullable();
            $table->date('day')->nullable();
            $table->text('grateful')->nullable();
            $table->text('habit')->nullable();
            $table->text('dream')->nullable();
            $table->text('tasks')->nullable();
            $table->text('affirmations')->nullable();
            $table->text('feeling')->nullable();
            $table->text('dont_waste')->nullable();
            $table->text('fav_things')->nullable();
            $table->text('must_accomplish')->nullable();
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
        Schema::dropIfExists('five_minute_journals');
    }
}
