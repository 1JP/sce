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
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-2">
                            <h6>Categorias</h6>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <admin-filter-select
                                :name="'Classificação Indicativa'"
                                :options="[]"
                            ></admin-filter-select>
                        </div>
                        <div class="col-lg-1 col-lg-2">
                            <admin-filter-input
                                :name="'Categoria...'"
                                :type="'text'"
                                :icon="'fa fa-search'"
                            ></admin-filter-input>
                        </div>
                        <div class="col-lg-1 col-lg-2">
                            <admin-filter-select
                                :name="'Status'"
                                :options="[]"
                            ></admin-filter-select>
                        </div>
                        <div class="col-lg-3 d-flex justify-content-end">
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createAndEditCategoryModal">
                                Cadastrar
                            </button>
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
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">John Michael</h6>
                                        </div>
                                    </div>
                                </component-td>
                                <component-td>
                                    <h6 class="mb-0 text-sm">Manager</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center text-sm'">
                                    <span class="text-secondary text-xs font-weight-bold">40</span>
                                </component-td>
                                <component-td :class="'align-middle text-center'">
                                    <component-span-status :class="'bg-gradient-success'">Online</component-span-status>
                                </component-td>
                                <component-td>
                                    <component-dropdown :name="'dropdown-category-1'">
                                        <component-dropdown-item :name="'Editar'"></component-dropdown-item>
                                        <component-dropdown-item :name="'Excluir'"></component-dropdown-item>
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
@endsection