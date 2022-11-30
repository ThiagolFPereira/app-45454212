<template>
  <div>
      <h1>Listagem de Produtos</h1>

      <div class="row actions">
        <div class="col">
          <button class="btn btn-success" @click.prevent="create">
            Novo
          </button>

          <vodal
            :show="showModal"
            animation="zoom"
            @hide="hideModal"
            :width="600"
            :height="500">
            <product-form
              :product="product"
              :update="update"
              @success="success">
            </product-form>
          </vodal>
        </div>
        <div class="col">
          <search @search="searchForm">
          </search>
        </div>
      </div>

      <table class="table table-dark">
        <thead>
          <tr>
            <th width="150">Imagem</th>
            <th>Nome</th>
            <th width="250">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products.data" :key="product.id">
            <td>
              <div v-if="product.image">
                <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
              </div>
            </td>
            <td>{{ product.name }}</td>
            <td>
              <a href="#" @click.prevent="edit(product.id)" class="btn btn-info btn-left">
                <icon name="pencil-square"></icon>
              </a>
              <destroy :item="product" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>

      <paginate
        :pagination="products"
        :offset="6"
        @paginate="loadProducts">
      </paginate>
  </div>
</template>


<script>
import Vodal from 'vodal'

import PaginationComponent from '../../../layouts/PaginationComponent'
import SearchComponent from '../../layouts/SearchComponent'
import ProductForm from './partials/ProductForm'
import ButtonDestroyComponent from '../../layouts/ButtonDestroyComponent'

export default {
  created () {
    this.loadProducts(1)
  },
  data () {
    return {
      search: '',
      showModal: false,
      product: {
          id: '',
          name: '',
          description: '',
          category_id: '',
      },
      update: false,
    }
  },
  computed: {
    products () {
      return this.$store.state.products.items
    },
    params () {
      return {
        page: this.products.current_page,
        filter: this.search,
      }
    }
  },
  methods: {
    loadProducts (page) {
      this.$store.dispatch('loadProducts', {...this.params, page})
    },

    create () {
      this.update = false

      this.showModal = true

      this.reset()
    },

    edit (id) {
      this.reset()

      this.$store.dispatch('loadProduct', id)
                    .then(response => {
                      this.product = response

                      this.showModal = true

                      this.update = true
                    })
                    .catch(() => {
                      this.$snotify.error('Erro ao carregar o produto')
                    })
    },

    searchForm (filter) {
      this.search = filter

      this.loadProducts(1)
    },

    hideModal () {
      this.showModal = false
    },

    success () {
      this.hideModal()

      this.loadProducts(1)
    },

    reset () {
      this.product = {
          id: '',
          name: '',
          description: '',
          category_id: '',
      }
    },

    destroy (id) {
      this.$store.dispatch('destroyProduct', id)
                    .then(() => {
                      this.$snotify.success('Deletado com sucesso!')

                      this.loadProducts(1)
                    })
                    .catch(() => this.$snotify.error('Erro ao deletar'))
    }
  },
  components: {
    paginate: PaginationComponent,
    search: SearchComponent,
    Vodal,
    ProductForm,
    destroy: ButtonDestroyComponent
  }
}
</script>

<style scoped>
.btn-left{float: left; margin: 0 4px;}
</style>
