@extends('layouts.app')

@section('content')
    <h1>{{ $page->title }}</h1>

    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <label>Titulo</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') ?? $page->title }}" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Url</label>
                    <input type="text" class="form-control" name="url" value="{{ old('url') ?? $page->url }}"
                        required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <label>Contenido</label>
            <div class="col-md-12">
                <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" data-target="#contentTextarea"
                    aria-expanded="false" aria-controls="contentTextarea">
                    Mostrar/Ocultar Contenido
                </button>
                <div class="collapse" id="contentTextarea">
                    <textarea type="text" class="form-control" id="summernote" name="content" style="height:800px;">
                        {{ old('content') ?? $page->content }}
                    </textarea>
                </div>
            </div>
        </div>

        <div class="form-row">
            <label>Vista Previa</label>
            <div class="col-md-12" style="width: 100%;height: 800px;">
                <iframe id="previewIframe" class="form-control" style="width: 100%;height: 800px;"></iframe>
            </div>
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-large mt-3" id="saveButton">Guardar Cambios</button>
        </div>

    </form>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var textarea = document.getElementById('summernote');
            var iframe = document.getElementById('previewIframe');
            var saveButton = document.getElementById('saveButton');

            var topContent = {!! json_encode(view('layouts.top')->render()) !!};
            var footerContent = {!! json_encode(view('layouts.footer')->render()) !!};
            var finalContent;

            // Function to update iframe content
            function updateIframe() {
                
                var content = textarea.value;

                var fullContent = topContent + content + footerContent;

                iframe.contentDocument.open();
                iframe.contentDocument.write(fullContent);
                iframe.contentDocument.close();
                iframe.contentDocument.designMode = "on";

                iframe.onload = function() {
            iframe.contentDocument.designMode = "on";
            
            // Reemplazar '%_site_url_%' con la URL del sitio directamente en el contenido del iframe
            iframe.contentDocument.body.innerHTML = iframe.contentDocument.body.innerHTML.replace(/%_site_url_%/g, '{{ url('/') }}');
        };
            }

            // Initial load
            updateIframe();

            // Sync changes from iframe to textarea
            iframe.contentDocument.body.addEventListener("input", function() {
                textarea.value = iframe.contentDocument.body.innerHTML;
                textarea.value = extractContent(textarea.value);
            });

            // Sync changes from textarea to iframe
            textarea.addEventListener("input", updateIframe);
        });

        function extractContent(content) {
            var startMarker = '<!--%%_start_%%-->';
            var endMarker = '<!--%%_end_%%-->';

            var startIndex = content.indexOf(startMarker);
            var endIndex = content.indexOf(endMarker);

            // if (startIndex === -1 || endIndex === -1) {
            //     // Si uno de los marcadores no se encuentra, devolver el contenido original
            //     return content;
            // }

            // Ajustar índices para incluir el contenido después del inicio y antes del final de los marcadores
            var adjustedStartIndex = startIndex;
            var adjustedEndIndex = endIndex + endMarker.length;

            return content.substring(adjustedStartIndex, adjustedEndIndex);
        }
    </script>
@endsection
