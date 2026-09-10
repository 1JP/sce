<template>
    <div class="container page-avoid">
        <div class="row page-avoid">
            <div class="col-md-12">
                <h4 class="text-primary py-4 text-center">{{ title }} ({{ comments.length }})</h4>
                <div v-for="comment in comments" :key="comment.id" class="row border-bottom align-items-center">
                    <div class="py-4 col-sm-12 col-md-9">
                        <h6>Comentário #{{ comment.id }}</h6>
                        <p>{{ comment.description }}</p>
                    </div>
                    <div class="py-2 px-1 col-4 col-md-1 text-center">
                        <h6>Like</h6>
                        <h3 class="text-primary">{{ comment.links_count }}</h3>
                    </div>
                    <div class="py-2 px-1 col-4 col-md-1 text-center">
                        <h6>Deslike</h6>
                        <h3 class="text-primary">{{ comment.deslinks_count }}</h3>
                    </div>
                    <div class="py-2 px-1 col-4 col-md-1 text-center">
                        <h6>Comentários</h6>
                        <h3 class="text-primary">{{ comment.comments_count }}</h3>
                    </div>
                </div>
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
            comments: {
                type: Array,
                required: true
            }
        }
    }
</script>
