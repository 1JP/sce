<template>
    <component-card
        :class-card="'mb-4'"
        :card-header="true"
        :class-header="'pb-0'"
        :card-body="true"
    >
        <template v-slot:header>
            <div class="row">
                <div class="col-lg-4">
                    <h6>Criar Posts</h6>
                </div>
                <div class="col-lg-8 d-flex justify-content-end">
                    <a :href="route('admin.posts.index')" class="btn bg-gradient-primary">
                        Voltar
                    </a>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <form method="POST" action="" ref="form">
                <input type="hidden" name="_token"/>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Nome'"
                                :name-id="'name'"
                            />
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="form-group">
                            <div class="custom-control custom-toggle">
                                <input class="custom-control-input" type="checkbox" value="on" data-off-label="OFF" id="customCheckProdutoAtivado">
                                <label class="custom-control-label"></label>
                            </div>
                            <label>Post ativado?</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                        <h5 class="">
                            <i class="fa fa-fw mr-2 fa-picture-o text-secondary"></i>Imagens
                        </h5>
                    </div>
                </div>
                <file-upload
                    :name="'files[]'"
                ></file-upload>
                <p class="text-left text-muted small pt-3"><i>Tamanho recomendado: 1024px</i></p>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                                <h5><i class="fa fa-fw fa-list mr-2 text-secondary"></i>Classificação Indicativa</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group d-flex">
                                    <component-select
                                        :is-required="true"
                                        :placeholder="'Classificação Indicativas'"
                                        :name-id="'indicative_rating_id'"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                                <h5><i class="fa fa-fw fa-list mr-2 text-secondary"></i>Categorias</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group d-flex">
                                    <component-select
                                        :is-required="true"
                                        :placeholder="'Categorias'"
                                        :name-id="'category_id'"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </template>
    </component-card>
    <fixed-bottom
        :cancel="route('admin.posts.index')"
        :name="'Cadastrar'"
    ></fixed-bottom>
</template>

<script>
    import axios from 'axios';

    export default {

        data(){
            return {}
        },
        methods: {},
        mounted() {}
    }
</script>