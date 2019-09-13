<template>

    <div class="login justify-content-center">
        <div class="main">
            <div class="grid align__item">
                <div class="register">
                    <h2>Sign Up</h2>
                    <form @submit.prevent="register" class="form">
                        <div class="form__field">
                            <input v-model="form.name" type="text" placeholder="Enter name...">
                        </div>
                        <div class="form__field">
                            <input v-model="form.email" type="email" placeholder="Enter email...">
                        </div>
                        <div class="form__field">
                            <input v-model="form.password" type="password" placeholder="Enter password...">
                        </div>

                        <div class="form__field">
                            <input type="submit" value="Sign Up">
                        </div>
                    </form>
                    <p>Already have an accout? <router-link to="/login">Sign In</router-link></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "Register",
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            register() {
                axios.post('/api/user', {
                    name: this.form.name,
                    email: this.form.email,
                    password: this.form.password
                })
                    .then((response) => {
                        this.$router.push({path: '/login'});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .error {
        text-align: center;
        color: red;
    }

    $base-bgcolor: #354152;
    $base-color: #7e8ba3;
    $base-font-weight: 300;
    $base-font-size: 1rem;
    $base-line-height: 1.5;
    $base-font-family: Helvetica Neue;
    $base-font-family-fallback: sans-serif;

    * {
        box-sizing: border-box;
    }

    html {
        height: 100%;
    }

    body {
        background-color: $base-bgcolor;
        color: $base-color;
        font: $base-font-weight #{$base-font-size}/#{$base-line-height} $base-font-family, $base-font-family-fallback;
        margin: 0;
        min-height: 100%;
    }

    .align {
        align-items: center;
        display: flex;
        flex-direction: row;

        &__item {

            &--start {
                align-self: flex-start;
            }

            &--end {
                align-self: flex-end;
            }

        }

    }

    $input-placeholder-color: #7e8ba3;

    input {
        border: 0;
        font: inherit;
        max-width: 250px;

        &::placeholder {
            color: $input-placeholder-color;
        }

    }

    .form {

        &__field {
            margin-bottom: 1rem;
        }

        input {
            outline: 0;
            padding: .5rem 1rem;

            &[type="email"],
            &[type="text"],
            &[type="password"] {
                width: 100%;
            }

        }

    }

    h2 {
        font-size: 2.75rem;
        font-weight: 100;
        margin: 0 0 1rem;
        text-transform: uppercase;
    }

    $link-color: #7e8ba3;

    a {
        color: $link-color
    }

    .register {
        text-align: center;
        padding: 4rem 2rem;

        input {
            border: 1px solid #242c37;
            border-radius: 999px;
            background-color: transparent;
            text-align: center;

            &[type="email"],
            &[type="password"],
            &[type="text"] {
                background-repeat: no-repeat;
                background-size: 1.5rem;
                background-position: 1rem 50%;
            }

            &[type="email"] {
                background-image: url("https://image.flaticon.com/icons/svg/12/12194.svg");
            }

            &[type="text"] {
                background-image: url("https://image.flaticon.com/icons/svg/74/74472.svg");
            }

            &[type="password"] {
                background-image: url("https://image.flaticon.com/icons/svg/483/483408.svg");
            }

            &[type="submit"] {
                background-image: linear-gradient(160deg, #8ceabb 0%, #378f7b 100%);
                color: #fff;
                width: 100%;
            }

        }

    }


</style>