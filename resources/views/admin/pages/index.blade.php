@extends('layouts.app')

@section('content')

    <h1>Listado de Secciones Web</h1>

    <a class="btn btn-primary mb-3" href="{{ route('admin.pages.create')}}"><i class="fas fa-plus"></i>
        Nueva Galería
    </a>

    @empty($pages)
        <div class="alert alert-warning">
            La lista  está vacía
        </div>
    @else

        <table id="pages-table" class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Url</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->url }}</td>
                        <td>
                            <a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form method="POST" action="{{ route('admin.pages.destroy', ['page' => $page->id]) }}"
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
            var table = $('#pages-table').DataTable();
            var totalRecords = table.rows().count();
            $('.badge-success').text(totalRecords);
        });
    </script>
@stop
