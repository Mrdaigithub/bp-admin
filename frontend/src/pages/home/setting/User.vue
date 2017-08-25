<template>
  <div class="setting-user">
    <mu-sub-header>个人设置</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <div class="setting-form">
        <mu-text-field label="原始密码"
                       type="password"
                       labelFloat
                       v-model="password"
                       name="原始密码"
                       v-validate="'required'"
                       :errorText="errors.first('原始密码')"
                       fullWidth/>
        <br/>
        <mu-text-field label="新密码"
                       type="password"
                       labelFloat
                       v-model="newPassword"
                       name="新密码"
                       v-validate="'required'"
                       :errorText="errors.first('新密码')"
                       fullWidth/>
        <br/>
        <mu-text-field label="确认密码"
                       type="password"
                       labelFloat
                       v-model="checkPassword"
                       name="确认密码"
                       v-validate="'required|confirmed:新密码'"
                       :errorText="errors.first('确认密码')"
                       fullWidth/>
        <br/>
        <mu-raised-button label="保存"
                          class="setting-button"
                          primary
                          @click="updatePassword"
                          fullWidth/>
      </div>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'
  import qs from 'qs'

  export default {
    name: 'setting_user',
    data () {
      return {
        password: '',
        newPassword: '',
        checkPassword: ''
      }
    },
    methods: {
      updatePassword () {
        this.$validator.validateAll().then(res => {
          if (res) {
            axios.put(`/user/update/password/${this.$store.state.oneself.id}`, qs.stringify({
              password: this.password,
              new_password: this.newPassword
            }))
              .then(res => {
                this.$toast('密码修改成功', {
                  horizontalPosition: 'center',
                  duration: 500
                })
              })
          }
          return res
        })
      }
    }
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
