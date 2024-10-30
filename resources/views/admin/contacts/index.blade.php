@extends('layouts.app')
@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@stop
@section('content')

    <h1>Listado de Contactoss</h1>

    @empty($contacts)
        <div class="alert alert-warning">
            La lista de contactos está vacía
        </div>
    @else
        <table id="contacts-table" class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        {{-- <td>
                            <a href="{{ route('admin.contacts.edit', ['contact' => $contact->id]) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form method="POST" action="{{ route('admin.contacts.destroy', ['contact' => $contact->id]) }}"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-button"><i
                                        class="fas fa-fw fa-trash "></i></button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endempty

@endsection
@section('js')
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <!-- pdfMake para la exportación de PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script>
         $(document).ready(function() {
        var table = $('#contacts-table').DataTable({
            dom: 'Bfrtip', // Habilita los botones
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: 'Exportar a CSV',
                    className: 'btn btn-primary',
                    title: function() {
                        return 'darcautos_contactos_' + new Date().toISOString().slice(0, 10); // Prefijo + fecha
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    className: 'btn btn-success',
                    title: function() {
                        return 'darcautos_contactos_' + new Date().toISOString().slice(0, 10); // Prefijo + fecha
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    title: function() {
                        return 'darcautos_contactos_' + new Date().toISOString().slice(0, 10); // Prefijo + fecha
                    },
                    download: 'open',  // Abre el PDF en una nueva pestaña
                    orientation: 'landscape', // Orientación del PDF
                    pageSize: 'A4', // Tamaño de página
                    customize: function(doc) {
                        doc.styles.tableHeader = {
                            bold: true,
                            fontSize: 11,
                            color: 'black',
                            fillColor: '#eeeeee',
                            alignment: 'center'
                        };
                    }
                }
            ]
        });

        var totalRecords = table.rows().count();
        $('.badge-success').text(totalRecords);
    });
    </script>
@stop
