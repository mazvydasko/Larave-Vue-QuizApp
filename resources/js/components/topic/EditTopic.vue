<template>
    <div class="edit-topic mt-5">
        <div class="form-group">
            <input @input="updateValue($event.target.value)" type="text" class="form-control" :value="title">
        </div>
        <input @click="$emit('submit-title-update', UpdatedTitle)" type="submit" class="btn btn-info" value="Edit Topic">
        <input @click="$emit('cancel-title-update')" type="submit" class="btn btn-secondary" value="Back">
    </div>
</template>

<script>
    export default {
        name: "EditTopic",
        props: ['title'],
        data() {
            return {
                UpdatedTitle: ''

            }
        },
        methods: {
            updateValue: function (value) {
                this.UpdatedTitle = value;
            }
        }
    }
</script>

<style scoped>

</style>