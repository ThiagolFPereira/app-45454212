<template>
    <div class="container">
        <h1>Login</h1>
        
        <div class="row justify-content-center">
            <div class="col-8">
                <form class="form" @submit.prevent="login">
                    <div class="form-group">
                        <input type="email" v-model="formData.email" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" v-model="formData.password" class="form-control" placeholder="Senha">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Acessar <icon name="unlock-alt"></icon>
                        </button>
                        <router-link :to="{name: 'register'}">Não tem cadastro? Registre-se!</router-link>
                    </div>
                </form>
            </div><!--col-8-->
        </div><!--row-->
    </div>
</template>


<script>
export default {
    data () {
        return {
            formData: {
                email: '',
                password: '',
            }
        }
    },

    methods: {
        login() {
            this.$store.dispatch('login', this.formData)
                            .then(() => this.$router.push({name: 'admin.dashboard'}))
                            .catch(() => {
                                this.$snotify.error('Dados inválidos', 'Falha ao acessar')
                            })
        }
    }
}
</script>

