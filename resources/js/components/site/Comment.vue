<template>
    <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
        <div class="row">
            <div class="col-lg-6">
                <p class="text-body-tertiary fs-9 mb-1">Piere Auguste Renoir</p>
                <p class="text-body-tertiary fs-9 mb-1">23 Oct, 12:09 PM</p>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <div class="hover-actions-trigger top-0 btn-cell">
                    <div class="btn-group">
                        <component-dropdown :name="'dropdown-comment'" 
                            :class-button="'btn btn-outline-primary btn-sm p-0 rounded-circle'"
                            :icon="'bi bi-three-dots'"
                            >
                            <component-dropdown-item name="Editar" route="#"></component-dropdown-item>
                            <component-dropdown-item name="Editar" route="#"></component-dropdown-item>
                        </component-dropdown>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-body-highlight mb-1">
            Since the spring-loaded event, I've been wanting an iMac, and it's exceeded my expectations. The screen is clear, the colors are vibrant (I got the blue one!), and the performance is more than adequate for my needs as a college student. That's how good it is.
        </p>
        <div class="hover-actions-trigger top-0">
            <a class="me-2">
                <i class="bi bi-hand-thumbs-up"></i>
                400
            </a>
            <a class="me-1">
                <i class="bi bi-hand-thumbs-down"></i>
                52 mil
            </a>
            <a class="me-2">
                <i class="bi bi-chat-square-text-fill"></i>
                400
            </a>
        </div>
        <site-create-comment v-if="false"></site-create-comment>
    </div>
    <site-children-comment></site-children-comment>
</template>

<script>
    export default {}
</script>
