<template>
  <div class="statistics-mobile">
    <mu-sub-header>创建新用户</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <div class="statistics-form">
        <mu-text-field fullWidth hintText="用户名"/><br/>
        <mu-text-field fullWidth hintText="密码"/><br/>
        <mu-text-field fullWidth hintText="确认密码"/><br/>
        <mu-raised-button icon="person_add" label="添加" class="demo-raised-button" primary fullWidth/>
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
