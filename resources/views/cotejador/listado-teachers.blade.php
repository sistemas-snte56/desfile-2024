@extends('adminlte::page')

@section('title', 'Cotejador')

@section('content_header')
    <h1>Cotejador</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #ee7a00;">
        <h4 style="color:#FFFFFF;">
            <strong>LISTADO {{$srio->nombre}}</strong>
        </h4>
    </div>
    <div class="card-body">
        <div class="card-title mb-4">
            <x-adminlte-callout theme="success" title="CARGO: {{$srio->cargo}}">
                <strong>{{$srio->nombre}}&nbsp;{{$srio->apaterno}}&nbsp;{{$srio->amaterno}}</strong><br>
                {{$srio->delegations->delegacion}}&nbsp;<strong>/</strong>&nbsp;{{$srio->delegations->nivel_delegaciona}}&nbsp;<strong>/</strong>&nbsp;{{$srio->delegations->sede_delegaciona}}<br>
            </x-adminlte-callout>
        </div>
        <div class="card-text">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'NOMBRE',
                    'NUM. PERSONAL',
                    'RFC',
                    'GENERO',
                    'TELEFONO',
                    'EMAIL',
                    'CREADO',
                    'FOLIO',
                ];

                $config = [
                    'order' => [[1, 'asc']],
                    'columns' => [
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                        ['orderable' => false],
                    ],
                    'language' => [
                        'url' => 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json',
                    ],
                    'pageLength' => 50, // Configuración por defecto de la cantidad de entradas por página
                    'lengthMenu' => [50, 100, 200], // Opciones de entradas por página       
                    'responsive' => true,
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable bordered compressed with-buttons>
                @foreach ($listadoTeachers as $index => $teacher)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $teacher->nombre }}&nbsp;{{$teacher->apaterno}}&nbsp;{{$teacher->amaterno}}</td>
                        <td>{{ $teacher->npersonal }}</td>
                        <td>{{ $teacher->rfc }}</td>
                        <td>{{ $teacher->genero }}</td>
                        <td>{{ $teacher->telefono }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->created_at->format('d/m/Y') }}</td>
                        <td>{{ $teacher->folio }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
</div>
@stop

@section('css')
{{-- Si tienes estilos CSS adicionales, los puedes colocar aquí. --}}
@stop

@section('js')
{{-- Si necesitas agregar algún script de JavaScript adicional, lo puedes colocar aquí. --}}
@stop
