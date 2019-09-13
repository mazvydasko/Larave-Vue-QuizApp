<template>
    <div class="main">
        <div class="container">

            <div class="table-responsive">
                <h2 class="mt-2" align="center">Add question to quiz</h2>
                <div class="form-group">
                    <label for="">Select Topic</label>
                    <select v-model="topic_id" class="form-control">
                        <option v-for="topic in topics" :value="topic.id">{{topic.title}}</option>
                    </select>
                </div>
                <table class="table table-bordered" v-for="(item, index) in answers" :key="index">
                    <tr>
                        <td v-show="!index">
                            <input type="text" v-model="question" placeholder="Enter question..."
                                   class="form-control question_list" required
                            />
                        </td>
                        <td>
                            <input type="text" v-model="item.answer" placeholder="Enter answer..."
                                   class="form-control options_list" required
                            />
                        </td>
                        <td>
                            <input type="checkbox"
                                   v-model="item.correct"
                                   value="1"
                                   class="form-control"
                            />
                        </td>
                    </tr>
                </table>
                <div class="errors" v-if="errors">
                    <ul>
                        <li class="align-middle">
                            <strong>{{ errors }}</strong>
                        </li>
                    </ul>
                </div>
                <button type="button" @click="addAnswer()" name="addAnswer" id="addAnswer"
                        class="btn btn-primary mb-2 float-right">
                    Add Answer
                </button>
                <br>
                <input type="submit" @click="addQuestion" id="addQuestion" class="btn btn-success"
                       value="Add Question"/>
                <router-link class="inline_block btn btn-secondary" to="/adminpanel">
                    Go Back
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewQuestion",
        data() {
            return {
                topic_id: '',
                question: '',
                answers: [
                    {
                        answer: '',
                        correct: 0
                    },
                ],
                errors: ''
            }
        },
        computed: {
            topics() {
                return this.$store.getters.topics;
            }
        },
        methods: {
            addAnswer() {
                this.answers.push({
                    answer: '',
                    correct: 0
                })
            },
            addQuestion() {
                if (this.question && this.topic_id) {
                    axios.post('/api/question/new', {
                        topic_id: this.topic_id,
                        question: this.question,
                        answers: this.answers
                    })
                        .then((response) => {
                            this.answers = [
                                {
                                    answer: '',
                                    correct: 0
                                }
                            ];
                            this.question = '';
                        });
                } else {
                    if (!this.question) {
                        this.errors = 'Question is required'
                    } else {
                        this.errors = 'Topic is required'
                    }
                }
            },

        }
    }
</script>

<style scoped>

</style>