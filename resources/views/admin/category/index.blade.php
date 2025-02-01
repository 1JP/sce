@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Categorias" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-category-index
                :types='@json($types)'
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<admin-category-create
    :title="'Cadastrar Categoria'"
    :name-id="'createCategoryModal'"
    :types='@json($types)'
/>

<model :title="'Excluir Categoria'" :name="'destoryCategory'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir essa categoria?</h4>
        <p>Todos os posts relacionados a essa Categoria será excluidos também</p>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>
@endsection