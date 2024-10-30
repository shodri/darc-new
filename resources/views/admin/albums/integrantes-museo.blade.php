@extends('layouts.app')
@section('content')
    <h1>{{ $album->title }}</h1>

    <p>{!! $album->description !!}</p>


    <div class="container mt-4">
        <div class="card p-3">
            <form method="POST" action="{{ route('admin.albums.upload', $album->id) }}" enctype="multipart/form-data">
                <input type="hidden" id="photo_id" value="">
                @csrf
                <div class="mb-3">
                    <x-adminlte-input-file name="before_crop_image" id="before_crop_image" label="Subir Imagen"
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
                        <button type="button" class="btn btn-warning btn-sm edit-image" data-id="{{ $photo->id }}"><i
                                class="fas fa-pencil-alt"></i></i></button>

                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" id="order_{{ $photo->id }}"
                                    value="{{ $photo->getCustomProperty('order') }}">

                                <label for="name_{{ $photo->id }}">Nombre y Apellido</label>
                                <span class="edit-icon position-absolute top-0 end-0 p-0 ml-2" style="cursor: pointer;">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <input type="text" class="form-control edit-name" id="name_{{ $photo->id }}"
                                    value="{{ $photo->getCustomProperty('name') }}" data-id="{{ $photo->id }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="type_{{ $photo->id }}">Tipo de Pertenencia</label>
                                <span class="edit-icon position-absolute top-0 end-0 p-0 ml-2" style="cursor: pointer;">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <select class="form-control edit-type" id="type_{{ $photo->id }}"
                                    data-id="{{ $photo->id }}" disabled>
                                    <option value="museo"
                                        {{ $photo->getCustomProperty('type') == 'museo' ? 'selected' : '' }}>Museo</option>
                                    <option value="asoc"
                                        {{ $photo->getCustomProperty('type') == 'asoc' ? 'selected' : '' }}>Asoc. Civil</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rol_{{ $photo->id }}">Cargo</label>
                                <span class="edit-icon position-absolute top-0 end-0 p-0 ml-2" style="cursor: pointer;">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <input type="text" class="form-control edit-rol" id="rol_{{ $photo->id }}"
                                    value="{{ $photo->getCustomProperty('rol') }}" data-id="{{ $photo->id }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="institution_{{ $photo->id }}">Pertenencia</label>
                                <span class="edit-icon position-absolute top-0 end-0 p-0 ml-2" style="cursor: pointer;">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <input type="text" class="form-control edit-institution"
                                    id="institution_{{ $photo->id }}"
                                    value="{{ $photo->getCustomProperty('institution') }}" data-id="{{ $photo->id }}"
                                    disabled>
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
                    <input type="hidden" id="image_order" value="">
                    <div id="image_demo" style="width: 100%;"></div>
                    <div class="form-group mt-3">
                        <label for="image_name">Nombre y apellido</label>
                        <input type="text" id="image_name" class="form-control"
                            placeholder="Ingrese Nombre y Apellido">
                    </div>
                    <div class="form-group">
                        <label for="image_type">Tipo de Pertenencia</label>
                        <select class="form-control" id="image_type">
                            <option value="museo">Museo</option>
                            <option value="asoc">Asoc. Civil</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="image_rol">Cargo</label>
                        <input type="text" id="image_rol" class="form-control" placeholder="Ingrese Cargo">
                    </div>
                    <div class="form-group mt-3">
                        <label for="image_institution">Pertenencia institucional</label>
                        <input type="text" id="image_institution" class="form-control"
                            placeholder="Ingrese la pertenencia institucional">
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

        .edit-image {
            position: absolute;
            top: 10px;
            right: 50px;
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
                var input = $(this).siblings('input, select');
                input.prop('disabled', false).focus();
            });

            $('.edit-name, .edit-rol, .edit-institution, .edit-type').on('blur', function() {
                var id = $(this).data('id');
                var name = $('#name_' + id).val();
                var type = $('#type_' + id).val();
                var rol = $('#rol_' + id).val();
                var institution = $('#institution_' + id).val();
                var order = $('#order_' + id).val();

                $.ajax({
                    url: '{{ route('admin.albums.update-image-text', $album->id) }}',
                    type: 'POST',
                    data: {
                        'id': id,
                        'name': name,
                        'type': type,
                        'rol': rol,
                        'institution': institution,
                        'order': order,
                    },
                    success: function(data) {
                        console.log('Image text has been updated');
                        // Disable input after saving
                        $('#name_' + id).prop('disabled', true);
                        $('#type_' + id).prop('disabled', true);
                        $('#rol_' + id).prop('disabled', true);
                        $('#institution_' + id).prop('disabled', true);
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

            $('.edit-image').click(function() {
                var photoId = $(this).data('id');
                var name = $('#name_' + photoId).val();
                var type = $('#type_' + photoId).val();
                var rol = $('#rol_' + photoId).val();
                var institution = $('#institution_' + photoId).val();
                var order = $('#order_' + photoId).val();

                // Mostrar los datos en el modal
                $('#image_name').val(name);
                $('#image_type').val(type);
                $('#image_rol').val(rol);
                $('#image_institution').val(institution);
                $('#image_order').val(order);

                // Asignar el photo_id al campo oculto
                $('#photo_id').val(photoId);

                // Mostrar el modal
                //$('#imageModel').modal('show');

                // Disparar el clic en el file input
                $('#before_crop_image').click();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 600,
                    height: 600,
                    type: 'square' // or 'circle'
                },
                boundary: {
                    width: 800,
                    height: 800
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
                var name = $('#image_name').val();
                var type = $('#image_type').val();
                var rol = $('#image_rol').val();
                var institution = $('#image_institution').val();
                var order = $('#image_order').val();
                var photo_id = $('#photo_id').val();
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
                            'name': name,
                            'type': type,
                            'rol': rol,
                            'institution': institution,
                            'order': order,
                            'photo_id': photo_id,
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
