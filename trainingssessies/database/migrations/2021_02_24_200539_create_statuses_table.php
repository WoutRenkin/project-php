<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('description'); //misschien is 'name' consistenter?
            $table->timestamps();
        });

        DB::table('statuses')->insert(
            [
                [
                    'created_at' => now(),
                    'description' => "Aangevraagd" //wanneer een team dit aanvraagd
                ],
                [
                    'created_at' => now(),
                    'description' => "Afgekeurd" // wanneer een admin het voorstel afkeurd
                ],
                [
                    'created_at' => now(),
                    'description' => "Goedgekeurd" // wanneer een admin het voorstel goedkeurd
                ],
                [
                    'created_at' => now(),
                    'description' => "Beschikbaar" //wanneer een admin dit aanmaakt
                ],
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
        Schema::dropIfExists('statuses');
    }
}
