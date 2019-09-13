<template>
    <div class="main">
        <div class="container">
            <div class="form-group">
                <div class="form-group">
                    <input type="text" v-model="title" class="form-control" placeholder="Topic name...">
                </div>
                <div class="errors" v-if="errors">
                    <ul>
                        <li class="align-middle">
                            <strong>{{ errors }}</strong>
                        </li>
                    </ul>
                </div>
                <input @click="createTopic()" type="submit" class="btn btn-info" value="Create Topic"/>
                <router-link class="inline_block btn btn-secondary" to="/adminpanel">
                    Go Back
                </router-link>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "NewTopic",
        data() {
            return {
                title: '',
                errors: ''
            }
        },
        methods: {
            createTopic() {
                if (this.title) {
                    axios.post('/api/topic/new', {
                        title: this.title
                    })
                        .then((response) => {
                            this.$store.dispatch('getTopics');
                            this.title = '';
                        });
                } else {
                    this.errors = 'Title is required'
                }
            },
        }

    }
</script>

<style scoped>
    .container {
        margin-top: 100px;
    }
</style>