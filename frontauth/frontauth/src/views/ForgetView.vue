<template>
  <div>
    <h3>Información de la cuenta</h3>
    <form @submit.prevent="createPost">
        <div>
          <label for="MailUser">Correo: </label>
          <input placeholder="Correo(*)" id = "MailUser" v-model="formData.email" type="email">
        </div>
        <br>
        <button>Enviar Mail</button>
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
        email:'',
      },
    }
  },
  methods: {
    createPost() {
        
        this.axios.post('http://127.0.0.1:8000/api/contactoreg/', this.formData)
            .then((response) => console.log(response))
            .catch((error) => console.log(error))
    }
  },    
}
</script>