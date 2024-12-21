<template>
    <div class="table-responsive">
        <table class="table align-items-center">
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
