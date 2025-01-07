@extends('adminlte::page')

@section('title', 'Delegaciones')

@section('content_header')
    <h1>Delegations</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>LISTADO DE TODAS LAS DELEGACIONES</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                    <a href=" {{route('delegacion.create')}} " class="btn bg-primary float-right">
                        <i class="fa fa-sm fa-fw fa-pen"></i> Nueva delegación
                    </a>                
            </div>
            <div class="card-text">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        'NO',
                        'REGIÓN',
                        'DELEGACIÓN',
                        'NIVEL',
                        'SEDE',
                        ['label' => 'ACCIONES', 'no-export' => true, 'width' => 12],
                    ];
                    
                    $config = [
                        'order' => [[1, 'asc']],
                        'columns' => [
                            ['orderable' => false], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => true], 
                            ['orderable' => false], 
                        ],
                        'language' => [
                            'url' => 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json',
                        ],
                        'pageLength' => 100, // Configuración por defecto de la cantidad de entradas por página
                        'lengthMenu' => [50, 100, 200], // Opciones de entradas por página       
                        'responsive' => true,                 
                    ];
                @endphp
                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads"  :config="$config"  striped hoverable bordered compressed with-buttons>

                    @foreach ($delegaciones as $key => $delegacion)
                        <tr>
                            <td> {{ $key + 1}} </td>
                            <td> {{$delegacion->delegacion}}</td>
                            <td> {{$delegacion->nivel_delegaciona}}</td>
                            <td> {{$delegacion->sede_delegaciona}} </td>
                            <td> {{ $delegacion->region->region }} - {{ $delegacion->region->sede }} </td>
                            <td>
                                <a href="{{route('delegacion.edit',$delegacion)}}" class="btn btn-success btn-sm" >
                                    Editar
                                </a>
                                {!! Form::open(['route' => ['delegacion.destroy',$delegacion], 'method' => 'DELETE', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
                                    @csrf
                                    {!! Form::button('Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

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
    @if(session('success_delegacion'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_delegacion') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'La delegación que registraste se guardo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif   

    @if(session('update_delegacion'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_delegacion') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'La delegación se actualizo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif   

    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borrarlo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    }
                });

            })
        });
    </script>    

    @if(session('destroy_delegacion'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('destroy_delegacion') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'La delegación se ha eliminado satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif         
@stop