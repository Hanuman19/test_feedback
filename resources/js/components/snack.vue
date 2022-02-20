<template>
    <v-app>
        <div>
            <template v-if="typeSnack=='error'">
                <v-snackbar
                    :timeout="-1"
                    :value="true"
                    absolute
                    bottom
                    color="red"
                    outlined
                    center
                >
                    <div v-for="error in errors" :key="error.index">
                        {{ error }}
                    </div>
                </v-snackbar>
            </template>
            <template v-else-if="typeSnack=='success'">
                <v-snackbar
                    :timeout="-1"
                    :value="true"
                    absolute
                    bottom
                    color="success"
                    outlined
                    center
                >
                    {{text}}
                </v-snackbar>
            </template>
        </div>
    </v-app>
</template>

<script>
export default {
    name: "snake",
    props: ["text", "typeSnack", "errors"],
    data() {
        return {

        }
    },
}
</script>

<style scoped>

</style>
