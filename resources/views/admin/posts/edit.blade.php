@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <h1>{{ $title }}</h1>

    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
        <input type="hidden" id="cropped_image" name="cropped_image">

        @csrf
        @if ($post->id)
            @method('PATCH')
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <label>Titulo</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') ?? $post->title }}"
                        required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="form-row">
                    <label for="category">Categoría</label>
                    <select id="category" name="category_id" class="form-control form-control-md" required>
                        <option value="" disabled {{ !isset($post->category_id) ? 'selected' : '' }}>Seleccione una
                            categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ isset($post) && $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-row">
                    <label for="tags">Tags</label>
                    <select id="tags" name="tags[]" class="form-control form-control-md" multiple="multiple">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ isset($selectedTags) && in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Imagen principal</label>

                @if ($post->getFirstMediaUrl('main_image', 'webp'))
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ $post->getFirstMediaUrl('main_image', 'webp') }}" alt="Imagen principal"
                                class="img-fluid mb-3">
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger" id="removeImageButton">Eliminar imagen</button>
                        </div>
                    </div>
                @else
                    <div class="input-group is-invalid">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="before_crop_image">
                            <label class="custom-file-label" for="before_crop_image">Elija un archivo...</label>
                        </div>
                    </div>
                    <div class="invalid-feedback" style="display:none">
                        Example invalid input group feedback
                    </div>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <label>Descripción</label>
                    </div>
                    <div class="col-md-12">
                        <textarea name="body" class="summernote">{{ old('body') ?? $post->body }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-large mt-3">Guardar Cambios</button>
        </div>

    </form>

    <div id="imageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recortar imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="image_demo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary crop_image">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .select2-selection--single {
            height: fit-content !important;
        }

        .select2-selection--multiple {
            height: fit-content !important;
        }
    </style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });

            $('#category').select2({
                tags: true
            });

            $('#tags').select2({
                tags: true
            });

            @if ($post->id)

                $('#removeImageButton').click(function() {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('Confirmed. Making AJAX request.');

                            $.ajax({
                                url: '{{ route('admin.posts.removeImage', $post->id) }}',
                                type: 'GET',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    'id': '{{ $post->id }}'
                                },
                                success: function(response) {
                                    Swal.fire(
                                        'Eliminado!',
                                        response.success,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error al eliminar la imagen:',
                                    error);
                                    Swal.fire(
                                        'Error',
                                        'Ocurrió un error al eliminar la imagen. Por favor, inténtelo de nuevo.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
            @endif

            var $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 400, // Ajusta el tamaño del viewport
                    height: 300, // Mantén la proporción (1200/900 = 4/3)
                    type: 'square'
                },
                boundary: {
                    width: 512, // Ajusta el tamaño del boundary
                    height: 384 // Mantén la proporción (1024/768 = 4/3)
                }
            });

            $('#imageModal').on('shown.bs.modal', function() {
                $image_crop.croppie('bind');
            });

            $('#before_crop_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('Croppie bind complete');
                    });
                    $('.custom-file-label').html(event.target.result);

                };
                reader.readAsDataURL(this.files[0]);
                $('#imageModal').modal('show');
            });

            $('.crop_image').click(function(event) {
                event.preventDefault();
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: {
                        width: 730,
                        height: 548
                        // width: 1024,
                        // height: 768
                    }
                }).then(function(response) {
                    $('#cropped_image').val(response);
                    $('#imageModal').modal('hide');
                });
            });
        });
    </script>
@stop
