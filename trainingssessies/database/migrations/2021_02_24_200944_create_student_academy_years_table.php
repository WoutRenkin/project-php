<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAcademyYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_academy_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('team_id')->nullable();
            $table->foreignId('academy_year_id');
            $table->string('self_evaluation_file')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('academy_year_id')->references('id')->on('academy_years')->onDelete('restrict')->onUpdate('restrict');
        });


        //TEAM 1
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 1,
                'academy_year_id' => 2,
                'team_id' => 1,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 2,
                'academy_year_id' => 2,
                'team_id' => 1,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 3,
                'academy_year_id' => 2,
                'team_id' => 1,

            ]
        );

        //TEAM 2
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 4,
                'academy_year_id' => 2,
                'team_id' => 2,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 5,
                'academy_year_id' => 2,
                'team_id' => 2,
            ]
        );

        //TEAM 3
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 6,
                'academy_year_id' => 2,
                'team_id' => 3,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 7,
                'academy_year_id' => 2,
                'team_id' => 3,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 8,
                'academy_year_id' => 2,
                'team_id' => 3,
            ]
        );
        //GEEN TEAM
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 9,
                'academy_year_id' => 2
            ]
        );

        //TEAM 4
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 10,
                'academy_year_id' => 2,
                'team_id' => 4,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 11,
                'academy_year_id' => 2,
                'team_id' => 4,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 12,
                'academy_year_id' => 2,
                'team_id' => 5,
            ]
        );
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 13,
                'academy_year_id' => 2,
                'team_id' => 5,
            ]
        );

        //NO TEAM
        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 14,
                'academy_year_id' => 2,
                'team_id' => null,
            ]
        );

        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 15,
                'academy_year_id' => 2,
                'team_id' => null,
            ]
        );

        DB::table('student_academy_years')->insert(
            [
                'created_at' => now(),
                'student_id' => 16,
                'academy_year_id' => 2,
                'team_id' => null,
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
        Schema::dropIfExists('student_academy_years');
    }
}
