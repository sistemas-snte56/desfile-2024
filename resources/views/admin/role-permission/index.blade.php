
@extends('adminlte::page')

@section('title', 'Asignar Permiso a Rol')

@section('content_header')
    <h1>Permisos</h1>
@stop

@section('content')
<div class="card">
        <div class="card-header"style="background-color: #ee7a00;">
            <h4 style="color:#FFFFFF; text-transform: uppercase;"><strong>ASIGNAR PERMISOS AL ROL {{$role->name}} </strong></h4>
        </div>
        <div class="card-body">
            <div class="card-title mb-4">
                <div style="margin-right:0px;" class="float-left">
                    <a href="{{ url('/admin/role') }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
                </div>               
            </div>
            <div class="card-text">
                {!! Form::open(['route'=> ['role.update',$role],'method'=>'POST']) !!}
                    @csrf
                    @method("PUT")
                    {{-- <div class="row">
                        <x-adminlte-input name="name"  placeholder="Ingresa nombre" label-class="text-orange" label="Nombre" type="text" fgroup-class="col-md-12" :value="old('name')" />
                    </div>
                    <x-adminlte-button class="button" label-class="text-orange" label="Guardar" theme="primary" icon="fas fa-save" type="submit" /> --}}
                
                                
                    {{-- With multiple slots, and plugin config parameters --}}
                    @php
                        $config = [
                            "placeholder" => "Seleccione los permisos...",
                            "allowClear" => true,
                        ];
                    @endphp
                    <div class="row">
                        <x-adminlte-select2 id="selectPermissions" name="selectPermissions[]" label="Permisos"
                            label-class="text-orange" :config="$config" multiple fgroup-class="col-md-12">
                            <x-slot name="appendSlot">
                                <x-adminlte-button theme="outline-dark" label="Clear" icon="fas fa-lg fa-ban text-orange"/>
                            </x-slot>
    
                            @foreach ($permissions as $item)
                                <option value="{{$item->id}}" {{ in_array($item->id,$rolePermissions) ? 'selected' : '' }} >
                                        {{ $item->name }}
                                </option>
                            @endforeach
                        </x-adminlte-select2>
                    </div>

                    <x-adminlte-button class="button" label-class="text-orange" label="Guardar" theme="primary" icon="fas fa-save" type="submit" />

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

@stop