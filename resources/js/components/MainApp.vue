<template>
    <div id="main">
        <Header/>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Header from './Header'

    export default {
        name: 'main-app',
        components: {
            Header
        }
    }
</script>

<style lang="scss">
    .main {
        margin-top: 100px;
    }

    .error {
        border: 1px solid red;
        padding: 10px;
        margin-bottom: 10px;
        max-width: 300px;
    }
    .todo-cmp {
        background: #ffffff;
        color: #497081;
        padding: 10px 30px;
        border-radius: 5px;
        margin: 0 auto;
        margin-bottom: 50px;

        &__header {
            text-align: center;
            padding: 10px 0;
            margin-bottom: 5px;

            h2 {
                font-weight: 600;
                font-size: 50px;
                margin: 4px auto;
                padding: 0;
            }

            p {
                padding: 0 0 5px;
                margin: 4px auto;
                font-size: 0.8rem;
            }

        }
    }
</style>
