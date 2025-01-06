@extends('adminlte::page')

@section('title', 'Regiones')

@section('content_header')
    <h1>regions</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>LISTADO DE TODAS LAS REGIONES</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                    <a href=" {{route('region.create')}} " class="btn bg-primary float-right">
                        <i class="fa fa-sm fa-fw fa-pen"></i> Nueva region
                    </a>                
            </div>
            <div class="card-text">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        ['label'=>'ID', 'width'=>8],
                        'NOMBRE',
                        ['label' => 'ACCIONES', 'no-export' => true, 'width' => 22],
                    ];
                    
                    $config = [
                        'order' => [[0, 'asc']],
                        'columns' => [
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

                    @foreach ($regiones as $region)
                        <tr>
                            <td> {{ $region->id }} </td>
                            <td> {{$region->region}} {{$region->sede}} </td>
                            <td>
                                <a href="{{route('region.edit',$region)}}" class="btn btn-success btn-sm" >
                                    Editar
                                </a>
                                {!! Form::open(['route' => ['region.destroy',$region], 'method' => 'DELETE', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
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
    @if(session('success_region'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_region') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'La región que registraste se guardo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif   

    @if(session('update_region'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_region') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'La región se actualizo satisfactoriamente.',
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

    @if(session('destroy_region'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('destroy_region') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'La región se ha eliminado satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif         
@stop