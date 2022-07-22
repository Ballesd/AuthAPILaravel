<template>
  <div>
    <h3>Registrarse</h3>
    <form @submit.prevent="createPost">
        <div>
          <label for="nameUser">Nombre: </label>
          <input type="text" id = "nameUser" v-model="formData.name">
        </div>
        <br>
        <div>
          <label for="MailUser">Correo: </label>
          <input placeholder="Correo(*)" id = "MailUser" v-model="formData.email" type="email">
        </div>
        <br>
        <div>
          <label for="ConsUser">Contraseña: </label>
          <input placeholder="Contraseña(*)" id = "ConsUser" v-model="formData.password" type="password">
        </div>
        <br>
        <div>
          <label for="ConfiUser">Confirmar Contraseña: </label>
          <input placeholder="Contraseña(*)" id = "ConfiUser" v-model="formData.password_confirmation"  type="password">
        </div>
        <br>
        <button>Registrarse</button>
    </form>
  </div>
</template>

<script>

import axios from 'axios'; 

export default {
  name: 'CreatePost',
  data() {
    return {
      formData: {
        name: '',
        email:'',
        password: '',
        password_confirmation: '',
      },
    }
  },
  methods: {
    createPost() {
      
      this.axios.post('http://127.0.0.1:8000/api/auth/register', this.formData)
        .then((response) => console.log(response))
        .catch((error) => console.log(error))
    }
  },    
}
</script> 