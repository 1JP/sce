<template>
    <component-card
        :class-card="'mb-2'"
        :card-body="true"
        style="background: rgb(237, 235, 228);"
    >
        <template v-slot:body>
            <div class="form-row">
                <div class="form-group col-lg-12" style="">
                  <label class="text-body-tertiary">Plano</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12" style="">
                    <p>No entanto, não podemos esquecer que o acompanhamento das preferências de consumo representa uma abertura para a melhoria das regras de conduta normativas.</p>
                </div>
            </div>
            <div class="row mx-auto d-flex align-items-start justify-content-between">
                <div class="px-0 col-9 col-lg-10" style="">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <label class="text-body-tertiary">Filme</label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: 1</span></h4>
                        </div>
                    </div>
                </div>
                <div class="px-0 col-9 col-lg-10" style="">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <label class="text-body-tertiary">Livro</label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: 1</span></h4>
                        </div>
                    </div>
                </div>
                <div class="px-0 col-9 col-lg-10" style="">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <label class="text-body-tertiary">Serie</label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: 1</span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-auto">
                <div class="text-dark bg-grey col-12 ml-auto col-lg-12">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between px-0 pt-2 pb-0">
                            <h4 class="card-title text-body-tertiary my-0">Total</h4>
                            <h3 class="card-title my-0">R$ 307,00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </component-card>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            
        },
        data() {
            return {}
        },
        methods: {

        },
        mounted() {
            
        }
    }
</script>