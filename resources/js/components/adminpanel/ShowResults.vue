<template>
    <div class="show-questions">
        <div class="center">
            <div class="todo-cmp">
                <header class="todo-cmp__header">
                    <h2>Results</h2>
                </header>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                    <tr class="text-center">
                        <th>User</th>
                        <th>Date</th>
                        <th>Result</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="result in results">
                        <td class="align-middle">{{result.user.name}} ({{result.user.email}})</td>
                        <td class="align-middle">{{result.created_at}}</td>
                        <td class="align-middle">{{result.correct_answers}}/{{result.questions_count}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowResults",
        computed: {
            results() {
                return this.$store.getters.results;
            }
        },
    }
</script>

<style scoped>

</style>