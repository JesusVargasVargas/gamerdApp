<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Review;
use Illuminate\Http\Request;
use Storage;
use App\Http\Requests\JuegoCreateRequest;
use App\Http\Requests\JuegoEditRequest;


class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    /*public function __construct()
    {
         $this-> middleware('admin', ['only' => ['create', 'edit']]);
    } */
     
    public function index(Request $request) //hacer checkboxes en vez de enlaces para el orden¿
    {
        
        //$juegos = Juego::paginate(5);
        $juegos = new Juego();
        $search = $request->input('search');
        if($search !== null) {
            $juegos = $juegos->where('nombre', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        }
        $sort = $request->input('sort');
        if($sort == null) {
            $juegos = $juegos->paginate(5);
        } else {
            $juegos = $juegos->orderBy('nombre', $sort)->paginate(5); //sobra¿
        }

        
        return view('juego.index')->with(['juegos' => $juegos, /*'fotos' => $fotos,*/ 'search' => $search, 'sort' => $sort]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plataformas = ['PC' => 'PC', 'Mobile' => 'Mobile', 'Nintendo Switch' => 'Nintendo Switch', 'Wii U' => 'Wii U', 'Nintendo 3DS' => 'Nintendo 3DS', 'Playstation 5' => 'Playstation 5', 'Playstation 4' => 'Playstation 4',
            'Playstation 3' => 'Playstation 3', 'Xbox One' => 'Xbox One'];
        $generos = ['Aventura' => 'Aventura', 'Acción' => 'Acción', 'Plataformas' => 'Plataformas', 'Rol' => 'Rol', 'FPS' => 'FPS', 'Novela Gráfica' => 'Novela Gráfica', 'Estrategia' => 'Estrategia', 'RPG' => 'RPG',
            'Musou' => 'Musou', 'Realidad Virtual' => 'Realidad Virtual', 'Metroidvania' => 'Metroidvania', 'Roguelike' => 'Roguelike', 'Deportes' => 'Deportes', 'Sandbox' => 'Sandbox', 'Horror-Survival' => 'Horror-Survival',
            'Fighting Game' => 'Fighting Game', 'Battle Royale' => 'Battle Royale'];
        return view('juego.create')->with(['plataformas' => $plataformas, 'generos' => $generos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JuegoCreateRequest $request)
    {
        $resultadoplataformas = '';
        $plataformasseleccionadas = $request->input('plataforma');
        foreach($plataformasseleccionadas as $plataformaseleccionada){
            $resultadoplataformas = $resultadoplataformas . $plataformaseleccionada . ',';
        }
        $resultadoplataformas = substr($resultadoplataformas, 0, -1);
        
        $resultadogeneros = '';
        $generosseleccionados = $request->input('generos');
        foreach($generosseleccionados as $generoseleccionado){
            $resultadogeneros = $resultadogeneros . $generoseleccionado . ',';
        }
        $resultadogeneros = substr($resultadogeneros, 0, -1);

        $juego = new Juego($request->all());
        $juego->plataforma = $resultadoplataformas;
        $juego->generos = $resultadogeneros;
        
        if($request->hasFile('foto') && $request->file('foto')->isValid()) {
             $archivo = $request->file('foto');
             
             $nombre = $archivo->getClientOriginalName();
             $archivo->move('img/', $juego->nombre.'.jpg');
             
             /*$path = $archivo->getRealPath();
             $imagen = file_get_contents($path);
             $juego->foto = base64_encode($imagen);*/
        }

        $juego->save();   
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    public function show(Juego $juego)
    {
        return view('juego.show')->with(['juego' => $juego]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    public function edit(Juego $juego)
    {
        $plataformas = ['PC' => 'PC', 'Mobile' => 'Mobile', 'Nintendo Switch' => 'Nintendo Switch', 'Wii U' => 'Wii U', 'Nintendo 3DS' => 'Nintendo 3DS', 'Playstation 5' => 'Playstation 5', 'Playstation 4' => 'Playstation 4',
            'Playstation 3' => 'Playstation 3', 'Xbox One' => 'Xbox One'];
        $generos = ['Aventura' => 'Aventura', 'Acción' => 'Acción', 'Plataformas' => 'Plataformas', 'Rol' => 'Rol', 'FPS' => 'FPS', 'Novela Gráfica' => 'Novela Gráfica', 'Estrategia' => 'Estrategia', 'RPG' => 'RPG',
            'Musou' => 'Musou', 'Realidad Virtual' => 'Realidad Virtual', 'Metroidvania' => 'Metroidvania', 'Roguelike' => 'Roguelike', 'Deportes' => 'Deportes', 'Sandbox' => 'Sandbox', 'Horror-Survival' => 'Horror-Survival',
            'Fighting Game' => 'Fighting Game', 'Battle Royale' => 'Battle Royale'];
            
        $plataformasseleccionadas = explode( ',' ,  $juego->plataforma , 9 );
        $generosseleccionados = explode( ',' ,  $juego->generos , 17 );

        return view('juego.edit')->with(['plataformas' => $plataformas, 'generos' => $generos, 'juego' => $juego, 'plataformasseleccionadas' => $plataformasseleccionadas, 'generosseleccionados' => $generosseleccionados,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Juego $juego)
    {
        
        $resultadoplataformas = '';
        $plataformasseleccionadas = $request->input('plataforma');
        foreach($plataformasseleccionadas as $plataformaseleccionada){
            $resultadoplataformas = $resultadoplataformas . $plataformaseleccionada . ',';
        }
        $resultadoplataformas = substr($resultadoplataformas, 0, -1);
       
        $resultadogeneros = '';
        $generosseleccionados = $request->input('genero');
        foreach($generosseleccionados as $generoseleccionado){
            $resultadogeneros = $resultadogeneros . $generoseleccionado . ',';
        }
        $resultadogeneros = substr($resultadogeneros, 0, -1);

        //$juego = new Juego($request->all());
        //$juego = Juego::where('nombre', $request->input('nombre') )->where('empresa', $request->input('empresa') );
        
        $juego->nombre = $request->input('nombre');
        $juego->empresa = $request->input('empresa');
        $juego->releasedate = $request->input('releasedate');
        $juego->descripcion = $request->input('descripcion');
        
        $juego->plataforma = $resultadoplataformas;
        $juego->generos = $resultadogeneros;
        
        //$juego->foto = null; //por si tarda en actualizar
        
        if($request->hasFile('foto') && $request->file('foto')->isValid()) {
             $archivo = $request->file('foto');
             
             $nombre = $archivo->getClientOriginalName();
             $archivo->move('img/', $juego->nombre.'.jpg');

            
        }
       
        /*  --------------   AVERAGE SCORE   ------------------      */
        $reviews = Review::all();
        $sum= 0.0;
        $cont= 0;
        
        foreach($reviews as $review){
            if($review->idjuego == $juego->id && isset($review->score) && $review->score > 0){
                $sum = $sum + $review->score;
                $cont++;
            }
            
        }
        //$juego->averagescore = $sum/$cont;

        $juego->save();   
        return redirect('juego/'.$juego->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Juego  $juego
     * @return \Illuminate\Http\Response
     */
    public function destroy(Juego $juego)
    {
        //
    }
    
    
    /*private function reduceImagen($img){
        $img->resize(200, null, function ($constraint){ //pixeles
            $constraint->aspectRatio();
        }); 
        return $img;
    }
    
    
    private function getFotos($juegos){
        $fotos = [];
        foreach($juegos as $juego){
            if($juego->foto == null){
                $fotos[$juego->id] = null;
            } else {
                $fotos[$juego->id] = $this->getFirstFile($juego);
            }
        }
        return $fotos;
    }
    
    private function getFirstFile(Juego $juego){
        $file = null;
        $files = $this->getFiles($juego);
        if(isset($files[0])){
            $file = $files[0];
        } 
        return $file;
    }
    
    private function getFiles(Juego $juego){
        return Storage::files('resources/img/' . $juego->id);
    }*/
}
