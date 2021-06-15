@extends('layouts.app')

@section('content')
<form action="{{ url('juego/store') }}" method="post" enctype="multipart/form-data"> 
    @csrf
    <div class="card-body" style="line-height:130%;">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" minLength="1" maxlength="50" class="form-control" id="nombre" placeholder="Nombre del juego" name="nombre" value="{{ old('nombre') }}">
        </div>
        <div class="form-group">
            <label for="empresa">Empresa</label>
            @error('empresa')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" minLength="1" maxlength="50" class="form-control" id="empresa" placeholder="Empresa" name="empresa" value="{{ old('empresa') }}">
        </div>
        <div class="form-group">
            <label for="plataforma">Plataforma: </label>
            @error('plataforma')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @foreach($plataformas as $id => $plataforma) 
                <input type="checkbox" name="plataforma[]" value="{{ $plataforma }}">{{ $plataforma }}
            @endforeach
        </div>
        <div class="form-group">
            <label for="releasedate">Fecha de salida</label>
            @error('releasedate')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="date" class="form-control" id="releasedate" name="releasedate" value="{{ old('releasedate') }}">
        </div>
        <div class="form-group">
            <label for="generos">Géneros: </label>
            @error('generos')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @foreach($generos as $id => $genero) 
                <input type="checkbox" name="generos[]" value="{{ $genero }}">{{ $genero }}
            @endforeach
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            @error('descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <textarea style="width:90%;height:150px;" maxlength="10000" class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="form-group">
            <label for="foto">Foto</label>
            @error('foto')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="file" accept=".png,.jpg,.jpeg,.gif,.webp" class="form-control" id="foto" name="foto" value="{{ old('foto') }}">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection

