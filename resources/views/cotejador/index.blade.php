@extends('adminlte::page')

@section('title', 'Cotejador')

@section('content_header')
    <h1>&nbsp;</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>LISTADO DE REGISTROS POR REGIÓN</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                    &nbsp;               
            </div>
            <div class="card-text">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'ID',
                        'NOMBRE',
                        'SEDE',
                        'NÚMERO DE DELEGACIONES',
                        ['label' => 'ACCIONES', 'no-export' => true, 'width' => 12],
                    ];
                    
                    $config = [
                        'order' => [[0, 'asc']],
                        'columns' => [
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
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
                <x-adminlte-datatable id="table1" :heads="$heads"  :config="$config"  striped hoverable bordered compressed with-buttons>

                    @foreach ($regiones as $index => $region)
                        <tr>
                            <td> {{ $index + 1 }} </td>
                            <td> {{ $region->region}}  </td>
                            <td> {{ $region->sede}} </td>
                            <td> {{ $region->delegations_count}} </td>
                            <td>
                                <a href="{{route('cotejador.show',$region)}}" class="btn btn-primary btn-sm" >
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </x-adminlte-datatable>
            </div>
        </div>  
    </div>
@stop

@section('css')

@stop

@section('js')
     
@stop