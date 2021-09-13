<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_kinds', function (Blueprint $table) {
            $table->id();
            $table->string('kind_name');
            $table->timestamps();
        });

        DB::table('user_kinds')->insert(
            [
                [
                    'kind_name' => 'Student',
                    'created_at' => now()
                ],
                [
                    'kind_name' => 'Coordinator',
                    'created_at' => now()
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
        Schema::dropIfExists('user_kinds');
    }
}
