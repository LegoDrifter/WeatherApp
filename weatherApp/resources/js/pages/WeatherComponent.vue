<script setup>
import {defineProps} from 'vue';

const props = defineProps({
    name: String,
    temp: Float32Array,
    humidity: Float32Array,
    description: String,
})

</script>

<template>
    <div class="flex flex-col gap-1 bg-gradient-to-r from-teal-300 to-teal-100 px-2 py-2 text-white w-52 h-52 rounded-md">
        <p class="text-3xl font-bold">{{name}}</p>
        <p class="text-xl font-bold">Temp: {{temp}}°F</p>
        <p class="text-xl font-bold">Humidity: {{humidity}}</p>
        <p class="text-xl font-bold">Desc: {{description}}</p>
    </div>
</template>

<style scoped>

</style>
