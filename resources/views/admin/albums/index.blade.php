@extends('layouts.app')

@section('content')

    <h1>Listado de Galerías</h1>

    <a class="btn btn-primary mb-3" href="{{ route('admin.albums.create')}}"><i class="fas fa-plus"></i>
        Nueva Galería
    </a>

    @empty($albums)
        <div class="alert alert-warning">
            La lista de galerías está vacía
        </div>
    @else

        <table id="albums-table" class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Sección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $album)
                    <tr>
                        <td>{{ $album->title }}</td>
                        <td>{{ $album->section }}</td>
                        <td>
                          <a href="{{ $album->type == 'carousel' ? route('admin.albums.carousel', $album->id) : route('admin.albums.photos', $album->id) }}" class="btn btn-primary"><i
                            class="fas fa-images"></i></a>
                            <a href="{{ route('admin.albums.edit', ['album' => $album->id]) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form method="POST" action="{{ route('admin.albums.destroy', ['album' => $album->id]) }}"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-button"><i
                                        class="fas fa-fw fa-trash "></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endempty

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#albums-table').DataTable();
            var totalRecords = table.rows().count();
            $('.badge-success').text(totalRecords);
        });
    </script>
@stop
