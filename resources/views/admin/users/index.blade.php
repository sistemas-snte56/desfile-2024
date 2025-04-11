@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>LISTADO DE TODOS LOS USUARIOS</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                    <a href=" {{route('user.create')}} " class="btn bg-primary float-right">
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
                        'ESTATUS',
                        'ROL',
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

                    @foreach ($users as $user)
                        <tr>
                            <td> {{$user->id}} </td>
                            <td> {{$user->nombre}} </td>
                            <td> {{$user->apaterno}} </td>
                            <td> {{$user->amaterno}} </td>
                            <td> {{$user->delegations->delegacion}} {{ $user->delegations->nivel_delegaciona }} </td>
                            <td> {{$user->email}} </td>
                            <td>
                                @if ($user->status_lista)
                                    <small style="color: green; font-weight: bold;">
                                        <i class="fas fa-check-circle"></i> ENTREGADO
                                    </small>
                                @else
                                    <small style="color: red; font-weight: bold;">
                                        <i class="fas fa-times-circle"></i> AUN NO ENTREGADO
                                    </small>
                                @endif
                            </td>
                            <td>  
                                @foreach ($user->roles as $role)
                                    <h5><span class="badge badge-primary">{{$role->name}} </span></h5>
                                @endforeach
                            </td>
                            <td>

                                <a href="{{route('user.show',$user)}}" class="btn btn-success btn-sm" >
                                    Editar
                                </a>
                                {!! Form::open(['route' => ['user.destroy',$user], 'method' => 'DELETE', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
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
    @if(session('success_user'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_user') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'Se asigno rol de forma satisfactoria.',
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