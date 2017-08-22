<template>
  <div class="setting-user">
    <mu-sub-header>个人设置</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <div class="setting-form">
        <mu-text-field label="原始密码" type="password" labelFloat fullWidth/>
        <br/>
        <mu-text-field label="新密码" type="password" labelFloat fullWidth/>
        <br/>
        <mu-text-field label="确认密码" type="password" labelFloat fullWidth/>
        <br/>
        <mu-raised-button label="保存" class="setting-button" primary fullWidth/>
      </div>
    </mu-content-block>
  </div>
</template>

<script>
  export default {
    name: 'setting_user'
  }
</script>

<style lang="scss">
  .setting-user {
    .setting-form {
      width: 25vw;
      .setting-button {
        margin-top: 20px;
      }
    }
  }
</style>
