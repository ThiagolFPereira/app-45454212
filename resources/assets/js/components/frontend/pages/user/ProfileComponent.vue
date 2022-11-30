<template>
    <div class="container">
        <h1>Editar Perfil</h1>
        
        <div class="row justify-content-center">
            <div class="col-8">
                <form class="form" @submit.prevent="updateProfile">
                    <user-form :user="formData" :errors="errors"></user-form>
                </form>
            </div><!--col-8-->
        </div><!--row-->
    </div>
</template>


<script>
import UserForm from './UserForm'

export default {
    computed: {
        formData () {
            return this.$store.state.auth.me
        }
    },

    data () {
        return {
            errors: {}
        }
    },

    methods: {
        updateProfile () {
            this.$store.dispatch('update', this.formData)
                            .then(() => {
                                this.$router.push({name: 'admin.dashboard'})

                                this.$snotify.success('Atualizado com sucesso!')
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
