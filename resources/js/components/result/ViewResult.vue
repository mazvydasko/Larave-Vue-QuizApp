<template>
    <div class="view_result">
        <table class="table table-bordered table-striped">
            <tr>
                <th>User</th>
                <td>{{currentUser.name}} ({{currentUser.email}})</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{result.created_at}}</td>
            </tr>
            <tr>
                <th>Score</th>
                <td>{{result.correct_answers}}/{{result.questions_count}}</td>
            </tr>
        </table>
        <table class="table table-bordered table-striped">
            <div v-for="(question, index) in topic.questions">
                <tr class="test-option-false">
                    <th style="width: 10%">Question #{{index+1}}</th>
                    <th>{{question.question_text}}</th>
                </tr>
                <tr>
                    <td>Options</td>
                    <td>
                        <ul>
                            <li style="list-style: none">
                                <p v-for="option in question.options" :key="option.id">
                                    {{option.option}}
                                    <em v-if="option.correct" style="font-weight: bold">(correct answer)</em>
                                    <span v-for="check in checkArray">
                                                <em v-if="option.id == check.option_id" style="font-weight: bold">(your answer)</em>
                                            </span>
                                </p>
                            </li>
                        </ul>
                    </td>
                </tr>
            </div>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ViewResult",
        props: ['result', 'topic', 'checkArray'],
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>

<style scoped>

</style>