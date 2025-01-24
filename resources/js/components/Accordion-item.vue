<template>
    <div class="accordion-item">
        <h2 class="accordion-header" :id="'flush-heading'+idItem">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#flush-collapse'+idItem" aria-expanded="false" :aria-controls="'flush-collapse'+idItem">
            <h3>{{ name }}</h3>
        </button>
        </h2>
        <div :id="'flush-collapse'+idItem" class="accordion-collapse collapse" :aria-labelledby="'flush-heading'+idItem" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background: #EDEBE4;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background: #EDEBE4;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background: #EDEBE4;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background: #EDEBE4;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            name: {
                type: String,
                required: true,
            }, 
            idItem: {
                type: Number,
                required: true,
            },
        },
    }
</script>
