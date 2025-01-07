
@extends('adminlte::page')

@section('title', 'Crear delegación')

@section('content_header')
    <h1>Delegations</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>NUEVA DELEGACIÓN</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                <div style="margin-right:0px;" class="float-left">
                    <a href="{{ url('/admin/delegacion') }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
                </div>               
            </div>
            <div class="card-text">
                {!! Form::open(['route'=>['delegacion.store'],'method'=>'POST']) !!}
                    @csrf
                    <div class="row">
                        <x-adminlte-select name="select_region" label="Región" label-class="text-orange" fgroup-class="col-md-12">
                            <x-adminlte-options :options="$regiones" :selected="old('select_region')" empty-option="Selecciona" />
                        </x-adminlte-select>
                        <x-adminlte-input name="delegacion"  placeholder="Ejemplo D-I-00" label-class="text-orange" label="Delegación" type="text" fgroup-class="col-md-12" :value="old('delegacion')" />
                        <x-adminlte-input name="nivel"  placeholder="Ingresa nivel" label-class="text-orange" label="Nivel Educativo" type="text" fgroup-class="col-md-12" :value="old('nivel')" />
                        <x-adminlte-input name="sede"  placeholder="Ingresa sede" label-class="text-orange" label="Sede" type="text" fgroup-class="col-md-12" :value="old('sede')" />
                    </div>
                    <x-adminlte-button class="button" label-class="text-orange" label="Guardar" theme="primary" icon="fas fa-save" type="submit" />
                {!! Form::close() !!}
            </div>
        </div>  
    </div>
@stop

@section('css')
@stop

@section('js')
@stop