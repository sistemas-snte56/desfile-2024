@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>¡Hola, <strong>{{ auth()->user()->nombre; }}</strong>! Bienvenido.</h3>
@stop

@section('content')
    @switch(auth()->user()->roles->first()->name)
        @case('Administrador')
                @can('admin.dashboard')
                    @include('dashboard.administrador')
                @endcan
            @break
        @case('Coordinador')
                @can('coordinador.dashboard')
                    @include('dashboard.coordinador')
                @endcan
            @break
        @default
                @can('usuario.dashboard')
                    @include('dashboard.usuario')
                @endcan
    @endswitch
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    
@stop