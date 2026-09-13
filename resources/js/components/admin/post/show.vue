<template>
    <component-card
        :class-card="'mb-4'"
        :card-header="true"
        :class-header="'pb-0'"
        :card-body="true"
        :class-body="'px-0 pt-0 pb-2'"
        :card-footer="true"
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
                    <div class="col-12 my-1 col-lg-6" style="">
                        <h5 class="text-dark">Post ativado?</h5>
                        <p><span>{{ post.active ? 'Sim' : 'Não' }}</span></p>
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
                        <h5 class="text-dark">Tipo de Categoria</h5>
                        <p><span>{{ category_type.name }}</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Like</h5>
                        <p><span>{{ likes_percentage }}%</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Deslike</h5>
                        <p><span>{{ dislikes_percentage }}%</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Comentários positivos</h5>
                        <p><span>{{ positive_comments_percentage }}%</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Comentários negativos</h5>
                        <p><span>{{ negative_comments_percentage }}%</span></p>
                    </div>
                    <div class="col-12 my-1 col-lg-3" style="">
                        <h5 class="text-dark">Comentários neutros</h5>
                        <p><span>{{ neutral_comments_percentage }}%</span></p>
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
        <template v-slot:footer>
            <div class="row">
                <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                    <a class="btn btn-outline-primary m-1" :href="route('admin.posts.index')">Cancelar</a>
                    <a class="btn btn-primary m-1" :href="route('admin.posts.edit', post.id)">
                        Editar
                    </a>
                </div>
            </div>
        </template>
    </component-card>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object
            },
            category: {
                type: Object
            },
            category_type: {
                type: Object
            },
            indicative_rating: {
                type: Object
            },
            images: {
                type: Object
            },
            likes_percentage: {
                type: Number
            },
            dislikes_percentage: {
                type: Number
            },
            positive_comments_percentage: {
                type: Number
            },
            negative_comments_percentage: {
                type: Number
            },
            neutral_comments_percentage: {
                type: Number
            }
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