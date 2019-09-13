<template>
    <div class="show-questions">
        <div class="center">
            <div v-if="!edit" class="todo-cmp">
                <header class="todo-cmp__header">
                    <h2>Questions</h2>
                </header>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                    <tr class="text-center">
                        <th>Topic</th>
                        <th>Question text</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="question in questions">
                        <td class="align-middle">{{question.topic.title}}</td>
                        <td class="align-middle">{{question.question_text}}</td>
                        <td class="text-center align-middle">
                            <button @click="editQuestion(question)" class="btn btn-primary">Edit</button>
                        </td>
                        <td class="text-center align-middle">
                            <button @click="deleteQuestion(question.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <EditQuestion v-if="edit"
                            :question="question.question_text"
                            :topic_id="question.topic_id"
                            @submit-question-update="submitQuestionUpdate($event)"
                            @cancel-question-update="cancelQuestionUpdate"/>
        </div>
    </div>
</template>

<script>
    import EditQuestion from '../question/EditQuestion'
    export default {
        name: "ShowQuestions",
        data() {
            return {
                edit: false,
                question: {
                    id: '',
                    question_text: '',
                    topic_id: ''
                }
            }
        },
        computed: {
            questions() {
                return this.$store.getters.questions;
            }
        },
        methods: {
            editQuestion(question) {
                this.edit = true;
                this.question.question_text = question.question_text;
                this.question.topic_id = question.topic.id;
                this.question.id = question.id
            },
            submitQuestionUpdate(UpdatedQuestion) {
                if (
                    UpdatedQuestion.question_text != this.question.question_text ||
                    UpdatedQuestion.topic_id != this.question.topic_id)
                {

                    this.question.question_text = UpdatedQuestion.question_text;
                    this.question.topic_id = UpdatedQuestion.topic_id;

                    axios.put('/api/question/edit', {
                        question: this.question.question_text,
                        topic_id: this.question.topic_id,
                        id: this.question.id
                    })
                        .then((response) => {
                            this.$store.dispatch('getQuestions');
                            this.edit = false;
                        });
                } else {
                    this.edit = false;
                }
            },
            cancelQuestionUpdate() {
                this.edit = false
            },
            deleteQuestion(id) {
                axios.delete('/api/question/delete/' + id, {
                })
                    .then((response) => {
                        this.$store.dispatch('getQuestions');
                        this.$store.dispatch('getAnswers');
                    });
            },
        },
        components: {
            EditQuestion
        }
    }
</script>

<style scoped>

</style>