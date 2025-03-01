<template>

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
                    <h6>Planos</h6>
                </div>
                <div class="col-lg-2 col-lg-3">
                    <div class="form-group">
                        <admin-filter-select
                            :name="'Status'"
                            :options="['Ativo', 'Desativado']"
                            :value-select="selectedStatus"
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
                    <button type="button" class="btn bg-gradient-primary me-2" @click="clear()" v-if="Object.keys(listSearch).length > 0">
                        Limpar filtros
                    </button>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createPlanModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <admin-table>
                <template v-slot:thead>
                    <admin-thead
                        v-for="tha, index in ths"
                        :key="index"
                        :class="tha.class"
                    >
                        {{ tha.name }}
                    </admin-thead>
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
                                Todas estas questões, devidamente ponderadas, levantam dúvidas sobre se a crescente influência da mídia aponta para a melhoria do impacto na agilidade decisória.
                                
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
        </template>
    </component-card>

</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            ths: {
                type: Array,
                default: () => []
            },
        },
        data(){
            return {
                indications: [],
                indicative: {},
                name: '',
                description: '',
                classDescription: '',
                token: '',
                classItem: '',
                classInput: '',
                routeUpdate: '',
                routeDelete: '',
                classInputCheck: 'form-check-input',
                selectedStatus: '',
                listSearch: {},
            }
        },
    }
</script>