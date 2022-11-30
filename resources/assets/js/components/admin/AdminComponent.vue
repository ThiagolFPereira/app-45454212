<template>
  <div>
      <ul class="nav menu-dashboard">
        <li class="nav-item">
          <router-link :to="{name: 'admin.dashboard'}" class="nav-link">Dashboard</router-link>
        </li>
        <li>
          <router-link :to="{name: 'admin.categories'}" class="nav-link">Categorias ({{totalCategories}})</router-link>
        </li>
        <li>
          <router-link :to="{name: 'admin.products'}" class="nav-link">Produtos</router-link>
        </li>
        <li>
          <router-link :to="{name: 'products.reports'}" class="nav-link">Relatórios</router-link>
        </li>
        <li>
          <a href="#" class="nav-link">
            {{ me.name }} (<a href="#" @click.prevent="logout">sair</a>)
          </a>
        </li>
      </ul>

      <div class="container">
        <router-view></router-view>
      </div>
  </div>
</template>

<script>
export default {
  computed: {
    totalCategories () {
      return this.$store.state.categories.items.data.length
    },
    me () {
      return this.$store.state.auth.me
    }
  },

  methods: {
    logout () {
      this.$store.dispatch('logout')

      this.$router.push({name: 'login'})
    }
  }
}
</script>

<style>

</style>

