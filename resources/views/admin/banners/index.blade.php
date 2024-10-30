@extends('layouts.app')

@section('content')

    <h1>Listado de Banners</h1>

    <a class="btn btn-primary mb-3" href="{{ route('admin.banners.create')}}"><i class="fas fa-plus"></i>
        Nuevo Banner
    </a>

    @empty($banners)
        <div class="alert alert-warning">
            La lista de banners está vacía
        </div>
    @else

        <table id="banners-table" class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Redirección</th>
                    <th>Sección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->href }}</td>
                        <td>{{ $banner->section }}</td>
                        <td>
                            <a href="{{ route('admin.banners.edit', ['banner' => $banner->id]) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form method="POST" action="{{ route('admin.banners.destroy', ['banner' => $banner->id]) }}"
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
            var table = $('#banners-table').DataTable();
            var totalRecords = table.rows().count();
            $('.badge-success').text(totalRecords);
        });
    </script>
@stop
