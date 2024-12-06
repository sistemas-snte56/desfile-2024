@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    
<div>
    <h5 style="font-weight: bold;">
        <x-adminlte-info-box title="        {{$user->nombre}}
            {{$user->apaterno}}
            {{$user->amaterno}}" text="        {{$user->cargo}} - 
            {{ $user->delegations->delegacion }} /
            {{ $user->delegations->nivel_delegaciona }} /
            {{ $user->delegations->sede_delegaciona }} /
            {{ $user->delegations->region->region }} - 
            {{ $user->delegations->region->sede }}" icon="fas fa-lg fa-user text-success"
        theme="gradient-success" icon-theme="white"/>
    </h5>





</div>

    <div class="row">

        <a href=" {{route('usuario.edit',$user)}} " class="btn bg-info float-right">
            <i class="fa fa-sm fa-fw fa-user"></i> Perfil
        </a>  


    </div>

    
@stop

@section('content')
    <div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>LISTA DE ASISTENTES</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                    <a href=" # " class="btn bg-primary float-right">
                        <i class="fa fa-sm fa-fw fa-pen"></i> Nuevo user
                    </a>                
            </div>
            <div class="card-text">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'ID',
                        'NOMBRE',
                        'A. PATERNO',
                        'A. MATERNO',
                        'DELEGACIÓN',
                        'CORREO ELECTRÓNICO',
                        'PERMISOS',
                        ['label' => 'ACCIONES', 'no-export' => true, 'width' => 10],
                    ];
                    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>';
                    $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>';                                
                    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </button>';


                    $config = [
                        'order' => [[0, 'asc']],
                        'columns' => [
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
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
                <x-adminlte-datatable id="table1" :heads="$heads"  :config="$config"  striped hoverable bordered compressed with-buttons>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>



                </x-adminlte-datatable>
            </div>
        </div>  
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @if(session('success'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'Los datos que registraste se guardaron satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif 
@stop

