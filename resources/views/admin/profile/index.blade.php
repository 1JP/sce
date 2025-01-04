@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Usuário" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 text-left">
            <component-card
                :class-card="'shadow-lg border'"
                :card-body="true"
            >
                <template v-slot:body>
                    <form class="">
                        <div class="form-group"> 
                            <label>Nome</label> 
                            <input type="email" class="form-control"> 
                        </div>
                        <div class="form-group"> 
                            <label>E-mail</label> 
                            <input type="email" class="form-control"> 
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                            <a class="btn btn-outline-primary m-1" href="{{ route("admin.dashboard") }}">Cancelar</a>
                            <a class="btn btn-primary m-1" href="#">Salvar alterações</a>
                            </div>
                        </div>
                    </form>
                </template>
            </component-card>
        </div>
    </div>
</div>

@endsection