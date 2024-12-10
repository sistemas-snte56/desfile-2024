
@extends('adminlte::page')

@section('title', 'Editar Role')

@section('content_header')
    <h1>Editar roles</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>EDITAR ROL</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                <div style="margin-right:0px;" class="float-left">
                    <a href="{{ url('/admin/role') }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
                </div>               
            </div>
            <div class="card-text">
                {!! Form::open(['route'=>['role.update',$role],'method'=>'PUT']) !!}
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="name"  placeholder="Cambia el nombre" label-class="text-orange" label="Cambia el nombre" type="text" fgroup-class="col-md-12" :value="old('name',$role->name)" />
                    </div>
                    <x-adminlte-button class="button" label-class="text-orange" label="Actualizar" theme="primary" icon="fas fa-save" type="submit" />
                {!! Form::close() !!}
            </div>
        </div>  
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop