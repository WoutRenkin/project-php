<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docent_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('session_id');
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('restrict')->onUpdate('restrict');
        });

        DB::table('docent_sessions')->insert( [
                'created_at' => now(),
                'first_name' => 'Dirk',
                'last_name' => 'De Peuter',
                'session_id' => 1,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docent_sessions');
    }
}
