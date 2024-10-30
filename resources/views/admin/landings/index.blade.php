@extends('layouts.app')

@section('content')

    
    <h1>Listado de Landings</h1>

    @if($landings->count() < 10)
        <a class="btn btn-primary mb-3" href="{{ route('admin.landings.create')}}"><i class="fas fa-plus"></i>
            Nueva Landing 
        </a>
    @else
        <div class="alert alert-warning">
            Ha llegado al límite de landings
        </div>
    @endif

    @empty ($landings)

        <div class="alert alert-warning">
            The list is empty
        </div>

    @else  
    <table id="landings-table" class="table">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Url</th>
                <th>Sitio Base</th>
                <th>Valor 1</th>
                <th>Valor 2</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($landings as $landing)
            <tr>
                <td>{{ $landing->title }}</td>
                <td>{{ $landing->url }}</td>
                <td>{{ $landing->site_base }}</td>
                <td>{{ $landing->value_1 }}</td>
                <td>{{ $landing->value_2 }}</td>
                <td>
                    <a href="{{ route('landing.show', ['url' => $landing->url]) }}" target="_blank" class="btn btn-info"><i class="fas fa-fw fa-eye "></i></a>
                    <a href="{{ route('admin.landings.edit', ['landing' => $landing->id]) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                    <button class="btn btn-success edit-values-btn" data-id="{{ $landing->id }}" data-value1="{{ $landing->value_1 }}" data-value2="{{ $landing->value_2 }}"><i class="fas fa-fw fa-dollar-sign" aria-hidden="true"></i></button>
                    <form method="POST" action="{{ route('admin.landings.destroy', ['landing' => $landing->id]) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-button"><i class="fas fa-fw fa-trash "></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endempty


<!-- Modal HTML -->
<div class="modal fade" id="editValuesModal" tabindex="-1" role="dialog" aria-labelledby="editValuesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editValuesModalLabel">Editar Valores</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editValuesForm">
            @csrf
            <input type="hidden" name="id" id="landing-id">
            <div class="form-group">
              <label for="value-1">Valor 1</label>
              <input type="text" class="form-control" id="value-1" name="value_1">
            </div>
            <div class="form-group">
              <label for="value-2">Valor 2</label>
              <input type="text" class="form-control" id="value-2" name="value_2">
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        var table = $('#landings-table').DataTable();
        var totalRecords = table.rows().count();
        $('.badge-success').text(totalRecords);


        var table = $('#landings-table').DataTable();
        var totalRecords = table.rows().count();
        $('.badge-success').text(totalRecords);

        // Abrir modal y pasar datos al modal
        $('.edit-values-btn').on('click', function() {
            var landingId = $(this).data('id');
            var value1 = $(this).data('value1');
            var value2 = $(this).data('value2');

            $('#landing-id').val(landingId);
            $('#value-1').val(value1);
            $('#value-2').val(value2);

            $('#editValuesModal').modal('show');
        });

        // Manejar el envío del formulario
        $('#editValuesForm').on('submit', function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("admin.landings.updateField") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        $('#editValuesModal').modal('hide');
                        // Opcional: Actualizar los valores en la tabla sin recargar
                        var landingId = $('#landing-id').val();
                        var updatedValue1 = $('#value-1').val();
                        var updatedValue2 = $('#value-2').val();

                        var row = $('#landings-table').find('button[data-id="' + landingId + '"]').closest('tr');
                        row.find('td').eq(3).text(updatedValue1);
                        row.find('td').eq(4).text(updatedValue2);

                        // Actualizar los atributos data-value en el botón
                        row.find('.edit-values-btn').data('value1', updatedValue1);
                        row.find('.edit-values-btn').data('value2', updatedValue2);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });


        $('.delete-button').click(function (event) {
            event.preventDefault(); // Detener el envío automático del formulario

            var form = $(this).next('.delete-form'); // Obtener el formulario de eliminación siguiente al botón
            
            // Mostrar una alerta de confirmación
            Swal.fire({
                title: '¿Estás seguro de eliminar la landing?',
                text: 'No podrás revertir esto luego !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario
                    form.submit();
                }
            });
        });

    });

</script>
@endsection