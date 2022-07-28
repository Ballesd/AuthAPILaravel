<template>
  <div>
    <h1>Ingresar</h1>
    <form @submit.prevent="login">
        <div>
          <label for="MailUser">Correo: </label>
          <input placeholder="Correo(*)" id = "MailUser" v-model="email" type="email">
        </div>
        <br>
        <div>
          <label for="ConsUser">Contraseña: </label>
          <input placeholder="Contraseña(*)" id = "ConsUser" v-model="password" type="password">
        </div>
        <br>
        <button>Ingresar</button>
    </form>
  </div>
</template>
<script>

import axios from 'axios'; 

export default {
  name: 'CreatePost',
  data: () => {
    return {
      formData: {
        email:'',
        password: ''
      },
    };
  },
  methods: {
      async login() {
        await axios.post('login',{
          email: this.email,
          password: this.password

        });
        console.log(response);  
      }
      
    },
}
</script>