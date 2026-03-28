<template>
    <component-card
        :card-header="true"
        :class-header="'pb-0 px-3'"
        :card-body="true"
        :class-body="'pt-4 p-3'"
    >
        <template v-slot:header>
            <h6 class="mb-0">Assinatura</h6>
        </template>
        <template v-slot:body>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Faturas</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-outline-primary btn-sm mb-0">Ver tudo</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <list-group>
                                <list-group-item 
                                    :class-item="'border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'"
                                    v-for="(invoice, index) in invoices" :key="index" 
                                >
                                    <admin-subscription-info
                                        :value="invoice.value"
                                        :id="invoice.internalId"
                                        :date="invoice.created_at"
                                        :status="invoice.status"
                                    ></admin-subscription-info>
                                </list-group-item>
                            </list-group>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <component-card
                                        :card-header="true"
                                        :class-header="'mx-4 p-3 text-center'"
                                        :card-body="true"
                                        :class-body="'pt-0 p-3 text-center'"
                                    >
                                        <template v-slot:header>
                                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="fa fa-book opacity-10"></i>
                                            </div>
                                        </template>
                                        <template v-slot:body>
                                            <h6 class="text-center mb-0">{{ plan.name }}</h6>
                                            <span class="text-xs">{{ plan.description }}</span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0 text-success" v-if="plan.active">Ativo</h5>
                                            <h5 class="mb-0 text-danger" v-else>Desativado</h5>
                                        </template>
                                    </component-card>
                                </div>
                                
                                <div class="col-md-4 mt-md-0 mt-4">
                                    <component-card
                                        :card-header="true"
                                        :class-header="'mx-4 p-3 text-center'"
                                        :card-body="true"
                                        :class-body="'pt-0 p-3 text-center'"
                                    >
                                        <template v-slot:header>
                                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="ni ni-credit-card opacity-10"></i>
                                            </div>
                                        </template>
                                        <template v-slot:body>
                                            <h6 class="text-center mb-0">Assinatura</h6>
                                            <span class="text-xs"></span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">R$ {{ plan.value }}</h5>
                                        </template>
                                    </component-card>
                                </div>
                                <div class="col-md-4">
                                    <component-card
                                        :card-header="true"
                                        :class-header="'mx-4 p-3 text-center'"
                                    >
                                        <template v-slot:header>
                                            <button  v-if="subscription.status == 'ACTIVE'" type="button" class="btn bg-gradient-danger btn-block mb-3" data-bs-toggle="modal" data-bs-target="#destorySubscription">
                                                Excluir Assinatura
                                            </button>
                                            <hr class="horizontal dark my-3">
                                            <a :href="route('admin.assinaturas.edit', subscription.id)" class="btn bg-gradient-info btn-block mb-3">
                                                Editar Assinatura
                                            </a>
                                        </template>
                                    </component-card>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </component-card>

    <model :title="'Excluir Assinatura'" :name="'destorySubscription'">
        <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Deseja excluir essa assinatura?</h4>
            <p>Todos os posts relacionados a essa assinatura será excluidos também</p>
        </div>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn bg-gradient-danger">Excluir</button>
        </template>
    </model>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            subscription: {
                type: Object
            },
        },
        data(){
            return {
                token: '',
                plan: {},
                invoices: []
            }
        },
        methods: {
            getPlan(){
                axios.get(route('api.admin.plans.show', this.subscription.plan_id))
                    .then((response) => {
                        this.plan = response.data.data
                    })
            },
            getInvoices(){
                axios.get(route('api.admin.subscription.invoices', this.subscription.customer_id))
                    .then((response) => {
                        this.invoices = response.data.data.map((inv, i) => ({
                            ...inv,
                            internalId: `${i}-${Math.random().toString(36).substr(2, 5)}`
                        }));
                    })
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
            this.getPlan();
            this.getInvoices();
        }
    }
</script>