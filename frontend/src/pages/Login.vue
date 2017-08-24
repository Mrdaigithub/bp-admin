<template>
  <div class="login text-center">
    <mu-paper class="login-form-wrap" :zDepth="2">
      <h2 class="login-form-warp-header">霸屏软件后台登录</h2>
      <div class="login-form">
        <mu-text-field label="帐号"
                       name="帐号"
                       labelFloat
                       fullWidth
                       v-model="username"
                       type="text"
                       v-validate="'required'"
                       :errorText="errors.first('帐号')"/>
        <br/>
        <mu-text-field label="密码"
                       type="password"
                       name="密码"
                       v-model="password"
                       labelFloat
                       v-validate="'required'"
                       :errorText="errors.first('密码')"
                       fullWidth/>
        <mu-raised-button label="登录"
                          class="login-button"
                          @click="handleLogin"
                          primary
                          fullWidth
                          :disabled="loginBtnDisabled"/>
      </div>
    </mu-paper>
  </div>
</template>

<script>
  //  import axios from 'axios'
  //  import qs from 'qs'

  export default {
    name: 'login',
    data () {
      return {
        username: '',
        password: ''
      }
    },
    computed: {
      loginBtnDisabled () {
        return this.errors.any()
      }
    },
    methods: {
      handleLogin () {
        this.$store.commit('openLoading')
      }
    },
    mounted () {
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
