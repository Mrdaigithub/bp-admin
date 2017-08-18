<template>
  <div id="app">
    <div class="route-loading-wrap" v-show="$store.state.loading">
      <mu-circular-progress class="route-loading" :size="60" :strokeWidth="5"/>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    name: 'app'
  }
</script>

<style lang="scss">
  html, body {
    font-family: Source Sans Pro, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif;
  }

  .route-loading-wrap {
    width: 100vw;
    height: 100vh;
    background-color: rgba(255, 255, 255, .95);
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    .route-loading {
      position: fixed;
      left: 48%;
      top: 40%;
      z-index: 999;
    }
  }

  .text-center {
    text-align: center !important;
  }

  .text-left {
    text-align: left !important;
  }

  .text-right {
    text-align: right !important;
  }

  .pull-left {
    float: left !important;
  }

  .pull-right {
    float: right !important;
  }

  .clearfix {
    clear: both !important;
    overflow: hidden !important;
  }
</style>
