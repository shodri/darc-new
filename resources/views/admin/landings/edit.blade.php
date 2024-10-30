@extends('layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1>{{ $title }}</h1>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        @csrf
        @if ($landing->id)
            @method('PATCH')
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-row">
            <label>Titulo</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') ?? $landing->title }}" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Url</label>
                    <input type="text" class="form-control" name="url" value="{{ old('url') ?? $landing->url }}"
                        required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label>Sitio Base</label>
                    <input type="text" class="form-control" name="site_base"
                        value="{{ old('site_base') ?? $landing->site_base }}" required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <label>Contenido</label>
            <div class="col-md-12">
                <textarea type="text" class="form-control" id="summernote" name="content" style="height:800px;">{{ old('content') ?? $landing->content }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <label>Vista Previa</label>
            <div class="col-md-12" style="width: 100%;height: 800px;">
                <iframe id="previewIframe" class="form-control" style="width: 100%;height: 800px;"></iframe>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Fecha de inicio</label>
                    <input type="date" class="form-control" name="start_date"
                        value="{{ old('start_date') ?? Carbon\Carbon::parse($landing->start_date)->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label>Fecha de expiración</label>
                    <input type="date" class="form-control" name="expiration_date"
                        value="{{ old('expiration_date') ?? Carbon\Carbon::parse($landing->expiration_date)->format('Y-m-d') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Valor 1 <small class="text-right d-block"><b>Referencia: </b>%%_value1_%%</small></label>
                    <input type="text" class="form-control" name="value_1"
                        value="{{ old('value_1') ?? $landing->value_1 }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label>Valor 2 <small class="text-right d-block"><b>Referencia: </b>%%_value2_%%</small></label>
                    <input type="text" class="form-control" name="value_2"
                        value="{{ old('value_2') ?? $landing->value_2 }}">
                </div>
            </div>
        </div>


        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-large mt-3">Guardar Cambios</button>
        </div>

    </form>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $('#summernote').summernote();
        // });

        document.addEventListener("DOMContentLoaded", function() {
            var textarea = document.getElementById('summernote');
            var iframe = document.getElementById('previewIframe');

            var content = textarea.value;
            var headContent = content.match(/<head[^>]*>[\s\S]*<\/head>/gi)[0];
            var bodyContent = content.match(/<body[^>]*>[\s\S]*<\/body>/gi)[0];

            // Escribir el contenido del textarea en el iframe y habilitar edición
            iframe.contentDocument.open();
            iframe.contentDocument.write('<html>' + headContent + bodyContent + '</html>');
            iframe.contentDocument.close();
            iframe.contentDocument.designMode = "on"; // Habilitar modo edición

            // Sincronizar cambios del iframe al textarea
            iframe.contentDocument.body.addEventListener("input", function() {
                var newBodyContent = iframe.contentDocument.body.innerHTML;
                textarea.value = '<html>' + headContent + '<body>' + newBodyContent + '</body></html>';
            });

            // Sincronizar cambios del textarea al iframe
            textarea.addEventListener("input", function() {
                var newContent = textarea.value;
                var newBodyContent = newContent.match(/<body[^>]*>[\s\S]*<\/body>/gi)[0];
                iframe.contentDocument.body.innerHTML = newBodyContent;
            });
        });

    </script>
@endsection
