@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Membros" ]
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
                        <div class="col-lg-2">
                            <h6>Membros</h6>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :name="'Nome...'"
                                    :type="'text'"
                                    :icon="'fa fa-search'"
                                ></admin-filter-input>
                            </div>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :name="'E-mail...'"
                                    :type="'text'"
                                    :icon="'fa fa-search'"
                                ></admin-filter-input>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end">
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createAndEditMemberModal">
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
                                <component-td>
                                    <h6 class="mb-0 text-sm">e-mail@gmail.com</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center text-sm'">
                                    <span class="text-secondary text-xs font-weight-bold">(31) 99927-1156</span>
                                </component-td>
                                <component-td :class="'align-middle'">
                                    <component-dropdown :name="'dropdown-index-client'">
                                        <component-dropdown-item name="Editar" :route="'{{ route('admin.clientes.edit', 1) }}'"></component-dropdown-item>
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

<model :title="'Cadastrar Membro'" :name="'createAndEditMemberModal'">
    <div class="row">
        <div class="col-md-12">
          <div class="form-group has-success">
            <input type="text" placeholder="Nome" class="form-control is-valid" />
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group has-danger">
            <input type="email" placeholder="Nome" class="form-control is-invalid" />
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group has-success">
              <input type="text" placeholder="E-mail" class="form-control is-valid" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group has-danger">
              <input type="email" placeholder="E-mail" class="form-control is-invalid" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group has-success">
              <input type="text" placeholder="Telefone" class="form-control is-valid" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group has-danger">
              <input type="email" placeholder="Telefone" class="form-control is-invalid" />
            </div>
        </div>
    </div>

    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save</button>
    </template>
</model>

<model :title="'Excluir Membro'" :name="'destroyMemberModal'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir essa Membro?</h4>
    </div>

    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>
@endsection