@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3" style="">
                <list-group :class-item="'list-group-flush mb-5'">
                    <list-group-item :class-item="'active'">Minha conta</list-group-item>
                    @if (Auth::user()->hasRole('Usuario'))
                        <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Seja ser um cliente?
                            </a>
                        </list-group-item>
                    @else
                        <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                            <a href="#">
                                Área administrativa
                            </a>
                        </list-group-item>
                        <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                            <a href="{{ route('pagamento.show', 1) }}">
                                Assinatura
                            </a>
                        </list-group-item>
                    @endif
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        <a href="#">
                            Sair
                        </a>
                    </list-group-item>
                </list-group>
            </div>
            <div class="col-lg-9">
                <site-create-user 
                    :email="'{{ Auth::user()->email }}'" 
                    :route-form="'{{ route('usuarios.update', Auth::user()->id) }}'"
                    :is-update="true"
                />
            </div>
        </div>
    </div>
</div>

<model :title="'Deseja ser um cliente?'" :name="'exampleModal'">
    Deseja ser um cliente para o público comentar sobre o seu livro, filme, série, anime até mesmo seu mangá?
    So clicar <b>Sim</b>
    <template v-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary">Sim</button>
    </template>
</model>
@endsection