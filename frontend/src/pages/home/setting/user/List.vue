<template>
  <div class="users-list">
    <mu-sub-header>用户列表</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-row>
        <mu-col width="100" tablet="100" desktop="100">
          <mu-table ref="table" :showCheckbox="false" @cellClick="handlerSave">
            <mu-thead>
              <mu-tr>
                <mu-th>用户名</mu-th>
                <mu-th>剩余时间 (单位/月)</mu-th>
                <mu-th>操作</mu-th>
              </mu-tr>
            </mu-thead>
            <mu-tbody>
              <mu-tr v-for="user of users" :key="user.id">
                <mu-td>{{user.username}}</mu-td>
                <mu-td>
                  <mu-slider class="expired-slider" v-model="user.expiredUnit" :min="0" :max="12" :step="1"/>
                </mu-td>
                <mu-td name="saveBtn">
                  <mu-raised-button label="保存"
                                    primary
                                    icon="save"
                                    fullWidth/>
                </mu-td>
              </mu-tr>
            </mu-tbody>
          </mu-table>
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
    name: 'usersList',
    data () {
      return {
        users: this.$store.state.users ? this.$store.state.users : []
      }
    },
    methods: {
      handlerSave (index, trName) {
        if (!trName) return false
        this.users[index].expired_date = new Date(new Date().getTime() + this.users[index].expiredUnit * monthTimestamp)
        axios.patch(`/user/expired/${this.users[index].id}`, qs.stringify({
          expired_date: this.users[index].expired_date
        }))
          .then(res => {
            this.$store.commit('getUsers', this.users)
          })
      }
    },
    mounted () {
      if (!this.$store.state.users) {
        axios.get('/user')
          .then(users => {
            this.$store.commit('getUsers', users)
            this.users = this.$store.state.users
          })
      }
      this.users.forEach(user => {
        let expiredUnit = Math.ceil((new Date(user.expired_date).getTime() - new Date().getTime()) / monthTimestamp)
        if (expiredUnit < 0) expiredUnit = 0
        if (expiredUnit > 12) expiredUnit = 12
        user.expiredUnit = expiredUnit
      })
    }
  }
</script>

<style lang="scss">
  .users-list {
    .expired-slider {
      margin: 0;
    }
  }
</style>
