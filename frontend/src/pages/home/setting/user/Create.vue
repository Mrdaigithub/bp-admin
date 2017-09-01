<template>
  <div class="create-user">
    <mu-sub-header>创建用户</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-row>
        <mu-col width="100" tablet="40" desktop="40">
          <mu-text-field label="用户名"
                         type="text"
                         labelFloat
                         v-model="username"
                         name="用户名"
                         v-validate="'required|min:4|max:10'"
                         :errorText="errors.first('用户名')"
                         fullWidth/>
          <mu-text-field label="密码"
                         type="password"
                         labelFloat
                         v-model="password"
                         name="密码"
                         v-validate="'required|min:4|max:16'"
                         :errorText="errors.first('密码')"
                         fullWidth/>
          <mu-text-field label="确认密码"
                         type="password"
                         labelFloat
                         v-model="checkPassword"
                         name="确认密码"
                         v-validate="'required|confirmed:密码'"
                         :errorText="errors.first('确认密码')"
                         @keyup.native.enter="createUser"
                         fullWidth/>
          <p class="expired-tip">用户使用期限: {{expiredUnit}}个月</p>
          <mu-slider v-model="expiredUnit" :min="1" :max="12" :step="1"/>
          <mu-raised-button label="创建新用户"
                            class="create-user-button"
                            primary
                            @click="createUser"
                            icon="person_add"
                            fullWidth/>
        </mu-col>
      </mu-row>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'
  import qs from 'qs'

  const monthTimestamp = 30 * 24 * 3600 * 1000
  export default {
    name: 'createUser',
    data () {
      return {
        username: '',
        password: '',
        checkPassword: '',
        expiredUnit: 1
      }
    },
    computed: {
      expiredDate () {
        return new Date(new Date().getTime() + this.expiredUnit * monthTimestamp)
      }
    },
    methods: {
      createUser () {
        this.$validator.validateAll().then(res => {
          if (res) {
            axios.post(`/user`, qs.stringify({
              username: this.username,
              password: this.password,
              expired_date: this.expiredDate
            }))
              .then(res => {
                this.$toast(`成功创建新用户: ${res.username}`, {
                  horizontalPosition: 'center',
                  duration: 1500
                })
                let users = this.$store.state.users
                users.push(res)
                this.$store.commit('getUsers', users)
              })
          }
          return res
        })
      }
    }
  }
</script>

<style lang="scss">
  .create-user {
    .expired-tip {
      font-size: 16px;
    }
    .create-user-button {
      margin-top: 20px;
    }
  }
</style>
