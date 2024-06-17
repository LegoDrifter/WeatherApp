<script setup>
import axios from "axios";
import {onMounted} from "vue";
import {ref} from 'vue';
import WeatherComponent from "./WeatherComponent.vue";
const cities = ref(null);
const getWeather = async () => {
    try{
        const response = await axios.get('/api/weather');
        console.log(response);
        cities.value = response.data;
    } catch(error){
        console.error('Error');
    }
}

onMounted(getWeather);

</script>

<template>
    <div>
        <h1 class="bg-gradient-to-r from-teal-300 to-teal-100 py-2 px-2 text-center text-2xl text-white">WeatherApp MCA</h1>
        <h1 class="text-center text-blue-600 text-xl">List of cities you have requested</h1>
    </div>
    <ul class="flex gap-5 ml-5">
        <WeatherComponent v-for="city in cities"
        :key="city.weather_id"
        :name="city.name"
        :temp="city.temp"
        :humidity="city.humidity"
        :description="city.description"></WeatherComponent>
<!--        <li v-for="city in cities">{{city}}</li>-->
    </ul>
</template>
<style scoped>

</style>
