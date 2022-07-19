import Vue from "vue";
import VueRouter from "vue-router";
import Login from "../views/Login.vue";
import Welcome from "../views/Welcome.vue";
Vue.use(VueRouter);

<template>
  <div>
    <h1>Ingresar</h1>
    <form @submit.prevent="login">
        <label>Email:  </label>
        <input v-model="email" placeholder="correo" />
        <br />
        <br />
        <label>Contraseña:  </label>
        <input v-model="password" placeholder="contraseña" type="password" />
        <br />
        <br />
        <button type="submit">Ingresar</button>
    </form>
  </div>
</template>
<script>

export default {
  data: () => {
    return {
      email: "",
      password: "",
    };
},
methods: {
    login() {
        fetch("http://127.0.0.1:8000/api/auth/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                email: this.email,
                password: this.password,
                }),
            });
        },
    },
};
</script>

const routes = [
  {
    path: "/",
    name: "Welcom",
    component: Welcome,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
];
const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});
export default router;
