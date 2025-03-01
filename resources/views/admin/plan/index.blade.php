@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Planos" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-plan-index
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<admin-plan-create
    :title="'Cadastrar Categoria'"
    :name-id="'createPlanModal'"
/>

<model :title="'Visualizar Plano'" :name="'viewPlanoModal'">
    <div class="row">
        <div class="col-lg-12 col-lg-3">
            <div class="form-group"> 
                <h5>Descrição:</h5> 
                <p class="text-center">A nível organizacional, o consenso sobre a necessidade de qualificação oferece uma interessante oportunidade para verificação das diversas correntes de pensamento.</p> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Filmes:</h5> 
                <p>7</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Series:</h5> 
                <p>7</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Livros:</h5> 
                <p>7</p> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Ativo:</h5> 
                <p>Sim</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Assinatura:</h5> 
                <p>7</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Valor:</h5> 
                <p>R$ 70,00</p> 
            </div>
        </div>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
    </template>
</model>

<model :title="'Excluir Plano'" :name="'destoryPlan'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir essa Plano?</h4>
        <p>Todas assinaturas relacionados a essa Plano continuaram a ser cobrados no entanto o plano será excluido!!!</p>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>
@endsection