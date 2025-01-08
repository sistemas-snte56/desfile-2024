
@extends('adminlte::page')

@section('title', 'Actualizar registro')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>EDITAR USUARIO</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                <div style="margin-right:0px;" class="float-left">
                    <a href="{{ url('/usuario/dashboard') }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
                </div>               
            </div>
            <div class="card-text">
                {!! Form::open(['route'=>['usuario.teacher.update',$teacher->slug],'method'=>'PUT']) !!}                
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="nombre"  placeholder="Ingresa nombre" label-class="text-orange" label="Nombre (s)" type="text" fgroup-class="col-md-12" :value="old('nombre',$teacher->nombre)" />
                        <x-adminlte-input name="apellido_paterno"  placeholder="Ingresa primer apellido" label-class="text-orange" label="Apellido paterno" type="text" fgroup-class="col-md-12" :value="old('apellido_paterno',$teacher->apaterno)" />
                        <x-adminlte-input name="apellido_materno"  placeholder="Ingresa segundo apellido" label-class="text-orange" label="Apellido materno" type="text" fgroup-class="col-md-12" :value="old('apellido_materno',$teacher->amaterno)" />
                        <x-adminlte-input name="npersonal"  placeholder="Ingresa su número de personal" label-class="text-orange" label="Ingresa número de personal" type="numeric" fgroup-class="col-md-12" :value="old('npersonal',$teacher->npersonal)" />
                        <x-adminlte-input name="rfc"  placeholder="Ingresa segundo apellido" label-class="text-orange" label="Ingresa RFC" type="text" fgroup-class="col-md-12" :value="old('rfc',$teacher->rfc)" />
                        <x-adminlte-select name="select_genero" label-class="text-orange" label="Género" fgroup-class="col-md-12">
                            <option value="{{$teacher->genero}}"> {{$teacher->genero}} </option>
                            <x-adminlte-options :options="['Hombre' => 'Hombre', 'Mujer' => 'Mujer']" :selected="old('select_genero',$teacher->genero)"  empty-option="Selecciona una opción..."/>
                        </x-adminlte-select>                       
                        <x-adminlte-input name="telefono"  placeholder="Número telefónico" label-class="text-orange" label="Celular" type="numeric" fgroup-class="col-md-12" :value="old('telefono',$teacher->telefono)" />
                        <x-adminlte-input name="email"  placeholder="Correo" label-class="text-orange" label="Correo electrónico" type="email" fgroup-class="col-md-12" :value="old('email',$teacher->email)" />
                    </div>
                    <x-adminlte-button class="button" label-class="text-orange" label="Actualizar" theme="primary" icon="fas fa-save" type="submit" />
                {!! Form::close() !!}
            </div>
        </div>  
    </div>
@stop

@section('css')
@stop

@section('js')
@stop