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
            <select class="form-control form-control-lg is-valid">
                <option>Classificação Indicativas</option>
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group has-danger">
            <select class="form-control form-control-lg is-invalid">
                <option>Classificação Indicativas</option>
            </select>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                <label class="form-check-label" for="flexSwitchCheckDefault">Ativo</label>
              </div>
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