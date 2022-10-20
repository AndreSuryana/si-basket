<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referee_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referee_id');
            $table->foreignId('level_id');
            $table->foreignId('city_id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('position');
            $table->string('document_path')->nullable(true)->default(null);
            $table->string('verified_status')->default('pending');
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
        Schema::dropIfExists('referee_events');
    }
}
