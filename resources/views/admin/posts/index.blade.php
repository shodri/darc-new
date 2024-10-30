@extends('layouts.app')

@section('content')

    <h1>Listado de Novedades</h1>

    <a class="btn btn-primary mb-3" href="{{ route('admin.posts.create') }}"><i class="fas fa-plus"></i>
        Nuevo Post
    </a>

    @empty($posts)
        <div class="alert alert-warning">
            La lista de novedades está vacía
        </div>
    @else
        <table id="posts-table" class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Categoría</th>
                    <th>Tags</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary"><i
                                    class="fas fa-images"></i></a>
                            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form id="deletePostForm" method="POST" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger deletePost"><i
                                        class="fas fa-fw fa-trash "></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endempty

@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var table = $('#posts-table').DataTable();
            var totalRecords = table.rows().count();
            $('.badge-success').text(totalRecords);
        });

        $('.deletePost').click(function(e) {
            e.preventDefault();
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
                    $('#deletePostForm').submit();
                }
            });
        });
    </script>
@stop
