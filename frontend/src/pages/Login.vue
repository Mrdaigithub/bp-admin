<template>
  <div class="login text-center">
    <mu-paper class="login-form-wrap" :zDepth="2">
      <h2 class="login-form-warp-header">霸屏软件后台登录</h2>
      <div class="login-form">
        <mu-text-field label="帐号" labelFloat fullWidth v-model="login.data.username"/>
        <br/>
        <mu-text-field label="密码" type="password" v-model="login.data.password" labelFloat fullWidth/>
        <mu-raised-button label="登录" class="login-button" @click="handleLogin" primary fullWidth/>
      </div>
    </mu-paper>
  </div>
</template>

<script>
  export default {
    name: 'login',
    data () {
      return {
        login: {
          data: {
            username: '',
            password: ''
          }
        }
      }
    },
    methods: {
      handleLogin () {
        this.$store.commit('openLoading')
      }
    }
  }
</script>

<style lang="scss">
  .login {
    width: 100vw;
    height: 100vh;
    background: url("../assets/login_bg.jpg") no-repeat center;
  }

  .login-form-wrap {
    box-sizing: border-box;
    padding: 20px;
    display: inline-block;
    height: 45vh;
    width: 25vw;
    margin-top: 20vh;
    text-align: center;
    .login-form-wrap-header {
      font-weight: normal;
      color: #7d7d7d;
      font-size: 24px;
    }
    .login-form {
      .login-button {
        margin-top: 30px;
      }
    }
  }
</style>
