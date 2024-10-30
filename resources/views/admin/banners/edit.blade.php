@extends('layouts.app')
@php
    $bannerXS = $banner->getMedia('banners')->firstWhere('custom_properties.type', 'xs');
    $bannerXL = $banner->getMedia('banners')->firstWhere('custom_properties.type', 'xl');
@endphp
@section('content')
    <h1>{{ $title }} {{ $banner->title }}</h1>

    <div class="container mt-4">


        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detalles del Banner</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ $action }}" method="POST">
                            @csrf
                            @if ($banner->id)
                                @method('PATCH')
                            @endif

                            <!-- Título -->
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Título" value="{{ old('title', $banner->title) }}">
                            </div>

                            <!-- Subtítulo -->
                            <div class="form-group">
                                <label for="subtitle">Subtítulo</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control"
                                    placeholder="Subtítulo" value="{{ old('subtitle', $banner->subtitle) }}">
                            </div>

                            <!-- Texto del botón -->
                            <div class="form-group">
                                <label for="text_button">Texto del Botón</label>
                                <input type="text" name="text_button" id="text_button" class="form-control"
                                    placeholder="Texto del Botón" value="{{ old('text_button', $banner->text_button) }}">
                            </div>

                            <!-- Texto -->
                            <div class="form-group">
                                <label for="text">Texto</label>
                                <textarea name="text" id="text" class="form-control" rows="4" placeholder="Ingrese el texto...">{{ old('text', $banner->text) }}</textarea>
                            </div>

                            <!-- Enlace -->
                            <div class="form-group">
                                <label for="href">Enlace (URL)</label>
                                <input type="text" name="href" id="href" class="form-control"
                                    placeholder="Enlace (URL)" value="{{ old('href', $banner->href) }}">
                            </div>

                            <!-- Sección -->
                            <div class="form-group">
                                <label for="section">Sección</label>
                                <input type="text" name="section" id="section" class="form-control"
                                    placeholder="Nombre de la Sección" value="{{ old('section', $banner->section) }}">
                            </div>

                            <!-- Orden -->
                            <div class="form-group">
                                <label for="order">Orden</label>
                                <input type="number" name="order" id="order" class="form-control" placeholder="Orden"
                                    value="{{ old('order', $banner->order) }}">
                            </div>

                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                @if ($banner->id)

                    <div class="card p-3">
                        @if ($bannerXL)
                            <div style="text-align: center; position: relative;">
                                <!-- Imagen del banner XL -->
                                <img src="{{ $bannerXL->getUrl() }}" alt="Banner XL"
                                    style="max-width: 100%; max-height: 670px; object-fit: contain; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

                                <!-- Botón de eliminar -->
                                <form action="{{ route('admin.banner.image.destroy', [$banner->id, $bannerXL->id]) }}"
                                    method="POST" style="position: absolute; top: 10px; right: 10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background-color: #ff4d4d; border: none; color: white; padding: 5px 10px; border-radius: 5px; cursor: pointer; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="dropzone" id="banner_xl"></div>
                        @endif
                    </div>

                    <div class="card p-3">
                        @if ($bannerXS)
                            <div style="text-align: center; position: relative;">
                                <!-- Imagen del banner XS -->
                                <img src="{{ $bannerXS->getUrl() }}" alt="Banner XS"
                                    style="max-width: 100%; max-height: 600px; object-fit: contain; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

                                <!-- Botón de eliminar -->
                                <form action="{{ route('admin.banner.image.destroy', [$banner->id, $bannerXS->id]) }}"
                                    method="POST" style="position: absolute; top: 10px; right: 10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background-color: #ff4d4d; border: none; color: white; padding: 5px 10px; border-radius: 5px; cursor: pointer; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="dropzone" id="banner_xs"></div>
                        @endif
                    </div>
                @else
                    <div class="card p-3">
                        <h3>Para subir imágenes primero cree el banner</h3>
                    </div>

                @endif
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css" />

    <style>
        .card-img-top {
            position: relative;
        }

        .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }

        .edit-icon {
            cursor: pointer;
        }

        .dropzone {
            border: 2px dashed #000;
            /* Grosor del borde y estilo punteado */
        }
    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script src="{{ asset('assets/js/mycropper.js') }}"></script>

    <script>
        @if ($banner->id)

            Dropzone.autoDiscover = false;
            document.addEventListener('DOMContentLoaded', function() {

                @if (!$bannerXL)
                    var myDropzoneXL = new Dropzone('#banner_xl', {
                        url: "{{ route('admin.banners.crop-store', $banner->id) }}",
                        dictDefaultMessage: "Arrastra los archivos para Desktop <br> Tamaño requerido: 1600px x 670px",
                        transformFile: function(file, done) {
                            cropImage.call(this, file, done, 1600,
                            670); // Pasar el ancho y alto deseados
                        },
                        init: function() {
                            this.on('sending', function(file, xhr, formData) {
                                var id = $('#modId').val();
                                formData.append('_token', '{{ csrf_token() }}');
                                formData.append('type', 'xl');
                            });
                            this.on('success', function(file, response) {
                                location.reload();
                            });
                        }
                    });
                @endif

                @if (!$bannerXS)
                    var myDropzoneXS = new Dropzone('#banner_xs', {
                        url: "{{ route('admin.banners.crop-store', $banner->id) }}",
                        dictDefaultMessage: "Arrastra los archivos para Mobile <br> Tamaño requerido: 600px x 800px",
                        transformFile: function(file, done) {
                            cropImage.call(this, file, done, 600,
                            800); // Pasar el ancho y alto deseados
                        },
                        init: function() {
                            this.on('sending', function(file, xhr, formData) {
                                var id = $('#modId').val();
                                formData.append('_token', '{{ csrf_token() }}');
                                formData.append('type', 'xs');
                            });
                            this.on('success', function(file, response) {
                                location.reload();
                            });
                        }
                    });
                @endif
            });
        @endif
    </script>
@stop
