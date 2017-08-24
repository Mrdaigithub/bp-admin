<template>
  <div class="login text-center">
    <mu-paper class="login-form-wrap" :zDepth="2">
      <h2 class="login-form-warp-header">霸屏软件后台登录</h2>
      <div class="login-form">
        <mu-text-field label="帐号"
                       name="username"
                       labelFloat
                       fullWidth
                       v-model="usernameVal"
                       type="text"
                       v-validate="'required'"
                       :errorText="errors.first('username')"/>
        <br/>
        <mu-text-field label="密码"
                       type="password"
                       name="password"
                       v-model="passwordVal"
                       labelFloat
                       v-validate="'required'"
                       :errorText="errors.first('password')"
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
        usernameVal: '',
        username: {
          errorText: '',
          pass: true
        },
        passwordVal: '',
        password: {
          errorText: '',
          pass: true
        }
      }
    },
    computed: {
      loginBtnDisabled () {
        return this.username.pass && this.password.pass
      }
    },
    watch: {
      usernameVal: function (val, oldVal) {
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
