<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function edit(){
        return view('user/edit')->with(['user' => auth()->user()]);
    }
    
    public function update(Request $request)
    {
        
        $user = auth()->user();
        
        $user->name = $request->input('name'); 
        $user->email = $request->input('email');
        
        if($request->input('newpassword') != null && $request->input('newpassword') == $request->input('newpassword_confirmation') ){
            if( $request->input('password') == $user->password){
                $user->password = $request->input('newpassword');       
            }
        }
        
        $user->biografia = $request->input('biografia');
        if($request->hasFile('foto') && $request->file('foto')->isValid()) {
             $archivo = $request->file('foto');
             
             $nombre = $archivo->getClientOriginalName();
             $archivo->move('img/', $user->email.'.jpg');
             
             $path = $archivo->getRealPath();
             /*$imagen = file_get_contents($path);
             
             $user->fotoperfil = base64_encode($imagen); */
             
        } else {
            $user->fotoperfil = null;  
        }
        $user->save();
        return redirect('user/'.$user->id);
    }
}
