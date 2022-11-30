<template>
  <div>
      <form class="form" @submit.prevent="onSubmit">
          <div :class="['form-group', {'has-error': errors.name}]">
              <div v-if="errors.name">{{ errors.name[0] }}</div>
              <input type="text" v-model="category.name" class="form-control" placeholder="Nome da Categoria">
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
      </form>
  </div>
</template>


<script>
export default {
    props: {
        category: {
            require: false,
            type: Object|Array,
            default: () => {
                return {
                    id: '',
                    name: '',
                }
            }
        },
        updating: {
            require: false,
            type: Boolean,
            default: false,
        }
    },
    data () {
        return {
            errors: {}
        }
    },
    methods: {
        onSubmit () {
            const action = this.updating ? 'updateCategory' : 'storeCategory'

            this.$store.dispatch(action, this.category)
                        .then(() => {
                            this.$snotify.success('Sucesso ao cadastrar')

                            this.$router.push({name: 'admin.categories'})
                        })
                        .catch(error => {
                            this.$snotify.error('Algo Errado', 'Erro')

                            console.log(error.response.data.errors)
                            this.errors = error.response.data.errors
                        })
        }
    }
}
</script>
