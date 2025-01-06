
@extends('adminlte::page')

@section('title', 'Editar región')

@section('content_header')
    <h1>Región</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF;"><strong>EDITAR REGIÓN</strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                <div style="margin-right:0px;" class="float-left">
                    <a href="javascript:history.back()" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
                </div>               
            </div>
            <div class="card-text">
                {!! Form::open(['route'=>['region.update',$region],'method'=>'PUT']) !!}
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="name"  placeholder="Ingresa nombre" label-class="text-orange" label="Nombre" type="text" fgroup-class="col-md-12" :value="old('name',$region->region)" />
                        <x-adminlte-input name="sede"  placeholder="Ingresa sede" label-class="text-orange" label="Sede" type="text" fgroup-class="col-md-12" :value="old('sede',$region->sede)" />
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