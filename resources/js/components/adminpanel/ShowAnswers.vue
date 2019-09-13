<template>
    <div class="show-answers">
        <div class="center">
            <div v-if="!edit" class="todo-cmp">
                <header class="todo-cmp__header">
                    <h2>Answers</h2>
                </header>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                    <tr class="text-center">
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Correct</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="answer in answers">
                        <td class="align-middle">{{answer.question.question_text}}</td>
                        <td class="align-middle">{{answer.option}}</td>
                        <td class="align-middle">{{answer.correct ? 'Yes' : 'No' }}</td>
                        <td class="text-center align-middle">
                            <button @click="editAnswer(answer)" class="btn btn-primary">Edit</button>
                        </td>
                        <td class="text-center align-middle">
                            <button @click="deleteAnswer(answer.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <EditAnswer v-if="edit"
                          :answer_option="answer.answer_option"
                          :question_id="answer.question_id"
                          :correct="answer.correct"
                          @submit-answer-update="submitAnswerUpdate($event)"
                          @cancel-answer-update="cancelAnswerUpdate"/>
        </div>
    </div>
</template>

<script>
    import EditAnswer from '../answer/EditAnswer'
    export default {
        name: "ShowAnswers",
        data() {
            return {
                edit: false,
                answer: {
                    id: '',
                    answer_option: '',
                    question_id: '',
                    correct: ''
                }
            }
        },
        computed: {
            answers() {
                return this.$store.getters.answers;
            }
        },
        methods: {
            editAnswer(answer) {
                this.edit = true;
                this.answer.answer_option = answer.option;
                this.answer.question_id = answer.question.id;
                this.answer.correct = answer.correct;
                this.answer.id = answer.id;
            },
            submitAnswerUpdate(UpdatedAnswer) {
                if (
                    UpdatedAnswer.answer_text != this.answer.answer_option ||
                    UpdatedAnswer.question_id != this.answer.question_id ||
                    UpdatedAnswer.correct != this.answer.correct)
                {
                    this.answer.answer_option = UpdatedAnswer.answer_text;
                    this.answer.question_id = UpdatedAnswer.question_id;
                    this.answer.correct = UpdatedAnswer.correct;

                    axios.put('/api/answer/edit', {
                        answer_option: this.answer.answer_option,
                        question_id: this.answer.question_id,
                        correct: this.answer.correct,
                        id: this.answer.id
                    })
                        .then((response) => {
                            this.$store.dispatch('getAnswers');
                            this.edit = false;
                        });
                } else {
                    this.edit = false;
                }
            },
            deleteAnswer(id) {
                axios.delete('/api/answer/delete/' + id, {
                })
                    .then((response) => {
                        this.$store.dispatch('getAnswers');
                    });
            },
            cancelAnswerUpdate() {
                this.edit = false
            }
        },
        components: {
            EditAnswer
        }
    }
</script>

<style scoped>

</style>