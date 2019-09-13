<template>
    <div class="navigation">
        <b-navbar toggleable="lg" type="light" variant="light" fixed="top">
            <b-navbar-brand>
                <router-link class="navbar-brand" to="/">Quiz App</router-link>
            </b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="ml-auto">
                    <b-nav-form>
                        <template v-if="!currentUser">
                            <li>
                                <router-link to="/" class="nav-link">Topics</router-link>
                            </li>
                            <li>
                                <router-link to="/login" class="nav-link">Login</router-link>
                            </li>
                        </template>
                        <template v-else>
                            <li>
                                <router-link to="/" class="nav-link">Topics</router-link>
                            </li>
                            <li v-if="currentUser.admin">
                                <router-link to="/adminpanel" class="nav-link">Admin Panel</router-link>
                            </li>
                            <li class="nav-link" @click.prevent="logout">
                                Logout
                            </li>
                        </template>
                    </b-nav-form>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
    export default {
        name: "Header",
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>

<style lang="scss" scoped>

    * {
        padding: 0;
        box-sizing: border-box;
    }

    .bg-light {
        background-color: white!important;
        border-bottom: 1px solid lightblue;
    }

    .nav-link {
        cursor: pointer;
    }


    @media only screen and (max-width: 991px) {
        .form-inline {
            display: block;
        }
    }

</style>