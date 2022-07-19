<template>
    <a class="text-center bg-orange-600 px-3 py-2 rounded shadow text-white uppercase block w-full font-semibold hover:bg-orange-700">{{ title }}</a>
</template>

<script setup>
    const props = defineProps ({
        title: {
            type: String,
            default: 'Inscribirme'
        }
    })
</script>


<style lang="scss" scoped>
</style>