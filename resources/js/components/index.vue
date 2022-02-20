<template>
    <v-app>
        <div class="parent">
            <div class="block">
                <v-btn
                    class="ma-2"
                    outlined
                    color="indigo"
                    @click="$router.push('form')"
                >
                    Создать обращение
                </v-btn>
            </div>
        </div>
    </v-app>
</template>
<script>
export default {
    name: 'app',
    data() {
        return {

        };
    },
     mounted() {

    },
    methods:{

    }
}
</script>
<style scoped>

.parent {
    width: 100%;
    top: 0;
    left: 0;
    overflow: auto;
}
.block {
    position: absolute;
    top: 20%;
    left: 50%;
    margin: -125px 0 0 -125px;
}
</style>
