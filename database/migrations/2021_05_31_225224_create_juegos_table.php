<?php

use App\Models\Juego;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuegosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Juego::TABLA, function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('empresa', 30);
            $table->set('plataforma', ['PC', 'Mobile', 'Nintendo Switch', 'Wii U', 'Nintendo 3DS', 'Playstation 5', 'Playstation 4', 'Playstation 3', 'Xbox One']);
            $table->date('releasedate');
            $table->set('generos', ['Aventura', 'Acción', 'Plataformas', 'Rol', 'FPS', 'Novela Gráfica', 'Estrategia', 'RPG', 'Musou', 'Realidad Virtual', 'Metroidvania', 'Roguelike', 'Deportes', 'Sandbox', 'Horror-Survival', 
                        'Fighting Game', 'Battle Royale']);
            $table->text('descripcion')->default('Este juego todavía no tiene descripción.');
            $table->binary('foto');
            $table->decimal('averagescore', 3, 2)->default(0);
            $table->timestamps();
        });
        
        $sql = 'alter table ' . Juego::TABLA . ' change foto foto mediumblob'; 
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juegos');
    }
}
