<template>
    <div class="container page-avoid">
        <div class="row pb-3">
            <div class="col-6 col-sm-4">
                <div class="card rounded-0 text-center small d-flex flex-column justify-content-center align-items-center" style="height: 180px;">
                    <div class="card-body">
                        <h1 class="card-title text-primary"><b>{{ likes }}</b></h1>
                        <h6 class="card-subtitle my-2 text-muted">Likes</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4">
                <div class="card rounded-0 text-center small d-flex flex-column justify-content-center align-items-center" style="height: 180px;">
                    <div class="card-body">
                        <h1 class="card-title text-primary"><b>{{ dislikes }}</b></h1>
                        <h6 class="card-subtitle my-2 text-muted">Deslikes</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 mt-2 mt-sm-0">
                <div class="card rounded-0 text-center small d-flex flex-column justify-content-center align-items-center" style="height: 180px;">
                    <div class="card-body">
                        <h1 class="card-title text-primary"><b>{{ comments }}</b></h1>
                        <h6 class="card-subtitle my-2 text-muted">Comentários</h6>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
    export default {
        props: {
            likes: {
                type: Number,
                required: true
            },
            dislikes: {
                type: Number,
                required: true
            },
            comments: {
                type: Number,
                required: true
            }
        },
        data(){
            return {
                //
            }
        }
    }
</script>
