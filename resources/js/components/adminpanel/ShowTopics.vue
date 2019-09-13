<template>
    <div class="show-topics">
        <div class="center">
            <div v-if="!edit" class="todo-cmp">
                <header class="todo-cmp__header">
                    <h2>Topics</h2>
                </header>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                    <tr class="text-center">
                        <th>Topic</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="topic in topics">
                        <td class="align-middle">{{topic.title}}</td>
                        <td class="text-center align-middle">
                            <button @click="editTopic(topic)" class="btn btn-primary">Edit</button>
                        </td>
                        <td class="text-center align-middle">
                            <button @click="deleteTopic(topic.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <EditTopic v-if="edit" :title="topic.title"
                       @submit-title-update="submitTitleUpdate($event)"
                       @cancel-title-update="cancelTitleUpdate"/>
        </div>
    </div>
</template>

<script>
    import EditTopic from '../topic/EditTopic'
    export default {
        name: "ShowTopics",
        data() {
            return {
                edit: false,
                topic: {
                    title: '',
                    id: ''
                }
            }
        },
        computed: {
            topics() {
                return this.$store.getters.topics;
            }
        },
        methods: {
            editTopic(topic) {
                this.edit = true;
                this.topic.title = topic.title;
                this.topic.id = topic.id;
            },
            submitTitleUpdate(UpdatedTitle) {
                if (UpdatedTitle) {

                    this.topic.title = UpdatedTitle;

                    axios.put('/api/topic/edit', this.$data.topic)
                        .then((response) => {
                            this.$store.dispatch('getTopics');
                            this.edit = false;
                        });
                } else {
                    this.edit = false;
                }
            },
            deleteTopic(id) {
                axios.delete('/api/topic/delete/' + id, {
                })
                    .then((response) => {
                        this.$store.dispatch('getTopics');
                    });
            },
            cancelTitleUpdate() {
                this.edit = false
            }
        },
        components: {
            EditTopic
        }
    }
</script>

<style scoped lang="scss">


</style>