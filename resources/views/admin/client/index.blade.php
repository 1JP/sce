@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Clientes" ]
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
                        <div class="col-lg-3">
                            <h6>Clientes</h6>
                        </div>
                        <div class="col-lg-2 col-lg-3">
                            <admin-filter-select
                                :name="'Status'"
                                :options="[]"
                            ></admin-filter-select>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :name="'Cliente...'"
                                    :type="'text'"
                                    :icon="'fa fa-search'"
                                ></admin-filter-input>
                            </div>
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
                                <component-td :class="'align-middle'">
                                    <component-span-status :class="'bg-gradient-success'">
                                        Ativo
                                    </component-span-status>
                                </component-td>
                                <component-td :class="'align-middle text-center text-sm'">
                                    <span class="text-secondary text-xs font-weight-bold">40</span>
                                </component-td>
                                <component-td :class="'align-middle'">
                                    <component-dropdown :name="'dropdown-index-client'">
                                        <component-dropdown-item name="Visualizar" :route="'{{ route('admin.clientes.show', 1) }}'"></component-dropdown-item>
                                        <component-dropdown-item name="Editar" :route="'{{ route('admin.clientes.edit', 1) }}'"></component-dropdown-item>
                                        <component-dropdown-item name="Excluir" target="#destoryPost"></component-dropdown-item>
                                </component-td>
                            </admin-tr>
                        </template>
                    </admin-table>
                </template>
            </component-card>
        </div>
    </div>
</div>
@endsection