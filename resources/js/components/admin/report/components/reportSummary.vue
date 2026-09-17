<template>
    <div class="container page-avoid">
        <div class="row">
            <div class="col-12">
                <h4 class="text-primary py-3 text-center">{{ title }}</h4>
                <p class="text-center mb-3"><strong>Post:</strong> {{ postName }}</p>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="col-6 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Classificação Indicativa</small><br>{{ indicativa }}
                </h6>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Categoria</small><br>{{ category }}
                </h6>
            </div>
            <div class="col-4 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Nota</small><br>{{ note }}
                </h6>
            </div>
            <div class="col-4 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Likes</small><br>{{ likes }}%
                </h6>
            </div>
            <div class="col-4 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Deslikes</small><br>{{ dislikes }}%
                </h6>
            </div>
            <div class="col-3 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Comentários Positivos</small><br>{{ positiveComments }}%
                </h6>
            </div>
            <div class="col-3 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Comentários Negativos</small><br>{{ negativeComments }}%
                </h6>
            </div>
            <div class="col-3 col-md-2">
                <h6 class="py-2 text-dark">
                    <small class="text-muted">Comentários Neutros</small><br>{{ neutralComments }}%
                </h6>
            </div>
        </div>

        <div class="row border-bottom">
            <div class="col-12">
                <p class="pt-3" id="finalidade"><strong>Descrição:</strong></p>
                <p>{{ description }}</p>
            </div>
        </div>
    </div> 
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                required: true
            },
            postName: {
                type: String,
                required: true
            },
            indicativa: {
                type: String,
                required: true
            },
            category: {
                type: String,
                required: true
            },
            note: {
                type: Number,
                required: true
            },
            likes: {
                type: Number,
                required: true
            },
            dislikes: {
                type: Number,
                required: true
            },
            positiveComments: {
                type: Number,
                required: true
            },
            negativeComments: {
                type: Number,
                required: true
            },
            neutralComments: {
                type: Number,
                required: true
            },
            description: {
                type: String,
                required: true
            }
        }
    }
</script>
