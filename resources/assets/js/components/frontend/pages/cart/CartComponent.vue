<template>
  <div>
      <h1>Carrinho</h1>
      <div class="row">
          <div class="col-12 row item-cart" v-for="product in cart.products" :key="product.id">
              <div class="col-3">
                <div v-if="product.image">
                    <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
                </div>
                <div v-else>
                    <img src="/imgs/no-image.jpg" :alt="product.name" class="img-list">
                </div>
              </div>
              <div class="col-7">
                {{ product.name }}
              </div>
              <div class="col-2">
                <button class="btn btn-danger" @click.prevent="removeCart(product)">
                    Remover <icon name="shopping-cart"></icon>
                </button>
              </div>
              <hr>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    computed: {
        cart () {
            return this.$store.state.cart
        }
    },

    methods: {
      removeCart (product) {
          this.$store.commit('REMOVE_PRODUCT_CART', product)
      }
    }
}
</script>

<style scoped>
.img-list{max-width: 100px;}
</style>
