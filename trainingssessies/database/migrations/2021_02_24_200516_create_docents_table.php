<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docents', function (Blueprint $table) {
            $table->id();
            //Deze tabel lijkt mij overbodig aangezien er een user tabel is en een User_kind tabel
            //Nog te overlopen dus.
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        for ($i = 0; $i <= 10; $i++) {
            DB::table('docents')->insert(
                [
                    'created_at' => now(),
                    'name' => "Docent $i",
                    'active' => true
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docents');
    }
}
