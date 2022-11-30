<template>
  <div>
      <header-site></header-site>

      <div class="container container-site">
          <div class="row">
              <router-view></router-view>
          </div>
      </div>

      <footer-site></footer-site>
  </div>
</template>

<script>
import SiteFooterComponent from './SiteFooterComponent'
import SiteHeaderComponent from './SiteHeaderComponent'

export default {
    components: {
        footerSite: SiteFooterComponent,
        headerSite: SiteHeaderComponent,
    }
}
</script>

