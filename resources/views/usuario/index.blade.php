@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <x-adminlte-card title="INFORMACIÓN" theme="secondary" icon="fas fa-lg fa-user" removable collapsible>
        <h5 class="card-title mb-3">
            {{$user->nombre}} {{$user->apaterno}} {{$user->amaterno}}&emsp; | &emsp;
            <a href="{{ route('usuario.show', $user->id) }}">
                <button type="button" class="btn btn-link">PERFIL COMPLETO</button>
            </a>
        </h5>
        <p class="card-text">
            {{-- <strong>NOMBRE:</strong> {{$user->nombre}} {{$user->apaterno}} {{$user->amaterno}}<br> --}}
            <strong>CARGO:</strong> {{$user->cargo}} -
            {{ $user->delegations->delegacion }} /
            {{ $user->delegations->nivel_delegaciona }} /
            {{ $user->delegations->sede_delegaciona }} /
            {{ $user->delegations->region->region }} -
            {{ $user->delegations->region->sede }}<br>
            <strong>FECHA DE REGISTRO:</strong> {{ $user->created_at->format('d/m/Y') }}<br>
        </p>
    </x-adminlte-card>
@stop

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #ee7a00;">
        <h4 style="color:#FFFFFF;"><strong>LISTA DE ASISTENTES</strong></h4>
    </div>
    <div class="card-body">
        <div class="card-title mb-4">
            <a href=" {{route('usuario.teacher.create')}} " class="btn bg-primary float-right">
                <i class="fa fa-sm fa-fw fa-pen"></i> Nuevo registro
            </a>
        </div>
        <div class="card-text">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'DELEGACION',
                    'NOMBRE',
                    'NUM. DE PERSONAL',
                    'RFC',
                    'TELÉFONO',
                    'CORREO ELECTRÓNICO',
                    'FOLIO',
                    ['label' => 'CONSTANCIA', 'no-export' => true, 'width' => 10],
                    ['label' => 'ACCIONES', 'no-export' => true, 'width' => 10],
                ];

                $config = [
                'order' => [[1, 'asc']],
                'columns' => [
                    ['orderable' => false],
                    ['orderable' => false, 'visible' => false],
                    ['orderable' => true],
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

                $key = 1;
            @endphp
            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable bordered compressed with-buttons>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $key ++ }}</td>
                        <td>

                            {{ $user->delegations->delegacion }} /
                            {{ $user->delegations->region->region }} 

                        </td>
                        <td> {{ $teacher->nombre }} {{ $teacher->apaterno }} {{ $teacher->amaterno }} </td>
                        <td> {{ $teacher->npersonal }} </td>
                        <td> {{ $teacher->rfc }} </td>
                        <td> {{ $teacher->telefono }} </td>
                        <td> {{ $teacher->email }} </td>
                        <td> {{ $teacher->folio }} </td>
                        <td> 
                            {!! Form::open(['route' => ['usuario.teacher.constancia',$teacher->codigo_id], 'method' => 'POST', 'style' => 'display: inline', 'target' => '_blank']) !!}
                                @csrf
                                <div class="form-group">
                                    {!! Form::submit('Pdf', ['class' => 'btn btn-primary btn-sm']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                        <td>
                            <a href="{{route('usuario.teacher.edit',$teacher->slug)}}" class="btn btn-success btn-sm" >
                                Editar
                            </a>
                            {!! Form::open(['route' => ['usuario.teacher.destroy',$teacher->slug], 'method' => 'DELETE', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
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
    @if(session('success_maestro'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_maestro') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'El usuario que registraste se guardo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif     
    @if(session('update_maestro'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_maestro') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'El usuario que registraste se actualizo satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif    
    @if(session('destroy_teacher'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('destroy_teacher') }}"
                Swal.fire({
                    icon: 'warning',
                    title: mensaje,
                    text: 'El usuario se ha eliminado satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif  
    @if(session('error_404'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('error_404') }}"
                Swal.fire({
                    icon: 'warning',
                    title: mensaje,
                    text: 'El usuario no se encuntra en el sistema.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif  
    @if(session('error_500'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('error_500') }}"
                Swal.fire({
                    icon: 'warning',
                    title: mensaje,
                    text: 'Se produjo un error al intentar eliminar el usuario.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif  
@stop