<template>
    <div class="container">
        <h1>Cadastre-se</h1>
        
        <div class="row justify-content-center">
            <div class="col-8">
                <form class="form" @submit.prevent="register">
                    <user-form :user="formData" :errors="errors"></user-form>
                </form>
            </div><!--col-8-->
        </div><!--row-->
    </div>
</template>


<script>
import UserForm from './UserForm'

export default {
    data () {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
            },
            errors: {}
        }
    },

    methods: {
        register () {
            this.$store.dispatch('register', this.formData)
                            .then(() => {
                                this.$router.push({name: 'admin.dashboard'})

                                this.$snotify.success('Sucesso ao cadastrar!')
                            })
                            .catch(response => {
                                this.errors = response.errors
                            })
        }
    },


    components: {
        UserForm
    }
}
</script>
