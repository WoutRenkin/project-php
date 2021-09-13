<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responsible_id')->nullable(); //de verantwoordelijke voor een sessie is een student_academy_year.
            $table->foreignId('team_id')->nullable();
            $table->foreignId('academy_year_id');
            $table->foreignId('status_id');
            $table->foreignId('organisation_id');
            $table->dateTime('date_time')->nullable();
            $table->string('subject');
            $table->string('file')->nullable();
            $table->string('feedback')->nullable();
            $table->integer('amount_cursisten')->nullable(); //?
            $table->string('profile_curstist')->nullable(); //?
            $table->string('expected_knowledge')->nullable();
            $table->string('goals')->nullable();
            $table->string('activities')->nullable();
            $table->string('infrastructure_materials')->nullable();
            $table->string('responsible_docent')->nullable(); //Geen FK?
            $table->binary('seen')->nullable();
            $table->timestamps();

            $table->foreign('responsible_id')->references('id')->on('student_academy_years')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('academy_year_id')->references('id')->on('academy_years')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('restrict')->onUpdate('restrict');


        });


        DB::table('sessions')->insert(
            [
                [
                    //'responsible_id' => , leeggelaten vanwegen onduidelijkheid
                    'team_id' => 1,
                    'academy_year_id' => 2,
                    'status_id' => 3,
                    'organisation_id' => 6,
                    'date_time' => new DateTime('2021-05-15 16:00:00'),
                    'subject' => "Geavanceerde python les",
                    'feedback' => "Geen opmerkingen.",
                    'amount_cursisten' => 20,
                    'profile_curstist' => "Doctoraat astrofysica",
                    'expected_knowledge' => "Goede achtergrond in python. Kennis over Keras en Tensorflow is mooi meegenomen.",
                    'goals' => "Planeet herkenning systeem via foto's",
                    'activities' => "Werken in groep.",
                    'infrastructure_materials' => "Schrijfgrief en een laptop",
                    'responsible_docent' => "Dirk De Peuter",
                    'seen' => true

                ]
                ,
                [
                    //'responsible_id' => , leeggelaten vanwegen onduidelijkheid
                    'team_id' => 2,
                    'academy_year_id' => 2,
                    'status_id' => 2,
                    'organisation_id' => 2,
                    'date_time' => new DateTime('2021-05-19 13:00:00'),
                    'subject' => "PHP les",
                    'feedback' => "Te weinig informatie.",
                    'amount_cursisten' => 40,
                    'profile_curstist' => "Eerstejaars studenten.",
                    'expected_knowledge' => "Een basis programmeren is een bonus.",
                    'goals' => "Een functionele webapp maken in php",
                    'activities' => "groepsproject",
                    'infrastructure_materials' => "Een potlood en een laptop",
                    'responsible_docent' => "Jan Janssens",
                    'seen' => true
                ],
                [
                    //'responsible_id' => , leeggelaten vanwegen onduidelijkheid
                    'team_id' => 4,
                    'academy_year_id' => 2,
                    'status_id' => 3,
                    'organisation_id' => 3,
                    'date_time' => new DateTime('2021-05-22 15:00:00'),
                    'subject' => "HTML les",
                    'feedback' => "Leuk voorstel, succes!",
                    'amount_cursisten' => 12,
                    'profile_curstist' => "Leerlingen 6de leerjaar.",
                    'expected_knowledge' => "Geen vereiste nodig.",
                    'goals' => "Een eerste webpagina met html en een beetje css.",
                    'activities' => "groepsproject",
                    'infrastructure_materials' => "Een laptop",
                    'responsible_docent' => "Dirk De Peuter",
                    'seen' => true
                ],
                [
                    //'responsible_id' => , leeggelaten vanwegen onduidelijkheid
                    'team_id' => 5,
                    'academy_year_id' => 2,
                    'status_id' => 1,
                    'organisation_id' => 7,
                    'date_time' =>  new DateTime('2021-05-22 12:00:00'),
                    'subject' => "Processing data",
                    'feedback' => null,
                    'amount_cursisten' => 50,
                    'profile_curstist' => "Wetenschappers",
                    'expected_knowledge' => "Een basis programeren is een bonus.",
                    'goals' => "Leren data te verwerken met bash/python.",
                    'activities' => "groepsproject",
                    'infrastructure_materials' => "Een laptop",
                    'responsible_docent' => "Michael Cloots",
                    'seen' => false
                ],

            ]

        );

        DB::table('sessions')->insert(
            [
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 7,
                    'subject' => "Visualiseren van data",
                    'file' => "visualising_data_earth300.pdf",
                ],
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 5,
                    'subject' => "Basis Angular",
                    'file' => "basis_angular_sterrenwacht.pdf",
                ],
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 4,
                    'subject' => "Eerste les word",
                    'file' => "word_babbelberg.pdf",
                ],
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 1,
                    'subject' => "Keras en tensorflow",
                    'file' => "keras_kuleuven.pdf",
                ],
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 3,
                    'subject' => "Powerpoint",
                    'file' => "powerpoint_sint_jan.pdf",
                ],
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 1,
                    'subject' => "Java advanced",
                    'file' => "java_kuleuven.pdf",
                ],
                [
                    'academy_year_id' => 2,
                    'status_id' => 4,
                    'organisation_id' => 6,
                    'subject' => "Netwerken in de ruimte",
                    'file' => "netwerken_spacex.pdf",
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
        Schema::dropIfExists('sessions');

    }

}
