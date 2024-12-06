@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- Delegación field --}}
        <div class="mb-3">
            <x-adminlte-select2 name="select_delegacion" data-placeholder="Selecciona una delegación" autofocus>
                <option value="" disabled selected>{{ __('Selecciona una delegación...') }}</option>
                @foreach ($delegaciones as $delegacion)
                    <option value="{{ $delegacion->id }}" {{ old('select_delegacion') == $delegacion->id ? 'selected' : '' }}>
                        {{ $delegacion->delegacion }} {{ $delegacion->nivel_delegaciona }}
                    </option>
                @endforeach
            </x-adminlte-select2>
        </div>  




        
        {{-- Example with placeholder (for Select) --}}
        <x-adminlte-select2 name="select_genero" data-placeholder="Selecciona un género">
            <option class="d-none"  value="" disabled selected>{{ __('Selecciona un género') }}</option>
            <option value="1" {{old('select_genero') == '1' ? 'selected' : ''}} >HOMBRE</option>
            <option value="2" {{old('select_genero') == '2' ? 'selected' : ''}} >MUJER</option>
        </x-adminlte-select2>


        <x-adminlte-select2 name="select_cargo" data-placeholder="Selecciona un cargo">
            <option class="d-none"  value="" disabled selected>{{ __('Selecciona un cargo') }}</option>
            <option value="SECRETARIO GENERAL" {{old('select_cargo') == 'SECRETARIO GENERAL' ? 'selected' : ''}} >SECRETARIO GENERAL</option>
            <option value="SECRETARIA GENERAL" {{old('select_cargo') == 'SECRETARIA GENERAL' ? 'selected' : ''}} >SECRETARIA GENERAL</option>
            <option value="REPRESENTANTE DE C.T." {{old('select_cargo') == 'REPRESENTANTE DE C.T.' ? 'selected' : ''}} >REPRESENTANTE DE C.T.</option>
        </x-adminlte-select2>












        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                   value="{{ old('nombre') }}" placeholder="{{ __('Nombre') }}" >

            <div class="input-group-append">
                <div class="input-group-text">
                   
                </div>
            </div>

            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Apellido Paterno field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror"
                   value="{{ old('apellido_paterno') }}" placeholder="{{ __('Apellido paterno') }}" >

            <div class="input-group-append">
                <div class="input-group-text">
                   
                </div>
            </div>

            @error('apellido_paterno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Apellido Materno field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido_materno" class="form-control @error('apellido_materno') is-invalid @enderror"
                   value="{{ old('apellido_materno') }}" placeholder="{{ __('Apellido materno') }}" >

            <div class="input-group-append">
                <div class="input-group-text">
                   
                </div>
            </div>

            @error('apellido_materno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
