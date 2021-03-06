<template>
  <div id="home">
    <mu-drawer :open="menuIsOpen" :docked="false" @close="menuIsOpen=false" class="menu-bar">
      <mu-list :value="routeName" @change="menuIsOpen=false">
        <mu-list-item title="霸屏后台管理" class="logo" to="/home/dashboard" @click="menuIsOpen=false"/>
        <mu-list-item title="仪表盘" value="dashboard" to="/home/dashboard">
          <mu-icon slot="left" value="computer"/>
        </mu-list-item>
        <mu-list-item title="移动霸屏" toggleNested>
          <mu-icon slot="left" value="phonelink_setup"/>
          <mu-list-item slot="nested" title="参数设置" value="bpMobileConfig" to="/home/bp/mobile/config">
            <mu-icon slot="left" value="chrome_reader_mode"/>
          </mu-list-item>
          <mu-list-item slot="nested" title="广告位设置" value="bpMobileAd" to="/home/bp/mobile/ad">
            <mu-icon slot="left" value="view_headline"/>
          </mu-list-item>
        </mu-list-item>
        <mu-list-item title="用户管理" toggleNested>
          <mu-icon slot="left" value="account_circle"/>
          <mu-list-item v-if="$store.state.oneself ? $store.state.oneself.power : false"
                        slot="nested"
                        title="创建用户"
                        value="settingUserCreate"
                        to="/home/setting/user/create">
            <mu-icon slot="left" value="person_add"/>
          </mu-list-item>
          <mu-list-item v-if="$store.state.oneself ? $store.state.oneself.power : false"
                        slot="nested"
                        title="用户列表"
                        value="settingUserList"
                        to="/home/setting/user/list">
            <mu-icon slot="left" value="supervisor_account"/>
          </mu-list-item>
          <mu-list-item slot="nested"
                        title="修改密码"
                        value="settingUserUpdatePassword"
                        to="/home/setting/user/update/password">
            <mu-icon slot="left" value="lock_open"/>
          </mu-list-item>
        </mu-list-item>
        <mu-list-item title="系统管理" toggleNested>
          <mu-icon slot="left" value="settings"/>
          <mu-list-item slot="nested"
                        title="访问日志"
                        value="settingSystemLog"
                        to="/home/setting/system/log">
            <mu-icon slot="left" value="speaker_notes"/>
          </mu-list-item>
        </mu-list-item>
      </mu-list>
    </mu-drawer>
    <main class="main">
      <mu-appbar :zDepth="1" class="profile">
        <mu-icon-button icon="menu" slot="left" @click="menuIsOpen=!menuIsOpen"/>
        <mu-paper class="user-headimg" circle :zDepth="1" slot="right" :style="headColor">{{firstName}}</mu-paper>
        <mu-icon-menu icon="more_vert" slot="right">
          <mu-menu-item title="个人信息" @click="dialogVisibility = true"/>
          <mu-divider/>
          <mu-menu-item title="退出" @click="logout"/>
        </mu-icon-menu>
      </mu-appbar>
      <div class="content-wrap scrollbar">
        <mu-paper :zDepth="1" class="content scrollbar">
          <router-view></router-view>
        </mu-paper>
      </div>
    </main>
    <mu-dialog :open="dialogVisibility" @close="dialogVisibility = false">
      {{$store.state.oneself ? $store.state.oneself.username : ''}} 到期时间为:{{$store.state.oneself ? $store.state.oneself['expired_date'] : ''}}
    </mu-dialog>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'home',
    data () {
      return {
        menuIsOpen: false,
        dialogVisibility: false
      }
    },
    computed: {
      firstName () {
        return this.$store.state.oneself ? this.$store.state.oneself.username[0].toUpperCase() : ''
      },
      headColor () {
        let colors = ['#dd4e41', '#4c8bf5', '#717171', '#ffce42', '#5394ec', '#7e57c2', '#9999FF', '#660033', '#3399CC', '#080707']
        if (!this.$store.state.oneself) return {backgroundColor: '#2b2b2b'}
        let sub = (this.$store.state.oneself.id / 1024 * 65535 / 22 * 8388).toString()[1]
        return {backgroundColor: colors[sub]}
      },
      routeName () {
        let rName = this.$route.name
        if (rName === 'dashboard' ||
          rName === 'bpMobileConfig' ||
          rName === 'bpMobileAd' ||
          rName === 'settingUserUpdatePassword' ||
          rName === 'settingUserCreate' ||
          rName === 'settingUserList' ||
          rName === 'settingSystemLog') {
          return rName
        }
      }
    },
    watch: {
      '$route': 'fetchInitData'
    },
    methods: {
      fetchInitData () {
        let self = this
        !(async function () {
          if (self.$route.name !== 'Login' && sessionStorage.token) {
            if (!self.$store.state.oneself) {
              let [oneself] = await Promise.all([axios.get('/user/0')])
              self.$store.commit('getOneself', oneself)
            }
          }
        })()
      },
      logout () {
        this.$router.replace('/login')
      }
    },
    mounted () {
      this.fetchInitData()
    }
  }
</script>

<style lang="scss">
  #app {
    #home {
      width: 100vw;
      height: 100vh;
      min-width: 320px;
      overflow: hidden;
      background-color: #cecece;
      .menu-bar {
        .mu-list {
          padding: 0;
          .logo {
            background-color: #009688;
            .mu-item {
              color: #fff;
              height: 9vh;
              .mu-item-title {
                font-size: 24px;
              }
            }
          }
          .selected {
            .mu-icon {
              color: #009688 !important;
            }
          }
        }
      }
      .main {
        .profile {
          height: 9vh;
          .user-headimg {
            display: block;
            width: 40px;
            color: #fff;
            background-color: #ffce43;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            line-height: 40px;
          }
        }
        .content-wrap {
          height: 91vh;
          .content {
            background-color: #fff;
            border-radius: 5px;
            box-sizing: border-box;
            min-height: 88vh;
            padding: 20px;
            color: rgba(0, 0, 0, .54);
            margin: 10px;
            .mu-sub-header {
              font-size: 18px;
            }
          }
        }
        .scrollbar {
          overflow-y: scroll;
          &::-webkit-scrollbar {
            width: 10px;
            height: 10px;
          }
          &::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, .3);
          }
          &::-webkit-scrollbar-corner {
            background-color: transparent;
          }
        }
      }
    }
  }
</style>
