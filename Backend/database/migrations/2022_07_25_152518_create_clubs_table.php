<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();

            $table->string('name',40)->nullable();
            $table->string('addres',40);
            $table->string('email',40)->unique();
            $table->string('logo',250)->nullable();
            $table->string('phone',30);
            $table->string('RRD',250);
            $table->date('fundation')->nullable();
            $table->string('name_terrain',30);

            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}
