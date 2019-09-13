<template>
    <div class="main">

        <div class="container container-links">
            <router-link class="inline_block btn btn-secondary" to="/topic/new">
                New Topic
            </router-link>
            <router-link class="inline_block btn btn-secondary" to="/question/new">
                New Question
            </router-link>
        </div>
        <div class="container mt-5">
            <div class="show-links">
                <p @click="showMain" class="d-inline-block mr-3">Main</p>
                <p @click="showTopic" class="d-inline-block mr-3">Topics</p>
                <p @click="showQuestion" class="d-inline-block mr-3">Questions</p>
                <p @click="showAnswer" class="d-inline-block mr-3">Answers</p>
                <p @click="showResult" class="d-inline-block mr-3">Results</p>
            </div>
        </div>
        <div class="container container-show">
            <ShowTopics v-show="showAllTopics"/>
            <ShowQuestions v-show="showAllQuestions"/>
            <ShowAnswers v-show="showAllAnswers"/>
            <ShowResults v-show="showAllResults"/>
        </div>
    </div>
</template>

<script>
    import ShowTopics from './adminpanel/ShowTopics'
    import ShowQuestions from './adminpanel/ShowQuestions'
    import ShowAnswers from './adminpanel/ShowAnswers'
    import ShowResults from './adminpanel/ShowResults'

    export default {
        name: "AdminPanel",
        data() {
            return {
                showAllTopics: false,
                showAllQuestions: false,
                showAllAnswers: false,
                showAllResults: false,
            }
        },
        mounted() {
            this.$store.dispatch('getTopics');
            this.$store.dispatch('getQuestions');
            this.$store.dispatch('getAnswers');
            this.$store.dispatch('getResults');
        },
        components: {
            ShowTopics,
            ShowQuestions,
            ShowAnswers,
            ShowResults
        },
        methods: {
            showTopic() {
                this.showAllTopics = true;
                this.showAllQuestions = false;
                this.showAllAnswers = false;
                this.showAllResults = false;

            },
            showQuestion() {
                this.showAllQuestions = true;
                this.showAllTopics = false;
                this.showAllAnswers = false;
                this.showAllResults = false;

            },
            showAnswer() {
                this.showAllAnswers = true;
                this.showAllQuestions = false;
                this.showAllTopics = false;
                this.showAllResults = false;
            },
            showResult() {
                this.showAllResults = true;
                this.showAllAnswers = false;
                this.showAllQuestions = false;
                this.showAllTopics = false;
            },
            showMain() {
                this.showAllAnswers = false;
                this.showAllQuestions = false;
                this.showAllTopics = false;
                this.showAllAnswers = false;

            }
        }
    }
</script>

<style scoped lang="scss">
    .show-links {
        text-align: center;
        border-bottom: 1px solid darkorange;
        p {
            font-size: 20px;
            transition: 0.2s;

            &:hover {
                cursor: pointer;
                color: darkorange;
            }
        }
    }
</style>