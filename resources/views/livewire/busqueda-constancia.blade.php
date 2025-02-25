<div>
    <div class="container">
        <div class="subscribe-title text-center">
            <h2>
                Busca tu constancia del "Desfile Primero de Mayo 2025"
            </h2>
            <p>
                Listrace offer you to list your business with us and we very much able to promote your Business.
            </p>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="subscription-input-group">
                    <form wire:submit.prevent="buscarConstancia">
                        <input class="subscription-input-form" placeholder="Ingresa tu número de personal" wire:model="numero_de_personal">
                        <!-- Mostrar error si hay un error con el campo id_user -->
                        @error('numero_de_personal')
                            <div class="error mb-4" style="color: red; margin-top: 10px; margin-bottom: 10px; margin-left: 5px; font-size: 14px;  ">
                                <div class="single-blog-item-txt">
                                    <p class="explore-price">
                                        {{ $message }}
                                    </p>
                                </div>
                            </div>
                        @enderror                      
                        <button type="submit" class="appsLand-btn subscribe-btn">
                            Buscar constancia
                        </button>
                    </form>
                </div>
            </div>	
        </div>
    </div>


    <!-- Mostrar los nombres de los maestros si existen -->
    @if ($teachers && $teachers->isNotEmpty())
        <div class="container">
            <div class="row">
                <div class="single-explore-txt bg-theme-5">
                    <h2>Registros:  &nbsp;<span class="explore-rating">{{$teachers->count()}}</span></h2>
                    <hr>
                    <div class="col-12 mt-4">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Constancia</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                    <tr>
                                        <td>{{ $teacher->nombre }} {{ $teacher->apaterno }} {{ $teacher->amaterno }}</td>
                                        <td> 
                                            @if ($teacher->user->status_lista)
                                                <a href="{{route('teacher.constancia',$teacher->codigo_id)}}" target="_blanck" class="close-btn open-btn shadow" style="display: inline-flex; align-items: center;">
                                                    <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>
                                                    Descargar
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @elseif(session()->has('error'))
        <div class="error-message">
            <p>{{ session('error') }}</p>
        </div>
    @endif


</div>
