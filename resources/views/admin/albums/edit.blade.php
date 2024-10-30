@extends('adminlte::page')

@section('content')
    <h1>Crear Nueva Galería</h1>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        @if ($album->id)
            @method('PATCH')
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="form-row">
                    <label>Titulo</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $album->title }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-row">
                    <label>Sección</label>
                    <input type="text" class="form-control" name="section" value="{{ old('section') ?? $album->section }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label>Descripción</label>
                    </div>
                    <div class="col-md-12">
                        <textarea name="description" class="summernote">{{ old('description') ?? $album->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Ancho en píxeles</label>
                    <input type="numbre" class="form-control" name="width" value="{{ old('width') ?? $album->width }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label>Alto en píxeles</label>
                    <input type="numbre" class="form-control" name="height" value="{{ old('height') ?? $album->height }}" required>
                </div>
            </div>
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-large mt-3">Guardar Cambios</button>
        </div>

    </form>

@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
    $('.summernote').summernote({
        placeholder: 'write here...'
      });
    </script>
@stop
