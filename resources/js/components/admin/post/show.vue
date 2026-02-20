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
                <div class="col-lg-4">
                    <h6>Visualizar Post</h6>
                </div>
                <div class="col-lg-8 d-flex justify-content-end">
                    <a :href="route('admin.posts.index')" class="btn bg-gradient-primary">
                        Voltar
                    </a>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <div class="card-body border rounded">
                <div class="row">
                    <div class="col-12 my-1 col-lg-6" style="">
                        <h5 class="text-dark">Nome do Post:</h5>
                        <p><span>{{ post.name }}</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Post ativado?</h5>
                        <p><span>Sim</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Comentarios positivos</h5>
                        <p><span>60%</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-1 col-lg-12" style="">
                        <h5 class="text-dark">Detalhes</h5>
                        <p><span>{{ post.description }}</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Categoria</h5>
                        <p>{{ category.name }}</p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Classificação Indicativa</h5>
                        <p><span>{{ indicative_rating.name }}</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Like</h5>
                        <p><span>0</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Deslike</h5>
                        <p><span>0</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 my-1 col-lg-6" style="">
                        <h5 class="text-dark">Fotos</h5>
                        <div class="row">
                            <div class="col-lg-3 col-6 p-3" v-for="image in images">
                                <img class="img-fluid d-block" :src="asset('storage/'+image.name)"> 
                            </div>
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
                token: '',
            }
        },
        methods: {
            asset(path) {
                return window.location.origin + '/' + path.replace(/^\/+/, '')
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>