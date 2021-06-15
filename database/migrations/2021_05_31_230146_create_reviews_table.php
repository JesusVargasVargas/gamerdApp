<?php

use App\Models\Juego;
use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Review::TABLA, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser'); 
            $table->unsignedBigInteger('idjuego');
            $table->enum('estado', ['Completado', 'Jugando', 'Abandonado', 'Pendiente']);
            $table->decimal('score', 2, 1)->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('favorito')->default(false);
            $table->timestamps();
            //tabla review 1, tabla user n 
            $table->foreign('iduser')->references('id')->on(User::TABLA); 
            //tabla review 1, tabla juego n 
            $table->foreign('idjuego')->references('id')->on(Juego::TABLA); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
