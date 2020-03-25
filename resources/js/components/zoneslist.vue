<template>
    <div>
        <div v-if="!zones" class="border border-gray-300 rounded" v-bind:class="{ hidden: !zones }">
            TEST
        </div>
        <div v-if="zones" class="rounded bg-white shadow">
            <ul>
                <li v-for="zone in zones" :key="zone.id" class="p-4 border-b last:border-b-0">
                    <div class="block flex items-center">
                        <div>
                            <div>


                                {{ zone.name }}

                            </div>

                            <div class="h-6 text-sm">
                                <div class="block flex items-center" v-if="zone.details">
                                    <span class="text-tado-blue">{{zone.details.sensorDataPoints.humidity.percentage.toFixed(0)}}%</span>
                                    <svg aria-hidden="true" data-prefix="fad" data-icon="tint" class="h-4 w-4 m-2 text-tado-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                        <g class="fa-group">
                                            <path class="fa-secondary" fill="currentColor" d="M205.22 22.09c-7.94-28.78-49.44-30.12-58.44 0C100 179.85 0 222.72 0 333.91 0 432.35 78.72 512 176 512s176-79.65 176-178.09c0-111.75-99.79-153.34-146.78-311.82zM176 448A112.14 112.14 0 0164 336a16 16 0 0132 0 80.09 80.09 0 0080 80 16 16 0 010 32z" opacity=".4"/>
                                            <path class="fa-primary" fill="currentColor" d="M176 448A112.14 112.14 0 0164 336a16 16 0 0132 0 80.09 80.09 0 0080 80 16 16 0 010 32z"/>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div v-if="zone.details" class="ml-auto text-2xl font-bold" v-bind:class="insideTemperatureClass(zone)">
                            <span>{{zone.details.sensorDataPoints.insideTemperature.celsius.toFixed(1)}}&deg;</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "zones",
        props: [
            'zones'
        ],
        methods: {
            insideTemperatureClass (zone) {
                return 'text-tado-' + zone.details.sensorDataPoints.insideTemperature.celsius.toFixed(0);
            }
        }
    }
</script>

<style scoped>

</style>
