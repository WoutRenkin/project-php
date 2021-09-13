<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_kind_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('r_number')->nullable();
            $table->string('tel')->nullable();
            $table->boolean('active')->default(false)->nullable();
            $table->boolean('reflection_uploaded')->default(false)->nullable();
            $table->boolean('session_voorstel_uploaded')->default(false)->nullable();
            $table->boolean('session_aanvraag_uploaded')->default(false)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Foreign key relation
            $table->foreign('user_kind_id')->references('id')->on('user_kinds')->onDelete('cascade')->onUpdate('cascade');
        });

        //Team 1 - 3 studenten
        DB::table('users')->insert(
            [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Wout",
                'last_name' => "Renkin",
                'r_number' => "r0631168",
                'tel' => '0471234567',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "wout.renkin@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()

            ]
        );
        DB::table('users')->insert(
            [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Gianni",
                'last_name' => "Andries",
                'r_number' => "r0732268",
                'tel' => '0471234567',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "gianni.andries@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert(  [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Bram",
                'last_name' => "Vermeulen",
                'r_number' => "r0242342",
                'tel' => '0471234567',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "bram.vermeulen@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()

            ]
        );
        //team 2 - 2 studenten

        DB::table('users')->insert([
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Simon",
                'last_name' => "Janssens",
                'r_number' => "r0702342",
                'tel' => '0471234567',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "simon.janssens@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()

            ]
        );
        DB::table('users')->insert( [
            'created_at' => now(),
            'user_kind_id' => 1,
            'first_name' => "Ruben",
            'last_name' => "Stuyck",
            'r_number' => "r0502321",
            'tel' => '0471234567',
            'active' => true,
            //rest van de booleans staan default juist.
            'email' => "ruben.stuyck@hotmail.com",
            'password' => Hash::make('secret'),
            'email_verified_at' => now()
            ]
        );

        //team 3 - 3 studenten
        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Morgan",
                'last_name' => "Freeman",
                'r_number' => "r0397071",
                'tel' => '+32 467 56 70 16',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Morgan.Freeman@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "David",
                'last_name' => "Attenborough",
                'r_number' => "r0618429",
                'tel' => '+32 460 69 75 98',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "David.Attenborough@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Neil",
                'last_name' => "Tyson",
                'r_number' => "r0991621",
                'tel' => '+32 493 14 31 66',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Neil.Tyson@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        //Student zonder team

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Neil",
                'last_name' => "Armstrong",
                'r_number' => "r0467341",
                'tel' => '+32 475 75 08 13',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Neil.Armstrong@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );


        //Team 4 - 2 studenten

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Fox",
                'last_name' => "Stevenson",
                'r_number' => "r0476712",
                'tel' => '+32 466 37 71 85',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Fox.Stevenson@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Tom",
                'last_name' => "Hardy",
                'r_number' => "r0861800",
                'tel' => '+32 477 72 85 77',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Tom.Hardy@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        //Team 5 - 2 studenten
        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Tony",
                'last_name' => "Stark",
                'r_number' => "r0161800",
                'tel' => '+32 222 22 85 77',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Tony.Stark@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Jason",
                'last_name' => "Momoa",
                'r_number' => "r0666600",
                'tel' => '+32 262 26 65 67',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Jason.Momoa@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        //Student zonder team
        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Julia",
                'last_name' => "Moch",
                'r_number' => "r0646400",
                'tel' => '+32 242 24 45 47',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Julia.Moch@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        //Studenten zonder team
        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Brain",
                'last_name' => "Greene",
                'r_number' => "r0644400",
                'tel' => '+32 666 24 23 17',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Brain.Greene@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Tom",
                'last_name' => "Hanks",
                'r_number' => "r0141410",
                'tel' => '+32 366 14 13 17',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Tom.Hanks@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        DB::table('users')->insert( [
                'created_at' => now(),
                'user_kind_id' => 1,
                'first_name' => "Denzel",
                'last_name' => "Washington",
                'r_number' => "r0444457",
                'tel' => '+32 431 47 83 87',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "Denzel.Washington@hotmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()
            ]
        );

        //ADMINS

        DB::table('users')->insert(  [
                'created_at' => now(),
                'user_kind_id' => 2,
                'first_name' => "Wout",
                'last_name' => "Renkin",
                'r_number' => "r0681168",
                'tel' => '0471234222',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "wout.renkin@gmail.com",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()

            ]
        );

        DB::table('users')->insert(  [
                'created_at' => now(),
                'user_kind_id' => 2,
                'first_name' => "Admin",
                'last_name' => "Renkin",
                'r_number' => "r0631168",
                'tel' => '0471234222',
                'active' => true,
                //rest van de booleans staan default juist.
                'email' => "admin@admin.be",
                'password' => Hash::make('secret'),
                'email_verified_at' => now()

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
        Schema::dropIfExists('users');
    }
}
