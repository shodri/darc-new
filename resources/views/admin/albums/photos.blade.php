@extends('layouts.app')
@section('content')
    <h1>{{ $album->title }}</h1>

    <p>{!! $album->description !!}</p>


    <div class="container mt-4">
        <div class="card p-3">
            <form method="POST" action="{{ route('admin.albums.upload', $album->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <x-adminlte-input-file name="before_crop_image" id="before_crop_image" label="Subir Imagen"
                        placeholder="Seleccione una imagen..." />
                </div>
                <div class="mb-3">
                    <x-adminlte-input-file name="before_crop_image_xd" id="before_crop_image_xs" label="Subir Imagen"
                        placeholder="Seleccione una imagen..." />
                </div>
            </form>
        </div>

        <div class="row mt-4" id="sortable-images">
            @foreach ($album->getOrderedMedia() as $photo)
                <div class="col-md-4 mb-4" data-id="{{ $photo->id }}">
                    <div class="card h-100">
                        <img src="{{ $photo->getUrl() }}" alt="gallery" class="card-img-top">
                        <form method="POST" class="delete-icon"
                            action="{{ route('admin.album.image.destroy', [$album->id, $photo->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></button>
                        </form>
                        <div class="card-body">
                            <div class="form-group position-relative">
                                <label for="title_{{ $photo->id }}">Title</label>
                                <span class="edit-icon position-absolute top-0 end-0 p-0 ml-2" style="cursor: pointer;">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <input type="text" class="form-control edit-title" id="title_{{ $photo->id }}"
                                    value="{{ $photo->getCustomProperty('title') }}" data-id="{{ $photo->id }}" disabled>
                            </div>
                            <div class="form-group position-relative">
                                <label for="description_{{ $photo->id }}">Description</label>
                                <span class="edit-icon position-absolute top-0 end-0 p-0 ml-2" style="cursor: pointer;">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <textarea class="form-control edit-description" id="description_{{ $photo->id }}" data-id="{{ $photo->id }}"
                                    disabled>{{ $photo->getCustomProperty('description') }}</textarea>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModel" tabindex="-1" role="dialog" aria-labelledby="imageModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModelLabel">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="image_demo" style="width: 100%;"></div>
                    <div class="form-group mt-3">
                        <label for="image_title">Title</label>
                        <input type="text" id="image_title" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group mt-3">
                        <label for="image_description">Description</label>
                        <textarea id="image_description" class="form-control" placeholder="Enter description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary crop_image">Subir imagen</button>
                    <div class="spinner-border" role="status" style="display: none">
                        <span class="sr-only">Loading...</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

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
    </style>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Handle title and description changes
            $('.edit-icon').click(function() {
                var input = $(this).siblings('input, textarea');
                input.prop('disabled', false).focus();
            });

            $('.edit-title, .edit-description').on('blur', function() {
                var id = $(this).data('id');
                var title = $('#title_' + id).val();
                var description = $('#description_' + id).val();

                $.ajax({
                    url: '{{ route('admin.albums.update-image-text', $album->id) }}',
                    type: 'POST',
                    data: {
                        'id': id,
                        'title': title,
                        'description': description
                    },
                    success: function(data) {
                        console.log('Image text has been updated');
                        // Disable input after saving
                        $('#title_' + id).prop('disabled', true);
                        $('#description_' + id).prop('disabled', true);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating image text:', error);
                        alert(
                            'An error occurred while updating the image text. Please try again.'
                        );
                    }
                });
            });
            //Sortable Images

            var el = document.getElementById('sortable-images');
            var sortable = Sortable.create(el, {
                onEnd: function(evt) {
                    var order = [];
                    document.querySelectorAll('#sortable-images .col-md-4').forEach(function(item,
                        index) {
                        order.push({
                            id: item.getAttribute('data-id'),
                            order: index + 1
                        });
                    });

                    fetch('{{ route('admin.albums.update-order', $album->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order: order
                            })
                        }).then(response => response.json())
                        .then(data => {
                            console.log('Order updated:', data);
                        });
                }
            });

            //Crop Images

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    // width: 1600 / 2 , 
                    // height: 670 / 2, 
                    width: {{$album->width}} , 
                    height:{{$album->height}}, 
                    type: 'rectangle' // Usar 'rectangle' para un aspecto específico
                },
                boundary: {
                    width: {{$album->width}} , 
                    height:{{$album->height}}, 
                }
            });

            $('#before_crop_image').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('Croppie bind complete');
                    });
                };
                reader.readAsDataURL(this.files[0]);
                $('#imageModel').modal('show');
            });

            $('#imageModel').on('shown.bs.modal', function() {
                // Adjust the croppie instance when modal is fully shown
                $image_crop.croppie('bind');
            });

            $('.crop_image').click(function(event) {
                event.preventDefault();
                var title = $('#image_title').val();
                var description = $('#image_description').val();

                // Mostrar spinner y ocultar botón
                $(this).hide();
                $('.spinner-border').show();

                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: {
                        width: {{ $album->width }}, // Tamaño final de la imagen
                        height: {{ $album->height }}
                    }
                }).then(function(response) {
                    $.ajax({
                        url: '{{ route('admin.albums.crop-store', $album->id) }}',
                        type: 'POST',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'image': response,
                            'title': title,
                            'description': description
                        },
                        success: function(data) {
                            // Ocultar spinner
                            $('.loading-spinner').hide();

                            // Mostrar Sweet Alert de éxito
                            Swal.fire({
                                icon: 'success',
                                title: 'Imagen subida',
                                text: 'La imagen ha sido subida exitosamente.'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location
                                        .reload(); // Recargar la página para ver la nueva imagen
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error uploading cropped image:', error);
                            $('.loading-spinner').hide();
                            $('.crop_image').show();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al subir la imagen. Por favor, inténtelo nuevamente.'
                            });
                        }
                    });
                });
            });
        });
    </script>
@stop
