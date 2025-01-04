@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Planos" ]
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
                            <h6>Planos</h6>
                        </div>
                        <div class="col-lg-2 col-lg-3">
                            <div class="form-group">
                                <admin-filter-select
                                    :name="'Status'"
                                    :options="[]"
                                ></admin-filter-select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-lg-3">
                            <admin-filter-input
                                :name="'Plano...'"
                                :type="'text'"
                                :icon="'fa fa-search'"
                            ></admin-filter-input>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end">
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createAndEditPlanoModal">
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
                                    <h6 class="mb-0 text-sm">
                                        {{ \Illuminate\Support\Str::limit('Todas estas questões, devidamente ponderadas, levantam dúvidas sobre se a crescente influência da mídia aponta para a melhoria do impacto na agilidade decisória.', 100) }}
                                        
                                    </h6>
                                </component-td>
                                <component-td :class="'align-middle text-sm'">
                                    <component-span-status :class="'bg-gradient-success'">
                                        Ativo
                                    </component-span-status>
                                </component-td>
                                <component-td :class="'align-middle text-center'">
                                    <h6 class="mb-0 text-sm">7</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center'">
                                    <h6 class="mb-0 text-sm">7</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center'">
                                    <h6 class="mb-0 text-sm">7</h6>
                                </component-td>
                                <component-td :class="'align-middle text-center'">
                                    <h6 class="mb-0 text-sm">7</h6>
                                </component-td>
                                <component-td>
                                    <component-dropdown :name="'teste'">
                                        <component-dropdown-item name="Visualizar" target="#viewPlanoModal"></component-dropdown-item>
                                        <component-dropdown-item name="Editar" route="#"></component-dropdown-item>
                                        <component-dropdown-item name="Excluir" target="#destoryPlan"></component-dropdown-item>
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

<model :title="'Cadastrar Plano'" :name="'createAndEditPlanoModal'">
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
                <textarea class="form-control is-valid" placeholder="Descrição"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group has-success">
                <input type="number" placeholder="Filme" class="form-control is-invalid" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-success">
                <input type="number" placeholder="Serie" class="form-control is-invalid" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-success">
                <input type="number" placeholder="Livro" class="form-control is-invalid" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-success">
                <input type="text" placeholder="Valor" class="form-control is-invalid" />
            </div>
        </div>
        <div class="col-md-6">
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

<model :title="'Visualizar Plano'" :name="'viewPlanoModal'">
    <div class="row">
        <div class="col-lg-12 col-lg-3">
            <div class="form-group"> 
                <h5>Descrição:</h5> 
                <p class="text-center">A nível organizacional, o consenso sobre a necessidade de qualificação oferece uma interessante oportunidade para verificação das diversas correntes de pensamento.</p> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Filmes:</h5> 
                <p>7</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Series:</h5> 
                <p>7</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Livros:</h5> 
                <p>7</p> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Ativo:</h5> 
                <p>Sim</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Assinatura:</h5> 
                <p>7</p> 
            </div>
        </div>
        <div class="col-lg-4 col-lg-3">
            <div class="form-group"> 
                <h5>Valor:</h5> 
                <p>R$ 70,00</p> 
            </div>
        </div>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
    </template>
</model>

<model :title="'Excluir Plano'" :name="'destoryPlan'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir essa Plano?</h4>
        <p>Todas assinaturas relacionados a essa Plano continuaram a ser cobrados no entanto o plano será excluido!!!</p>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>
@endsection