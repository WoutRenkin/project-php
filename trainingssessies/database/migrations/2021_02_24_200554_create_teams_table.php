<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->integer('name');
            $table->boolean('full')->default(false);
            $table->timestamps();
        });

        DB::table('teams')->insert(
            [
                [
                'created_at' => now(),
                'name' => 1,
                'full' => true
            ],
            [
                'created_at' => now(),
                'name' => 2,
                'full' => true
            ],
            [
                'created_at' => now(),
                'name' => 3,
                'full' => false
            ],
            [
                'created_at' => now(),
                'name' => 4,
                'full' => false
            ],
                [
                    'created_at' => now(),
                    'name' => 5,
                    'full' => false
                ],
                [
                    'created_at' => now(),
                    'name' => 6,
                    'full' => false
                ],
                [
                    'created_at' => now(),
                    'name' => 7,
                    'full' => false
                ]
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
        Schema::dropIfExists('teams');
    }
}
