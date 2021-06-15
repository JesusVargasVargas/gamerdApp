@extends('layouts.app')

@section('content')
<form action="{{ url('review/store') }}" method="post" enctype="multipart/form-data"> 
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="idjuego">Juego</label>
            @error('idjuego')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <select name="idjuego" id="idjuego" required class="form-control">
                <option value="" disabled @if(is_null(old('juego'))) selected @endif>Seleccione un juego</option>
                @foreach($juegos as $id => $juego) 
                    <option value="{{ $juego->id }}" @if(old('juego') == $id) selected @endif>{{ $juego->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            @error('estado')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <select name="estado" id="estado" required class="form-control">
                <option value="" disabled @if(is_null(old('estado'))) selected @endif>Seleccione el estado del juego</option>
                @foreach($estados as $id => $estado) 
                    <option value="{{ $id }}" @if(old('estado') == $id) selected @endif>{{ $estado }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="score">Puntuación</label>
            @error('score')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="number" step="0.1" min="0" max="10" class="form-control" id="score" placeholder="Puntuación" name="score" value="{{ old('score') }}">
        </div>
        <div class="form-group">
            <label for="comentario">Comentario</label>
            @error('comentario')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="textarea" maxlength="100000" class="form-control" id="comentario" placeholder="Añada un comentario opcional" name="comentario" value="{{ old('comentario') }}">
        </div>
        <div class="form-group">
            <label for="favorito">Favorito</label>
            @error('favorito')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="radio" class="form-control" id="favorito" name="favorito" value="1"> Sí
            <input type="radio" class="form-control" id="nofavorito" name="favorito" value="0" checked> No
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection