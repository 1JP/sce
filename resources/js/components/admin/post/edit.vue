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
                    <h6>Editar Posts</h6>
                </div>
                <div class="col-lg-8 d-flex justify-content-end">
                    <a :href="route('admin.posts.index')" class="btn bg-gradient-primary">
                        Voltar
                    </a>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <form method="POST" :action="route('admin.posts.store')" ref="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="token"/>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Nome'"
                                :name-id="'name'"
                                :class-input="classInput"
                                :value="post.name"
                                @input="valueInput($event)"
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <component-text-area
                            :is-required="true"
                            :placeholder="'Descrição'"
                            :name-id="'description'"
                            :value="post.description"
                            :class-input="classDescription"
                            @input="valueDescription($event)"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                        <h5 class="">
                            <i class="fa fa-fw mr-2 fa-picture-o text-secondary"></i>Imagens
                        </h5>
                    </div>
                </div>
                <div class="row p-4 mt-4 mx-auto rounded text-muted" style="	border-style: dashed;	border-color: #f2f2f2;">
                    <div class="col-lg-12">
                        <file-upload
                            :name="'images[]'"
                            :files="post.images"
                        ></file-upload>
                    </div>
                </div>
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
                                        :options='indications'
                                        :value-select="post.indicative_rating_id"
                                        :class-item="classIndicative"
                                        @update:valueSelect="selectedIndicative($event)"
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
                                        :options='categories'
                                        :value-select="post.category_id"
                                        :class-item="classCategory"
                                        @update:valueSelect="selectedCategory($event)"
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
        :name="'Editar'"
        @click="save()"
    ></fixed-bottom>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            post: {
                type: Object
            },
            category: {
                type: Object
            },
            indicative_rating: {
                type: Object
            },
            images: {
                type: Object
            },
        },
        data(){
            return {
                indications: [],
                categories: [],
                classInput: '',
                classDescription: '',
                classIndicative: '',
                classCategory: '',
                name: '',
                description: '',
                indicative_rating_id: '',
                category_id: '',
                token: '',
            }
        },
        methods: {
            listIndications(){
                axios.get(route('api.admin.indicative-rating.index'))
                    .then((response) => {
                        this.indications = response.data.data;
                    })
            },
            listCategories(){
                axios.get(route('api.admin.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            },
            selectedCategory(event){
                this.category_id = event;
            },
            selectedIndicative(event){
                this.indicative_rating_id = event;
            },
            valueInput(event){
                this.name = event.target.value;
            },
            valueDescription(event){
                this.description = event.target.value;
            },
            save(){
                if(this.name == '' || this.description == '' 
                    || this.indicative_rating_id == '' || this.category_id == ''
                ){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classDescription = this.description == '' ? 'is-invalid' : 'is-valid'
                    this.classIndicative = this.indicative_rating_id == '' ? 'is-invalid' : 'is-valid'
                    this.classCategory = this.category_id == '' ? 'is-invalid' : 'is-valid'

                    return;
                }

                this.classInput = 'is-valid'
                this.classDescription = 'is-valid'
                this.classIndicative = 'is-valid'
                this.classCategory = 'is-valid'
                this.$refs.form.submit();
            },
        },
        mounted() {
            this.listIndications();
            this.listCategories();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>