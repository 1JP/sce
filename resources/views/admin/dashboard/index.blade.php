@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Dashboard" ]
    ])'></breadcrumb>
@endsection

@section('content')
    @php
        $infos = [
            [
                "name" => "Novas Assinaturas",
                "value" => "$53,00",
                "description" => "+55% Último mês",
                "color" => "shadow-primary bg-gradient-primary",
                "icon" => "ni ni-money-coins"
            ],
            [
                "name" => "Usuários",
                "value" => "4",
                "description" => "+3% Último mês",
                "color" => "shadow-danger bg-gradient-danger",
                "icon" => "ni ni-world"
            ],
            [
                "name" => "Novos Clientes",
                "value" => "+3",
                "description" => "-2% Último mês",
                "color" => "bg-gradient-success shadow-success",
                "icon" => "ni ni-paper-diploma"
            ],
            [
                "name" => "Valor total",
                "value" => "$103,430",
                "description" => "Mês atual",
                "color" => "bg-gradient-warning shadow-warning",
                "icon" => "ni ni-money-coins"
            ]
        ]; 
    @endphp
    <div class="row">
        @foreach ($infos as $info)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <admin-card-info 
                    :name='@json($info["name"])'
                    :value='@json($info["value"])'
                    :description='@json($info["description"])'
                    :color='@json($info["color"])'
                    :icon='@json($info["icon"])'
                ></admin-card-info>
            </div>
        @endforeach
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Comentários</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2024
                    </p>
                </div>
                <div class="card-body p-3">
                    <admin-chart-line
                        :labels='{!! json_encode(["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]) !!}'
                        :datasets='{!! json_encode(["50", "40", "300", "220", "500", "250", "400", "230", "500"]) !!}'
                    ></admin-chart-line>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">
                        Like 
                        <span class="badge rounded-circle" style="background-color: rgba(51, 255, 87, 0.2); width: 12px; height: 12px; display: inline-block;"></span> 
                        Deslike
                        <span class="badge rounded-circle" style="background-color: rgba(255, 87, 51, 0.2); width: 12px; height: 12px; display: inline-block;"></span>
                    </h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2024
                    </p>
                </div>
                <div class="card-body p-3">
                    <admin-chart-line-grandient
                        :labels='{!! json_encode(["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]) !!}'
                        :datasets='{!! json_encode([
                            [
                                "label" => "Like",
                                "data" => [50, 40, 300, 220, 500, 250, 400, 230, 500, 600, 700, 800],
                                "borderColor" => "#FF5733",
                                "backgroundColor" => "rgba(51, 255, 87, 0.2)",
                                "tension" => 0.4
                            ],
                            [
                                "label" => "Deslike",
                                "data" => [40, 40, 150, 200, 300, 100, 30, 20, 50, 60, 70, 80],
                                "borderColor" => "#33FF57",
                                "backgroundColor" => "rgba(255, 87, 51, 0.2)",
                                "tension" => 0.4
                            ]
                        ]) !!}'
                    ></admin-chart-line-grandient>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Posts</h6>
                    </div>
                </div>
                <admin-table>
                    <template v-slot:tbody>
                        <tr>
                            <td class="w-30">
                              <div class="d-flex px-2 py-1 align-items-center">
                                <div class="ms-4">
                                  <p class="text-xs font-weight-bold mb-0">Post:</p>
                                  <h6 class="text-sm mb-0">Nome do post</h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="text-center">
                                <p class="text-xs font-weight-bold mb-0">Link:</p>
                                <h6 class="text-sm mb-0">2500</h6>
                              </div>
                            </td>
                            <td>
                              <div class="text-center">
                                <p class="text-xs font-weight-bold mb-0">Deslink:</p>
                                <h6 class="text-sm mb-0">230</h6>
                              </div>
                            </td>
                            <td class="align-middle text-sm">
                              <div class="col text-center">
                                <p class="text-xs font-weight-bold mb-0">Comentários positivo:</p>
                                <h6 class="text-sm mb-0">29.9%</h6>
                              </div>
                            </td>
                            <td class="align-middle text-sm">
                              <div class="col text-center">
                                <p class="text-xs font-weight-bold mb-0">Comentários negativo:</p>
                                <h6 class="text-sm mb-0">29.9%</h6>
                              </div>
                            </td>
                        </tr>
                    </template>
                </admin-table>
            </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Categorias</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <admin-list-group-item
                        :name="'Opa'"
                        :route="'#'"
                        :number="'10'"
                    >
                    </admin-list-group-item>
                </ul>
            </div>
          </div>
        </div>
    </div>
@endsection