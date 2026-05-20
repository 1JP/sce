<template>
    <div>
        <div class="container px-0">
            <div class="row mx-auto py-2 d-lg-none">
                <div class="col-md-12">
                    <h3 class="">{{ search }} <span style="font-weight: normal;" class="text-muted">({{ total }})</span></h3>
                </div>
            </div>
            <div class="row mx-auto align-items-center">
                <div class="col-6 d-lg-none">
                    <div class="form-group mb-0">
                        <component-select
                            :options='filter_by'
                            :name-id="'filter_by'"
                            :value-select="filter"
                            @onChanged="selectedFilter($event)"
                        />
                    </div>
                </div>
                <!-- Botão Filtros -->
                <div class="col-6 d-lg-none">
                    <button type="button" class="btn btn-primary rounded d-flex align-items-center justify-content-center w-100" 
                    style="height: 40px;margin-bottom: 38px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#filtros">
                        <i class="bi bi-sliders" style="margin-right: 5px;"></i> Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            search: {
                type: String,
                default: ''
            },
        },
        data(){
            return {
                views: [30, 60, 90, 120],
                filter_by: [
                    {id: 2, name: '(A-Z)'},
                    {id: 3, name: '(Z-A)'},
                ],
                filter: 2,
                display: 30,
                order: 'asc',
            }
        },
        methods: {
            //
        },
        mounted() {
            //
        }
    }
</script>