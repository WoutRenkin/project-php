<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anouncements', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable();
            $table->binary('file')->nullable();
            $table->string('message');
            $table->string('subject');
            $table->string('recipients')->nullable();
            $table->timestamps();
        });

        DB::table('anouncements')->insert(
            [
                'created_at' => now(),
                'message' => "Wegens de Corona maatregelen zullen er heel wat lessen geschrapt worden.",
                'subject' => "Corona maatregelen"

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
        Schema::dropIfExists('anouncements');
    }
}
