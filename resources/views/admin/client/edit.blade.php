@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Clientes", "route" => route("admin.clientes.index") ],
        [ "name" => "Editar Cliente"]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <component-card
                :card-body="true"
            >
                <template v-slot:body>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nome</label>
                                <input class="form-control" type="text" value="nome">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Usúario</label>
                                <input class="form-control" type="email" value="nome do usuario">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Data de nascimento</label>
                                <input class="form-control" type="date" value="1995-10-10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">CPF</label>
                                <input class="form-control" type="text" value="131.766.888-45">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Telefone</label>
                                <input class="form-control" type="text" value="(31) 99989-4516">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Endereço</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Endereço</label>
                                <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Cidade</label>
                                <input class="form-control" type="text" value="New York">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Bairro</label>
                                <input class="form-control" type="text" value="United States">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Postal code</label>
                                <input class="form-control" type="text" value="437300">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Número</label>
                                <input class="form-control" type="text" value="437300">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Complemento</label>
                                <input class="form-control" type="text" value="437300">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Estado</label>
                                <select class="form-control" name="" id="">
                                    <option>MG</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                                <button type="button" class="btn bg-gradient-info m-1">
                                    Editar
                                </button>
                                <button type="button" class="btn bg-gradient-secondary m-1">
                                    Visualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </component-card>
        </div>
    </div>
</div>
@endsection