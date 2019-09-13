import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        topics: [],
        questions: [],
        answers: [],
        results: [],
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null
    },
    getters: {
        topics(state) {
            return state.topics;
        },
        questions(state) {
            return state.questions;
        },
        answers(state) {
            return state.answers;
        },
        results(state) {
            return state.results;
        },
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
    },
    mutations: {
        updateTopics(state, payload) {
            state.topics = payload;
        },
        updateQuestions(state, payload) {
            state.questions = payload;
        },
        updateAnswers(state, payload) {
            state.answers = payload;
        },
        updateResults(state, payload) {
            state.results = payload;
        },
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
    },
    actions: {
        getTopics(context) {
            axios.get('/api/topics')
                .then((response) => {
                    context.commit('updateTopics', response.data.topics);
                });
        },
        getQuestions(context) {
            axios.get('/api/questions')
                .then((response) => {
                    context.commit('updateQuestions', response.data.questions);
                });
        },
        getAnswers(context) {
            axios.get('/api/answers')
                .then((response) => {
                    context.commit('updateAnswers', response.data.answers);
                });
        },
        getResults(context) {
            axios.get('/api/results')
                .then((response) => {
                    context.commit('updateResults', response.data.results);
                });
        },
        login(context) {
            context.commit("login");
        },
    },

}