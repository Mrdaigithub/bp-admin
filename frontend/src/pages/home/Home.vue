<template>
  <div id="home">
    <mu-drawer :open="menuIsOpen" :docked="false" @close="menuIsOpen=false" class="menu-bar">
      <mu-list @change="handleMenuChange" :value="activeMenu">
        <mu-list-item title="霸屏后台管理" class="logo"/>
        <mu-list-item title="霸屏设置" toggleNested value="menu1">
          <mu-icon slot="left" value="fullscreen"/>
          <mu-list-item slot="nested" title="移动霸屏" value="menu1-1" to="/home/bp/mobile">
            <mu-icon slot="left" value="phonelink_setup"/>
          </mu-list-item>
        </mu-list-item>
        <mu-list-item title="系统管理" toggleNested value="menu2">
          <mu-icon slot="left" value="settings"/>
          <mu-list-item v-if="$store.state.oneself ? $store.state.oneself.power : false"
                        slot="nested"
                        title="创建用户"
                        value="menu2-1"
                        to="/home/setting/user/create">
            <mu-icon slot="left" value="person_add"/>
          </mu-list-item>
          <mu-list-item v-if="$store.state.oneself ? $store.state.oneself.power : false"
                        slot="nested"
                        title="用户列表"
                        value="menu2-2"
                        to="/home/setting/user/list">
            <mu-icon slot="left" value="supervisor_account"/>
          </mu-list-item>
          <mu-list-item slot="nested"
                        title="修改密码"
                        value="menu2-3"
                        to="/home/setting/user/update/password">
            <mu-icon slot="left" value="lock_open"/>
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
      {{$store.state.oneself ? $store.state.oneself.username : ''}} 到期时间为:{{$store.state.oneself ? $store.state.oneself['expired_date'] : ''}}。可绑定域名50个
    </mu-dialog>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'home',
    data () {
      return {
        activeMenu: 'menu1-1',
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
      }
    },
    watch: {
      '$route': 'fetchInitData'
    },
    methods: {
      handleMenuChange (val) {
        this.activeMenu = val
      },
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
      overflow: hidden;
      background-color: #cecece;
      .menu-bar {
        .mu-list {
          padding: 0;
          .logo {
            background-color: #7e57c2;
            .mu-item {
              color: #fff;
              height: 9vh;
              .mu-item-title {
                font-size: 24px;
              }
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
