<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('tel_number');
            $table->string('contact_person');
            $table->string('description')->nullable();
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('organisations')->insert(
            //Organisaties zijn geen scholen volgnes mij dus deze data moet nog eens herbekeken worden.
            [
                [
                    'created_at' => now(),
                    'name' => "KU Leuven",
                    'email' => "kuleuven@info.be",
                    'tel_number' => "+32 16 3 24010",
                    'contact_person' => "Rik Torfs",
                    'description' => "katholieke universiteit waarvan de hoofdcampus gevestigd is in de Belgische stad Leuven.",
                    'place' => "Leuven",
                    'address' => "Leuvenstraat 2",
                    'active' => true
                ],
                [
                    'created_at' => now(),
                    'name' => "Thomas More",
                    'email' => "thomasmore@info.be",
                    'tel_number' => "+32 16 3 24011",
                    'contact_person' => "Michael Cloots",
                    'description' => "Thomas More is een Vlaamse katholieke hogeschool. De hogeschool biedt professionele bachelors en graduaten aan op 14 campussen in 9 gemeenten in de provincie Antwerpen.",
                    'place' => "Geel",
                    'address' => "Geelstraat 2",
                    'active' => true
                ],
                [
                    'created_at' => now(),
                    'name' => "Sint Jan Lagere school",
                    'email' => "sintjan@info.be",
                    'tel_number' => "+32 496 32 84 97",
                    'contact_person' => "Simon Simonson",
                    'description' => "Een klein lagere school gelegen te Wiekevorst",
                    'place' => "Wiekevorst",
                    'address' => "Advocate straat 5",
                    'active' => true
                ],

                [
                    'created_at' => now(),
                    'name' => "Babbelberg",
                    'email' => "babbelberg@info.be",
                    'tel_number' => "+32 491 33 44 83",
                    'contact_person' => "Jeff Jefferson",
                    'description' => "Inburgering voor immigranten.",
                    'place' => "Heist-Op-Den-Berg",
                    'address' => "Grote Steenweg 21",
                    'active' => true
                ],

                [
                    'created_at' => now(),
                    'name' => "Sterrenwacht Belgie",
                    'email' => "sterrenwacht@info.be",
                    'tel_number' => "+32 462 14 95 08",
                    'contact_person' => "Leonardo Di Caprio",
                    'description' => "Sterrenwacht in Brussel. Verantwoordelijk voor het monitoren van de zon.",
                    'place' => "Brussel",
                    'address' => "Galaxy 21",
                    'active' => true
                ],
                [
                    'created_at' => now(),
                    'name' => "SpaceX",
                    'email' => "spaceX@info.be",
                    'tel_number' => "+32 467 13 78 76",
                    'contact_person' => "Elon Musk",
                    'description' => "Gaat internet brengen over heel de wereld. Ambitie om naar de maan te gaan en naar mars.",
                    'place' => "Mars",
                    'address' => "Isidis Planitia 1",
                    'active' => true
                ],
                [
                    'created_at' => now(),
                    'name' => "Earth 300",
                    'email' => "saveclimate@info.be",
                    'tel_number' => "+32 467 24 24 24",
                    'contact_person' => "Greta Thunberg",
                    'description' => "Nucleair schip dat data gaat verzamelen gerelateerd met klimaat verandering.",
                    'place' => "Pacific Ocean",
                    'address' => "Mariana Trench 1",
                    'active' => true
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
        Schema::dropIfExists('organisations');
    }
}
