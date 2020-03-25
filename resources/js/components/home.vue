<template>
    <div>
        <navigation></navigation>
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="grid grid-cols-12 gap-4">

                    <!--                    <check-setup v-if="loading"></check-setup>-->

                    <error-auth v-if="errors.code === 401"></error-auth>
                    <error-env v-if="errors.code === 400"></error-env>

                    <zoneslist :key="refreshZonelist" :zones="zones" :loading="loading" class="col-span-3"></zoneslist>
                    <detailed :selectedZone="selectedZone" class="col-span-9"></detailed>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import navigation from '../components/navigation';
    import zoneslist from '../components/zoneslist';
    import detailed from '../components/detailed';
    import CheckSetup from '../components/checkSetup';
    import ErrorAuth from '../components/errorAuth';
    import ErrorEnv from '../components/errorEnv';

    export default {
        name: "wrapper",
        data: function () {
            return {
                'zones': null,
                'selectedZone': null,
                'errors': {},
                'loading': true,
                'unit': null,
                refreshZonelist: 0,
            };
        },
        components: {
            CheckSetup,
            ErrorAuth,
            ErrorEnv,
            navigation,
            zoneslist,
            detailed,
        },
        methods: {
            setupCheck: function () {
                this.loading = true;
                axios
                    .get('/api/tado/setup_check')
                    .then(response => {
                        // this.loading = false;

                        let statusCode = response.status;
                        if (statusCode === 200) {
                            this.errors = {};
                            this.unit = response.data.unit;
                            this.getZones();
                        } else {
                            this.errors = response.data;
                        }
                    });
            },
            getZones: function () {
                axios
                    .get('/api/tado/zones')
                    .then(response => {

                        let statusCode = response.status;
                        if (statusCode === 200) {
                            this.zones = response.data;
                            this.getZoneDetails();
                        }
                    });
            },
            getZoneDetails: function () {
                let _this = this;
                let i = 0;
                $.each(_this.zones, function (key, value) {
                    axios
                        .get('/api/tado/zones/' + value.id)
                        .then(response => {

                            let statusCode = response.status;
                            if (statusCode === 200) {
                                _this.zones[key]['details'] = response.data;
                                // this.zones[key]['details'] = response.data;
                                // console.log(response.data);
                                // this.zones = response.data;
                                i++;

                                if (i === _this.zones.length) {
                                    _this.forceRerender();
                                }
                            }
                        });
                });
            },
            forceRerender() {
                this.refreshZonelist += 1;
            }
        },
        created() {
            this.setupCheck();
        }
    }
</script>

<style scoped>
</style>
