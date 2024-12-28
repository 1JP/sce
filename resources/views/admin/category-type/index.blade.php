@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Tipos de Categorias" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Tipos de Categorias</h6>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <admin-filter-input
                                :name="'Categoria...'"
                                :type="'text'"
                                :icon="'fa fa-search'"
                            ></admin-filter-input>
                        </div>
                        <div class="col-lg-5 d-flex justify-content-end">
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
                                    <p class="mb-0 text-sm">Ainda assim, existem dúvidas a respeito de como a constante divulgação das informações possibilita uma melhor visão global das novas proposições.</p>
                                </component-td>
                                <component-td :class="'align-middle'">
                                    <component-dropdown :name="'teste'">
                                        <component-dropdown-item name="Editar" route="#"></component-dropdown-item>
                                        <component-dropdown-item name="Excluir" target="#destoryCategory"></component-dropdown-item>
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

<model :title="'Cadastrar Categoria'" :name="'createAndEditCategoryModal'">
    <div class="row">
        <div class="col-md-12">
          <div class="form-group has-success">
            <input type="text" placeholder="Nome" class="form-control is-valid" />
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group has-danger">
            <input type="email" placeholder="Error Input" class="form-control is-invalid" />
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group has-success">
                <textarea placeholder="Descrição" class="form-control is-valid"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group has-danger">
                <textarea placeholder="Descrição" class="form-control is-invalid"></textarea>
            </div>
        </div>
    </div>

    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save</button>
    </template>
</model>

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