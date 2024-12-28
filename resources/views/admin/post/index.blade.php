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
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-1">
                            <h6>Posts</h6>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <admin-filter-select
                                :name="'Classificação Indicativa'"
                                :options="[]"
                            ></admin-filter-select>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <admin-filter-input
                                :name="'Post...'"
                                :type="'text'"
                                :icon="'fa fa-search'"
                            ></admin-filter-input>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <admin-filter-select
                                :name="'Categoria'"
                                :options="[]"
                            ></admin-filter-select>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-end">
                            <a href="{{ route('admin.posts.create') }}" class="btn bg-gradient-primary">
                                Cadastrar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <admin-table>
                        <template v-slot:thead>
                            @foreach ($ths as $th)
                                <admin-thead
                                    :class='@json($th['class'])'
                                    :name='@json($th['name'])'
                                ></admin-thead>
                            @endforeach
                        </template>
                        <template v-slot:tbody>
                            <admin-tr>
                                <component-td>
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                        <h6 class="mb-0 text-sm">Spotify</h6>
                                        </div>
                                    </div>
                                </component-td>
                                <component-td>
                                    <h6 class="mb-0 text-sm">Spotify</h6>
                                </component-td>
                                <component-td>
                                    <h6 class="mb-0 text-sm">Spotify</h6>
                                </component-td>
                                <component-td>
                                    <span class="me-2 text-xs font-weight-bold">60</span>
                                </component-td>
                                <component-td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">60%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </component-td>
                                <component-td :class="'align-middle'">
                                    <component-dropdown :name="'teste'">
                                        <component-dropdown-item name="Visualizar" :route="'{{ route('admin.posts.show', 1) }}'"></component-dropdown-item>
                                        <component-dropdown-item name="Editar" :route="'{{ route('admin.posts.edit', 1) }}'"></component-dropdown-item>
                                        <component-dropdown-item name="Excluir" target="#destoryPost"></component-dropdown-item>
                                        <li><hr class="dropdown-divider"></li>
                                        <component-dropdown-item name="Relatorio Geral" :route="'#'"></component-dropdown-item>
                                        <component-dropdown-item name="Relatorio de Comentarios" :route="'#'"></component-dropdown-item>
                                    </component-dropdown>
                                </component-td>
                            </admin-tr>
                        </template>
                    </admin-table>
                </div>
            </div>
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