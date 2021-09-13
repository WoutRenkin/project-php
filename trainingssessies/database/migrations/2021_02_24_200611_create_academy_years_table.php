<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademyYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_years', function (Blueprint $table) {
            $table->id();
            $table->string('name_year');
            $table->boolean('active')->default(true);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });

        DB::table('academy_years')->insert(
            [
                [
                    'name_year' => "2019-2020",
                    'active' => false,
                    'start_date' => new DateTime('2019-09-01'),
                    'end_date' => new DateTime('2020-08-31'),
                    'created_at' => now()
                ],
                [
                    'name_year' => "2020-2021",
                    'active' => true,
                    'start_date' => new DateTime('2020-09-01'),
                    'end_date' => new DateTime('2021-08-31'),
                    'created_at' => now()
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
        Schema::dropIfExists('academy_years');
    }
}
