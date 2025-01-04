<template>
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ name }}</p>
                    <h5 class="font-weight-bolder">
                        {{ value }}
                    </h5>
                    <p class="mb-0">
                        <span class="text-success text-sm font-weight-bolder">{{ description }}</span>
                    </p>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div :class="color" class="icon icon-shape text-center rounded-circle">
                        <i :class="icon" class=" text-lg opacity-10"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: String,
                required: true,
            }, 
            icon: {
                type: String,
                required: true,
            },
            name: {
                type: String,
                required: true,
            },
            description:{
                type: String,
                required: true,
            },
            color: {
                type: String,
                required: true,
            }
        },
    }
</script>
