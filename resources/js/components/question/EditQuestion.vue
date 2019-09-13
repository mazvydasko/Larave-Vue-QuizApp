<template>
    <div class="edit-question mt-5">
        <div class="form-group">
            <select v-model="UpdatedQuestion.topic_id" class="form-control mb-2">
                <option :selected="UpdatedQuestion.topic_id == topic.id" v-for="topic in topics" :value="topic.id">{{topic.title}}</option>
            </select>
            <input @input="updateValue($event.target.value)" type="text" class="form-control" :value="question">
        </div>
        <input @click="$emit('submit-question-update', UpdatedQuestion)" type="submit" class="btn btn-info" value="Edit Question">
        <input @click="$emit('cancel-question-update')" type="submit" class="btn btn-secondary" value="Back">
    </div>
</template>

<script>
    export default {
        name: "EditQuestion",
        props: ['question', 'topic_id'],
        data() {
            return {
                UpdatedQuestion: {
                    question_text: this.question,
                    topic_id: this.topic_id

                }

            }
        },
        computed: {
            topics() {
                return this.$store.getters.topics;
            },
        },
        methods: {
            updateValue: function (value) {
                this.UpdatedQuestion.question_text = value;
            }
        }
    }
</script>

<style scoped>

</style>