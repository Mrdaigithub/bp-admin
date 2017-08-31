<template>
  <div class="update-password">
    <mu-sub-header>修改密码</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-row>
        <mu-col width="100" tablet="40" desktop="40">
          <mu-text-field label="原始密码"
                         type="text"
                         labelFloat
                         v-model="password"
                         name="原始密码"
                         v-validate="'required'"
                         :errorText="errors.first('原始密码')"
                         fullWidth/>
          <mu-text-field label="新密码"
                         type="password"
                         labelFloat
                         v-model="newPassword"
                         name="新密码"
                         v-validate="'required|min:4|max:16'"
                         :errorText="errors.first('新密码')"
                         fullWidth/>
          <mu-text-field label="确认密码"
                         type="password"
                         labelFloat
                         v-model="checkPassword"
                         name="确认密码"
                         v-validate="'required|confirmed:新密码'"
                         :errorText="errors.first('确认密码')"
                         @keyup.native.enter="updatePassword"
                         fullWidth/>
          <mu-raised-button label="确认修改"
                            class="update-password-button"
                            primary
                            @click="updatePassword"
                            icon="edit"
                            fullWidth/>
        </mu-col>
      </mu-row>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'
  import qs from 'qs'

  export default {
    name: 'updateUserPassword',
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
            axios.patch(`/user/password/${this.$store.state.oneself.id}`, qs.stringify({
              password: this.password,
              new_password: this.newPassword
            }))
              .then(res => {
                this.$toast('修改密码成功, 请重新登录', {
                  horizontalPosition: 'center',
                  duration: 2000
                })
                setTimeout(() => {
                  this.$router.replace('/login')
                }, 2000)
              })
          }
          return res
        })
      }
    }
  }
</script>

<style lang="scss">
  .update-password {
    .update-password-button {
      margin-top: 20px;
    }
  }
</style>
