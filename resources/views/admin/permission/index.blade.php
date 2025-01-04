@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Permissões" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <component-card
                :class-card="'mb-4'"
                :card-header="true"
                :class-header="'pb-0'"
                :card-body="true"
                :class-body="'px-0 pt-0 pb-2'"
            >
                <template v-slot:header>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Permissões</h6>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :name="'Permissão...'"
                                    :type="'text'"
                                    :icon="'fa fa-search'"
                                ></admin-filter-input>
                            </div>
                        </div>
                        <div class="col-lg-5 d-flex justify-content-end">
                            <button type="button" class="btn bg-gradient-primary h-50" data-bs-toggle="modal" data-bs-target="#createAndEditPermissionModal">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </template>
                <template v-slot:body>
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
                                <component-td :class="'align-middle text-center text-sm'">
                                    <span class="text-secondary text-xs font-weight-bold">40</span>
                                </component-td>
                                <component-td :class="'align-middle'">
                                    <component-dropdown :name="'dropdown-index-client'">
                                        <component-dropdown-item name="Editar" :route="'{{ route('admin.perimissoes.edit', 1) }}'"></component-dropdown-item>
                                        <component-dropdown-item name="Excluir" target="#destroyMemberModal"></component-dropdown-item>
                                </component-td>
                            </admin-tr>
                        </template>
                    </admin-table>
                </template>
            </component-card>
        </div>
    </div>
</div>

<model :title="'Cadastrar Permissão'" :name="'createAndEditPermissionModal'">
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

    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save</button>
    </template>
</model>

<model :title="'Excluir Permissão'" :name="'destroyPermissionModal'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir essa Permissão?</h4>
        <p>Todos os usuários relacionados a essa Permissão perderam suas autorizações do sistema</p>
    </div>

    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>
@endsection