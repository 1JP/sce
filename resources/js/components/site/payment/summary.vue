<template>
    <component-card
        :class-card="'mb-2'"
        :card-body="true"
        style="background: rgb(237, 235, 228);"
    >
        <template v-slot:body>
            <div class="form-row">
                <div class="form-group col-lg-12" style="">
                  <label class="text-body-tertiary">{{ paymentData?.name ?? 'Plano' }}</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12" style="">
                    <p>{{ paymentData?.description ?? 'Descrição do plano' }}</p>
                </div>
            </div>
            <div class="row mx-auto d-flex align-items-start justify-content-between">
                <div class="px-0 col-9 col-lg-10" style="">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <label class="text-body-tertiary">Filme</label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: {{ paymentData?.number_film ?? 0 }}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="px-0 col-9 col-lg-10" style="">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <label class="text-body-tertiary">Livro</label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: {{ paymentData?.number_book ?? 0 }}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="px-0 col-9 col-lg-10" style="">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <label class="text-body-tertiary">Serie</label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: {{ paymentData?.number_serie ?? 0 }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-auto">
                <div class="text-dark bg-grey col-12 ml-auto col-lg-12">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between px-0 pt-2 pb-0">
                            <h4 class="card-title text-body-tertiary my-0">Total</h4>
                            <h3 class="card-title my-0">R$ {{ paymentData?.value ?? '0,00' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </component-card>
</template>

<script setup>
    import { storeToRefs } from 'pinia'
    import { usePaymentStore } from '../../../stores/paymentStore'

    const paymentStore = usePaymentStore()
    const { paymentData } = storeToRefs(paymentStore)
</script>