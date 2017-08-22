<template>
  <div class="statistics-mobile">
    <mu-sub-header>手机霸屏第三方统计</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <div class="statistics-form">
        <mu-text-field fullWidth hintText="手机统计代码:(使用51la统计，并隐藏图标)" multiLine :rows="3" :rowsMax="8"/><br/>
        <p>因代码经过特殊加密，第三方统计数据仅供参考。</p>
        <mu-raised-button label="提交" class="demo-raised-button" primary fullWidth/>
      </div>
    </mu-content-block>
  </div>
</template>

<script>
  export default {
    name: 'statistics_mobile'
  }
</script>

<style lang="scss">
  .statistics-mobile{
    .statistics-form{
      margin-top:5vh;
      width: 30vw;
      p{
        margin: 0 0 1vh 0;
      }
    }
  }
</style>
