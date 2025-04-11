@extends('adminlte::page')

@section('title', 'Cotejador')

@section('content_header')
    <h1>&nbsp;</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #ee7a00;">
        <h4 style="color:#FFFFFF;">
            <strong>LISTADO GENERAL POR REGIÓN</strong>
        </h4>
    </div>
    <div class="card-body">
        <div class="card-title mb-4">
            <x-adminlte-callout theme="success" title="{{$region->region}} {{$region->sede}}">
                Total de Delegaciones y Centros de Trabajo: <strong>{{ $delegaciones->count() }}</strong>
            </x-adminlte-callout>
        </div>
        <div class="card-text">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'DELEGACION / CENTRO DE TRABAJO',
                    'SECRETARIO GENERAL / REPRESENTANTE DE C.T.',
                    'LISTA DE ASISTENTES',
                ];

                $config = [
                    'order' => [[1, 'asc']],
                    'columns' => [
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
                @foreach ($delegaciones as $index => $delegacion)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $delegacion->delegacion }}&ensp;<strong>/</strong>&ensp;
                            {{$delegacion->nivel_delegaciona}}&ensp;<strong>/</strong>&ensp;
                            {{ $delegacion->sede_delegaciona }}
                        </td>
                        <td>
                            <ul style="list-style-type: none;">
                                @foreach ($delegacion->users as $user)
                                    <li>
                                        {{ $user->nombre }} {{$user->apaterno}} {{$user->amaterno}}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{-- Aquí es donde agregamos el botón de acción --}}
                            <ul class="list-none pl-0"  style="list-style-type: none;">
                                @foreach ($delegacion->users as $user)
                                    <li>
                                        <a href="{{ route('cotejador.listado', $user->id) }}" class="btn btn-primary btn-sm mb-2">
                                            Ver
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
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
