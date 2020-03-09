<template>
    <div>
        <navigation></navigation>
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="grid grid-cols-12 gap-4">
                    <roomlist class="col-span-3"></roomlist>
                    <detailed class="col-span-9"></detailed>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import navigation from '../components/navigation';
    import roomlist from '../components/roomlist';
    import detailed from '../components/detailed';

    export default {
        name: "home.vue",
        data: function () {
            return {
                'rooms': null,
                'errors': null,
            };
        },
        components: {
            navigation,
            roomlist,
            detailed,
        },
        methods: {
            setupCheck: function () {
                axios
                    .get('/api/setup_check')
                    .then(response => {
                        console.log(response);
                    });
            }
        },
        created() {
            this.setupCheck();
        }
    }
</script>

<style scoped>

</style>
