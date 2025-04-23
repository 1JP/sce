@extends('layouts.admin-app')

@section('css')
    <style>
        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid #e9ecef;
        }
    </style>
@endsection

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-post-index 
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<model :title="'Excluir Post'" :name="'destoryPost'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir esse post?</h4>
        <p>Todos os comentarios, likes e deslikes relacionados a esse post será excluidos</p>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>
@endsection