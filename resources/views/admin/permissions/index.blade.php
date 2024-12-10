@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>LISTADO DE TODOS LOS PERMISOS</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                    <a href=" {{route('permission.create')}} " class="btn bg-primary float-right">
                        <i class="fa fa-sm fa-fw fa-pen"></i> Nuevo permiso
                    </a>                
            </div>
            <div class="card-text">
                {{-- Setup data for datatables --}}
                @php
                    $heads = [
                        ['label'=>'ID', 'width'=>8],
                        'NOMBRE',
                        ['label' => 'ACCIONES', 'no-export' => true, 'width' => 12],
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
                        'pageLength' => 10, // Configuración por defecto de la cantidad de entradas por página
                        'lengthMenu' => [50, 100, 200], // Opciones de entradas por página       
                        'responsive' => true,                 
                    ];
                @endphp
                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads"  :config="$config"  striped hoverable bordered compressed with-buttons>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td> {{$permission->id}} </td>
                            <td> {{$permission->name}} </td>
                            <td>
                                <a href="{{route('permission.edit',$permission)}}" class="btn btn-success btn-sm" >
                                    Editar
                                </a>

                                {!! Form::open(['route' => ['permission.destroy',$permission], 'method' => 'DELETE', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
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
    @if(session('success_permission'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_permission') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'El permiso que registraste se guardo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif     
    @if(session('update_permission'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_permission') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'El permiso que registraste se actualizo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif     

    @if(session('destroy_permission'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('destroy_permission') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'El permiso fue eliminado satisfactoriamente.',
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
@stop