<template>
    <div class="mt-3" v-if="errors.length">
        <ul class="list-disc pl-5">
            <li class="text-sm text-red-600" v-for="error in errors">{{ error }}</li>
        </ul>
    </div>
    <form  v-on:submit.prevent="checkForm()" class="flex-row space-y-4 mt-3">
        <input v-model="user.name" class="rounded shadow-md px-3 py-2 block w-full bg-red-100" placeholder="Nombre(*)" type="text">
        <input v-model="user.city" class="rounded shadow-md px-3 py-2 block w-full bg-red-100" placeholder="Ciudad(*)" type="text">
        <input v-model="user.phone" class="rounded shadow-md px-3 py-2 block w-full bg-red-100" placeholder="Celular(*)" type="tel">
        <input v-model="user.email" class="rounded shadow-md px-3 py-2 block w-full bg-red-100" placeholder="Email(*)" type="email">
        <p class="text-xs text-gray-700 font-thin text-center">Al hacer clic en el botón Asesorarme usted autoriza que uno de nuestros colaboradores le contacte para brindar más información sobre nuestros servicios de seguridad.</p>
        <button class="text-center bg-orange-600 px-3 py-2 rounded shadow text-white uppercase block w-full font- hover:bg-orange-700" type="submit">ASESORARME</button>
    </form>
</template>

<script>
    import Button from '@/components/Button.vue'
    export default {
        components: {
            Button
        },
        data() {
            return {
                user: {
                    name: '',
                    city: '',
                    phone: '',
                    email: '',
                    description: 'c_celarmea'
                },
                errors: []
            }
        },
        methods: {
            checkForm(e) {
                this.errors = [];
                if (!this.user.name) {
                    this.errors.push('El nombre es obligatorio');
                }
                if (!this.user.city) {
                    this.errors.push('La ciudad es obligatorio');
                }
                if (!this.user.phone) {
                    this.errors.push('El celular es obligatorio');
                }else {
                    if (this.user.phone.toString().length != 10) {
                        this.errors.push('El celular debe tener 10 dígitos');
                    }
                    if (this.user.phone.toString()[0] != '3') {
                        this.errors.push('El celular debe empezar con 3');
                    }
                }
                if (!this.user.email) {
                    this.errors.push('El email es obligatorio');
                }
                if (this.errors.length) {
                    e.preventDefault();
                }else {
                    this.register();
                }
            },
            register() {
                console.log(this.user)
                this.axios.post('https://monitoreo.celar.com.co/api/?insertar=1', this.user)
                // this.axios.post('http://localhost/softgreen/celar/api/?insertar=1', this.user)
                .then(response => {
                    let data = response.data;
                    // console.log(data);
                });
                setTimeout(() => {
                    window.location.href='/gracias';
                }, 700);
                gtag_report_conversion();
            }
        }
    }
</script>