<template>
    <div class="home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="home-content">
                        <div class="home-heading">
                            <h1><em>Quiz</em>Take it!</h1>
                        </div>
                        <div class="row" v-for="topic in topics">
                            <div class="col-md-12">
                                <div class="home-box-content">
                                    <div class="left-text">
                                        <h4><em>{{topic.title}}</em></h4>
                                        <p>Questions: {{topic.questions.length}}</p>
                                        <div class="primary-button">
                                            <router-link class="link" :to="`/topics/${topic.id}`">Go
                                                To Quiz
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Home",
        mounted() {
            this.$store.dispatch('getTopics');
        },
        computed: {
            topics() {
                return this.$store.getters.topics;
            }
        },
    }
</script>

<style lang="scss" scoped>

    .primary-button .link {
        display: inline-block;
        background-color: #fa5252;
        color: #fff;
        letter-spacing: 1px;
        font-size: 11px;
        padding: 12px 18px;
        font-weight: 300;
        text-decoration: none;
        text-transform: uppercase;
        border: 1px solid transparent;
    }

    .primary-button .link:hover {
        background-color: transparent;
        border: 1px solid #fff;
        -moz-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        -webkit-transition: all 0.2s linear;
    }


    .home-content h1 {
        padding-top: 120px;
        font-size: 32px;
        text-transform: uppercase;
        color: black;
        font-weight: 300;
    }

    .home-content h1 em {
        margin-right: 20px;
        font-size: 80px;
        font-style: normal;
        font-weight: 800;
    }

    .home-content .home-box-content {
        background-color: #455871;
        padding: 30px;
        display: inline-block;
        min-width: 345px;
    }

    .home-content .left-text {
        float: left;
        width: 100%;
    }

    .home-content .left-text h4 {
        display: inline-block;
        padding-bottom: 5px;
        font-size: 22px;
        color: #fff;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 0px;
        margin-bottom: 10px;
        border-bottom: 2px solid #fff;
    }

    .home-content .left-text h4 em {
        color: #fa5252;
        font-style: normal;
    }

    .home-content .left-text p {
        color: #fff;
        margin-bottom: 25px;
    }

    .home-content .right-image {
        float: right;
    }

    @media (min-width: 768px) {
        .col-md-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
        }
        .home-content .home-box-content {
            background-color: #455871;
            right: -100px;
            padding: 30px;
            display: inline-block;
            min-width: 650px;
        }
    }

    @media (max-width: 768px) {
        .col-md-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
        }
        .home-content .home-box-content {
            background-color: #455871;
            right: -100px;
            padding: 30px;
            display: inline-block;
            max-width: 510px;
            min-width: 300px;
        }
    }

    @media (max-width: 400px) {
        .home-content .home-box-content {
            background-color: #455871;
            padding: 30px;
            display: inline-block;
            max-width: 300px;
        }
    }

</style>