@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Logs" ]
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
                        <div class="col-lg-1">
                            <h6>Logs</h6>
                        </div>
                        <div class="col-lg-1 col-lg-1">
                            <div class="form-group">
                                <admin-filter-select
                                    :name="'Ação'"
                                    :options="[]"
                                ></admin-filter-select>
                            </div>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :name="'Usuário...'"
                                    :type="'text'"
                                    :icon="'fa fa-search'"
                                ></admin-filter-input>
                            </div>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :type="'date'"
                                >
                                De:
                                </admin-filter-input>
                            </div>
                        </div>
                        <div class="col-lg-1 col-lg-3">
                            <div class="form-group input-group">
                                <admin-filter-input
                                    :type="'date'"
                                >
                                Para:
                                </admin-filter-input>
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
                                <component-td>
                                    <h6 class="mb-0 text-sm">Updated</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center text-sm'">
                                    <h6 class="mb-0 text-sm">Updated</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center'">
                                    <component-span-status :class="'bg-gradient-success'">
                                        08/12/2024 ás 00:47
                                    </component-span-status>
                                </component-td>
                                <component-td :class="'align-middle'">
                                    <component-dropdown :name="'dropdown-index'">
                                        <component-dropdown-item name="Visualizar" :route="'{{ route('admin.logs.show', 1) }}'"></component-dropdown-item>
                                    </component-dropdown>
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