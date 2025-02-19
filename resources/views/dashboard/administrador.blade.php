<section class="content">
    <div class="row justify-content-center"> <!-- Centrar la fila -->
        <div class="col-md-8">
            <x-adminlte-card title="Tarjeta de Información" theme="info" icon="fas fa-lg fa-bell">

                <x-adminlte-profile-row-item icon="fas fa-lg fa-fw fa-user-friends fa-flip-horizontal" title="&nbsp;&nbsp;Tus usuarios registrados"
                    text="243" url="#" badge="lightblue"/>
                    
                <hr>

                <x-adminlte-callout theme="success" title-class="text-success text-uppercase"
                    icon="fas fa-sm fa-thumbs-up" title="Lista entregada">
                    <i>Ahora puedes descargar tus constancias!</i>
                    <ul>
                        <li>Revisa la lista de participantes.</li>
                        <li>Confirma los datos.</li>
                        <li>Haz clic en el botón de descarga.</li>
                    </ul> <!-- Lista -->
                </x-adminlte-callout>

                <hr>

                <x-adminlte-callout theme="danger" title-class="text-danger text-uppercase"
                    icon="fas fa-sm fa-exclamation-circle" title="Lista no entregada">
                    <i>There was an error on the payment procedure!</i>
                </x-adminlte-callout>                                
            </x-adminlte-card>

        </div>
    </div> 
</section>