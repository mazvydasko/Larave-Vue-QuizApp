<template>
    <div class="edit-question mt-5">
        <div class="form-group">
            <select v-model="UpdatedAnswer.question_id" class="form-control mb-2">
                <option :selected="UpdatedAnswer.question_id == question.id" v-for="question in questions" :value="question.id">{{question.question_text}}</option>
            </select>
            <input @input="updateValue($event.target.value)" type="text" class="form-control mb-2" :value="answer_option">
            <input v-model="UpdatedAnswer.correct" :checked="UpdatedAnswer.correct == 1" type="checkbox" class="form-control">
        </div>
        <input @click="$emit('submit-answer-update', UpdatedAnswer)" type="submit" class="btn btn-info" value="Edit Answer">
        <input @click="$emit('cancel-answer-update')" type="submit" class="btn btn-secondary" value="Back">
    </div>
</template>

<script>
    export default {
        name: "EditAnswer",
        props: ['answer_option', 'question_id', 'correct'],
        data() {
            return {
                UpdatedAnswer: {
                    answer_text: this.answer_option,
                    question_id: this.question_id,
                    correct: this.correct
                }
            }
        },
        computed: {
            questions() {
                return this.$store.getters.questions;
            },
        },
        methods: {
            updateValue: function (value) {
                this.UpdatedAnswer.answer_text = value;
            },
        }
    }
</script>

<style scoped>

</style>