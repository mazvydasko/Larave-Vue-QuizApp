<template>
    <div class="topic-view">
        <div class="main">
            <div class="container">
                <div class="col-md-12" v-if="!showResult">
                    <router-link class="inline_block btn btn-primary" to='/'>Go
                        Back
                    </router-link>
                    <hr>
                    <h1>{{topic.title}}</h1>
                    <div>
                        <div v-for="question in topic.questions" :key="question.id">
                            <div class="question-text mt-3 mb-3">
                                {{question.question_text}}
                            </div>
                            <div v-for="option in question.options" :key="option.id">
                                <div class="round">
                                    <input @click="check($event, option, question)" :id="option.id" type="checkbox"
                                           :value="option.correct" class="checkbox-round">
                                    <label :for="option.id">{{option.option}}</label>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <a><input @click="addResult(topic)" type="submit" value="Submit" class="btn btn-success mt-3"></a>
                </div>
            <ViewResult v-if="showResult" :result="result" :topic="topic" :checkArray="checkArray"/>
            </div>
        </div>
    </div>
</template>

<script>
    import ViewResult from '../result/ViewResult';

    export default {
        name: "ViewTopic",
        created() {
            if (this.topics.length) {
                this.topic = this.topics.find((topic) => topic.id == this.$route.params.id);
            } else {
                axios.get(`/api/topics/${this.$route.params.id}`)
                    .then((response) => {
                        this.topic = response.data.topic;
                    });
            }
        },
        data() {
            return {
                topic: null,
                checkArray: [],
                showResult: false,
                result: {
                    topic_id: '',
                    correct_answers: '',
                    questions_count: '',
                    user_picks: []
                },
            };
        },
        components: {
            ViewResult
        },
        computed: {
            topics() {
                return this.$store.getters.topics;
            },
        },
        methods: {
            addResult(topic) {
                var score = 0;
                for (var j = 0; j < topic.questions.length; j++) {
                    var userCorrectAnswers = 0;
                    var correctAnswers = 0;
                    for (var i = 0; i < this.checkArray.length; i++) {
                        if (this.checkArray[i].question_id == topic.questions[j].id) {
                            if (this.checkArray[i].option) {
                                userCorrectAnswers++;
                            } else {
                                userCorrectAnswers--;
                            }
                        }
                    }
                    for (var k = 0; k < topic.questions[j]['options'].length; k++) {
                        if (topic.questions[j]['options'][k]['question_id'] == topic.questions[j]['id']) {
                            if (topic.questions[j]['options'][k]['correct'] == 1) {
                                correctAnswers++
                            }
                        }
                    }
                    if (correctAnswers == userCorrectAnswers) {
                        score++;
                    }
                }

                this.result.topic_id = topic.id;
                this.result.correct_answers = score;
                this.result.questions_count = topic.questions.length;
                this.result.user_picks = this.checkArray;

                axios.post('/api/results/new', this.$data.result)
                    .then((response) => {
                        this.result = response.data.result;
                        this.showResult = true;
                    });
            },
            check(e, option, question) {
                if (e.target.checked) {
                    this.checkArray.push({option: option.correct, question_id: question.id, option_id: option.id})
                } else {
                    this.checkArray = this.checkArray.filter(function (obj) {
                        return obj.option_id !== option.id;
                    });
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .container {
        border: 1px solid lightblue;
        padding: 30px;
        font-size: 18px;
        margin-bottom: 50px;

        .question-text {
            font-size: 22px;
            font-weight: bold;
        }

        label {
            margin-left: 5px;
        }
    }

    .checkbox-round {
        width: 1.3em;
        height: 1.3em;
        background-color: white;
        border-radius: 50%;
        vertical-align: middle;
        border: 1px solid #ddd;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
    }

    .checkbox-round:checked {
        background-color: lightblue;
    }

</style>