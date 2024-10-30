@extends('layouts.app')

@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@stop

@section('content')

    <h1>Listado de Planes de Ahorro</h1>

    @empty($planes)
        <div class="alert alert-warning">
            La lista de planes de ahorro está vacía.
        </div>
    @else
        <table id="planes-table" class="table">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Versión</th>
                    <th>Descripción</th>
                    <th>Cuota Base</th>
                    <th>Nombre</th>
                    <th>Tipo de Plan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planes as $plan)
                    <tr>
                        <td>{{ ucfirst($plan->pdaMarca) }}</td>
                        <td>{{ ucfirst($plan->pdaModelo) }}</td>
                        <td>{{ ucfirst($plan->pdaVersion) }}</td>
                        <td>{{ $plan->pdaDescrip }}</td>
                        <td>$ {{ number_format($plan->pdaCuotaBase, 0, '', '.') }} .-</td>
                        <td>{{ $plan->pdaDescrip }}</td>
                        <td>{{ $plan->pdaTipoPlan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endempty

@stop

@section('scripts')
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#planes-table').DataTable();
        });
    </script>
@stop
