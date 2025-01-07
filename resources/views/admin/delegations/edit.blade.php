
@extends('adminlte::page')

@section('title', 'Editar delegación')

@section('content_header')
    <h1>Delegations</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>EDITAR DELEGACIÓN</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                <div style="margin-right:0px;" class="float-left">
                    <a href="javascript:history.back()" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
                </div>               
            </div>
            <div class="card-text">
                {!! Form::open(['route'=>['delegacion.update',$delegacion],'method'=>'PUT']) !!}
                    @csrf
                    <div class="row">
                        <x-adminlte-select name="select_region" label="Región" label-class="text-orange" fgroup-class="col-md-12">
                            <option value=" {{ $delegacion->id_region }} "> {{ $delegacion->region->region }} - {{ $delegacion->region->sede }} </option>
                            <x-adminlte-options :options="$regiones" :selected="old('select_region')" empty-option="Selecciona" />
                        </x-adminlte-select>                        
                        <x-adminlte-input name="delegacion"  placeholder="Ingresa nombre" label-class="text-orange" label="Delegación" type="text" fgroup-class="col-md-12" :value="old('name',$delegacion->delegacion)" />
                        <x-adminlte-input name="nivel"  placeholder="Ingresa nivel" label-class="text-orange" label="Nivel" type="text" fgroup-class="col-md-12" :value="old('nivel',$delegacion->nivel_delegaciona)" />
                        <x-adminlte-input name="sede"  placeholder="Ingresa sede" label-class="text-orange" label="Sede" type="text" fgroup-class="col-md-12" :value="old('sede',$delegacion->sede_delegaciona)" />
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