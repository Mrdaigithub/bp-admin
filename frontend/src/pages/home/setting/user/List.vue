<template>
  <div class="users-list">
    <mu-sub-header>用户列表</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-row>
        <mu-col width="100" tablet="100" desktop="100">
          <mu-table ref="table" :showCheckbox="false" @cellClick="handlerOperate">
            <mu-thead>
              <mu-tr>
                <mu-th>ID</mu-th>
                <mu-th>UID</mu-th>
                <mu-th>用户名</mu-th>
                <mu-th>剩余时间 (单位/月)</mu-th>
                <mu-th>保存</mu-th>
                <mu-th>删除</mu-th>
              </mu-tr>
            </mu-thead>
            <mu-tbody>
              <mu-tr v-for="user of users" :key="user.id">
                <mu-td class="id-col">{{user.id}}</mu-td>
                <mu-td>{{user.uid}}</mu-td>
                <mu-td>{{user.username}}</mu-td>
                <mu-td>
                  <mu-slider class="expired-slider" v-model="user.expiredUnit" :min="0" :max="12" :step="1"/>
                </mu-td>
                <mu-td name="save">
                  <mu-raised-button label="保存"
                                    primary
                                    icon="save"
                                    primary
                                    fullWidth/>
                </mu-td>
                <mu-td name="remove">
                  <mu-raised-button :disabled="user.id===1 && user.username==='root'"
                                    label="删除"
                                    primary
                                    icon="delete"
                                    backgroundColor="#dd5044"
                                    @click="removeUser(user.id)"
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
      handlerOperate (index, trName) {
        if (trName === 'save') {
          this.users[index].expired_date = new Date(new Date().getTime() + this.users[index].expiredUnit * monthTimestamp)
          axios.patch(`/user/expired/${this.users[index].id}`, qs.stringify({
            expired_date: this.users[index].expired_date
          }))
            .then(users => {
              this.$toast('保存成功', {
                horizontalPosition: 'center',
                duration: 1000
              })
            })
        }
      },
      removeUser (id) {
        axios.delete(`/user/${id}`)
          .then(users => {
            this.initUsersData(users)
            this.$toast('删除成功', {
              horizontalPosition: 'center',
              duration: 1000
            })
          })
      },
      initUsersData (users, context = this) {
        context.$store.commit('getUsers', users)
        context.users = context.$store.state.users
        context.users.forEach(user => {
          let expiredUnit = Math.ceil((new Date(user.expired_date).getTime() - new Date().getTime()) / monthTimestamp)
          if (expiredUnit < 0) expiredUnit = 0
          if (expiredUnit > 12) expiredUnit = 12
          user.expiredUnit = expiredUnit
          user.confirm = false
        })
      }
    },
    mounted () {
      if (!this.$store.state.users) {
        axios.get('/user')
          .then(users => {
            this.initUsersData(users)
          })
      }
    }
  }
</script>

<style lang="scss">
  .mu-table {
    .mu-thead {
      .mu-th:nth-child(1) {
        width: 5%;
      }
      .mu-th:nth-child(3) {
        width: 10%;
      }
      .mu-th:nth-child(5), .mu-th:nth-child(6) {
        width: 15%;
      }
    }
  }

  .users-list {
    .expired-slider {
      margin: 0;
    }
  }
</style>
