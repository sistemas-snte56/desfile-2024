<section class="content">
    <div class="row justify-content-center"> <!-- Centrar la fila -->
        <div class="col-md-8">
            <x-adminlte-card title="Tarjeta de Información" theme="info" icon="fas fa-lg fa-bell">
                @php
                    // Contar los profesores cuyo id_user es igual al id del usuario autenticado
                    $teacher_count = \App\Models\Admin\Teacher::where('id_user', auth()->id())->count();
                @endphp

                <x-adminlte-profile-row-item icon="fas fa-lg fa-fw fa-user-friends fa-flip-horizontal" title="&nbsp;&nbsp;Tus usuarios registrados"
                    text="{{$teacher_count}}" url="{{route('usuario.index')}}" badge="lightblue"/>
                    
                <hr>
        
                @if(auth()->user()->status_lista)
                    <!-- Mostrar callout para 'Lista entregada' -->
                    <x-adminlte-callout theme="success" title-class="text-success text-uppercase"
                        icon="fas fa-sm fa-thumbs-up" title="Listado entregada">
                        <i>Ahora puedes descargar tus constancias dando clic en el botón descargar.</i>
                        <li>Revisa la lista de participantes.</li>
                        <li>Confirma los datos.</li>
                        <li>Haz clic en el botón de descarga.</li>
                    </x-adminlte-callout>
                @else
                    <!-- Mostrar callout para 'Lista no entregada' -->
                    <x-adminlte-callout theme="danger" title-class="text-danger text-uppercase"
                        icon="fas fa-sm fa-exclamation-circle" title="Listado no entregada">
                        <i>El listado de su delegación/ct aún no ha sido entregado en la Secretaría General.</i>
                    </x-adminlte-callout>
                @endif
                                             
            </x-adminlte-card>

        </div>
    </div> 
</section>