@extends('layouts.app')

@section('content')
<form action="{{ url('review/update/'.$review->id) }}" method="post" enctype="multipart/form-data"> 
    @method('put')
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="estado">Estado</label>
            @error('estado')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <select name="estado" id="estado" required class="form-control">
                @foreach($estados as $estado) 
                    <option value="{{ $estado }}" @if($estado == $review->estado) selected @endif >{{ $estado }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="score">Puntuación</label>
            @error('score')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="number" step="0.1" min="0" max="10" class="form-control" id="score" name="score" value="{{ old('score', $review->score) }}">
        </div>
        <div class="form-group">
            <label for="comentario">Comentario</label>
            @error('comentario')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="textarea" maxlength="100000" class="form-control" id="comentario" name="comentario" value="{{ old('comentario', $review->comentario) }}" style="width:90%;">
        </div>
        <div class="form-group">
            <label for="favorito">Favorito</label>
            @error('favorito')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="radio" class="form-control" id="favorito" name="favorito" value="1"  @if($review->favorito == 1) checked @endif> Sí
            <input type="radio" class="form-control" id="nofavorito" name="favorito" value="0"  @if($review->favorito != 1) checked @endif> No
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection