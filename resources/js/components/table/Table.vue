<template>
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <slot name="thead"/>
            </thead>
            <tbody>
                <slot name="tbody"/>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {}
</script>
