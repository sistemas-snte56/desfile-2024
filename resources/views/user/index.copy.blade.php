@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <h2 >
        <strong class="font-semibold text-xl text-gray-800 leading-tight">
            Usuario
        </strong> 
    </h2>
@stop

@section('content')


    <form action="{{ route('usuario.profile.update',$user) }}" method="POST">
        @method('PUT') <!-- Esto genera el error -->
        @csrf        
        
        <div class="row justify-content-center">
            <div class="col-3 px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">Información de perfil</h3>
        
                <p class="mt-1 text-sm text-gray-600">
                    Actualice la información de su cuenta y la dirección de correo electrónico.
                </p>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        @php
                        $config = [
                            "title" => "Select multiple options...",
                            "liveSearch" => true,
                            "liveSearchPlaceholder" => "Search...",
                            "showTick" => true,
                            "actionsBox" => true,
                            ];
                        @endphp
            
                        {{-- Minimal --}}
                        <x-adminlte-select2 name="select_region" label="Región" fgroup-class="col-md-12" >
                            <option selected>{{ $user->delegations->region->region}} - {{$user->delegations->region->sede}}</option>
                            @foreach ($regiones as $reg)
                                <option value="">{{$reg->region}} - {{$reg->sede}}</option>
                            @endforeach
                        </x-adminlte-select2>

                        <x-adminlte-select2 name="select_delegacion" id="select_delegacion" label="Delegacion" fgroup-class="col-md-12" >
                            <option value="{{$user->delegations->id}}" selected>{{$user->delegations->delegacion}} / {{$user->delegations->nivel_delegaciona}} / {{$user->delegations->sede_delegaciona}}</option>
                            @foreach ($delegaciones as $deleg)
                                <option value="{{$deleg->id}}">{{$deleg->delegacion}} / {{$deleg->nivel_delegaciona}} / {{$deleg->sede_delegaciona}}</option>
                            @endforeach
                        </x-adminlte-select2>                        

                        <x-adminlte-select-bs name="select_cargo" id="select_cargo" label="Cargo"  fgroup-class="col-md-12" >
                            <option value="{{$user->cargo}}" selected>{{$user->cargo}}</option>
                            <option value="SECRETARIO GENERAL">SECRETARIO GENERAL</option>
                            <option value="SECRETARIA GENERAL">SECRETARIA GENERAL</option>
                            <option value="REPRESENTANTE DE CENTRO DE TRABAJO">REPRESENTANTE DE CENTRO DE TRABAJO</option>
                        </x-adminlte-select-bs>                            


                        <x-adminlte-input name="nombre" id="nombre" label="Nombre" 
                            fgroup-class="col-md-12"  value="{{$user->nombre}}" />

                        <x-adminlte-input name="apaterno" label="Apellido paterno" 
                            fgroup-class="col-md-12"  value="{{$user->apaterno}}" />
                    
                        <x-adminlte-input name="amaterno" label="Apellido materno" 
                            fgroup-class="col-md-12"  value="{{$user->amaterno}}" />
                    
                        <x-adminlte-input name="email" label="Apellido materno" 
                            fgroup-class="col-md-12"  value="{{$user->email}}" />
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row justify-content-center">
            <div class="col-3 px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900"> Actualizar contraseña</h3>
        
                <p class="mt-1 text-sm text-gray-600">
                    Asegúrese que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.
                </p>
            </div>        

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <!-- Contraseña Actual -->
                            <x-adminlte-input name="current_password" label="Contraseña Actual" type="password" placeholder="Introduce tu contraseña actual" fgroup-class="col-md-12"/>

                            <!-- Nueva Contraseña -->
                            <x-adminlte-input name="new_password" label="Nueva Contraseña" type="password" placeholder="Introduce la nueva contraseña" fgroup-class="col-md-12"/>

                            <!-- Confirmar Contraseña -->
                            <x-adminlte-input name="new_password_confirmation" label="Confirmar Contraseña" type="password" placeholder="Confirma la nueva contraseña" fgroup-class="col-md-12"/>
                                                                                   
                        </div>                            
                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                </div>                 
            </div>
        </div>
    </form>
    
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