<template>
  <div id="home">
    <mu-flexbox class="header" :gutter="0">
      <mu-flexbox-item class="logo" :grow="menuAndContentWidth[0]" v-show="menuIsOpen">霸屏后台管理</mu-flexbox-item>
      <mu-flexbox-item :grow="menuAndContentWidth[1]" class="profile">
        <mu-appbar :zDepth="1">
          <mu-icon-button icon="menu" slot="left" @click="menuIsOpen=!menuIsOpen"/>
          <mu-paper class="user-headimg" circle :zDepth="1" slot="right" :style="headColor">{{firstName}}</mu-paper>
          <mu-icon-menu icon="more_vert" slot="right">
            <mu-menu-item title="个人信息"/>
            <mu-menu-item title="退出" @click="logout"/>
          </mu-icon-menu>
        </mu-appbar>
      </mu-flexbox-item>
    </mu-flexbox>
    <mu-flexbox class="content" :gutter="0" align="flex-start">
      <mu-flexbox-item class="content-left" :grow="menuAndContentWidth[0]" v-show="menuIsOpen">
        <mu-list @change="handleMenuChange" :value="activeMenu">
          <mu-list-item title="霸屏设置" toggleNested value="menu1">
            <mu-icon slot="left" value="inbox"/>
            <mu-list-item slot="nested" title="移动霸屏" value="menu1-1" to="/home/bp/mobile">
              <mu-icon slot="left" value="grade"/>
            </mu-list-item>
          </mu-list-item>
          <mu-list-item title="统计代码" toggleNested value="menu2">
            <mu-icon slot="left" value="inbox"/>
            <mu-list-item slot="nested" title="手机统计代码" value="menu2-1" to="/home/statistics/mobile">
              <mu-icon slot="left" value="grade"/>
            </mu-list-item>
          </mu-list-item>
          <mu-list-item title="系统管理" toggleNested value="menu3">
            <mu-icon slot="left" value="inbox"/>
            <mu-list-item slot="nested" title="个人设置" value="menu3-1" to="/home/setting/user">
              <mu-icon slot="left" value="grade"/>
            </mu-list-item>
          </mu-list-item>
        </mu-list>
      </mu-flexbox-item>
      <mu-flexbox-item class="content-right scrollbar" :grow="menuAndContentWidth[1]">
        <mu-content-block class="body">
          <router-view></router-view>
        </mu-content-block>
      </mu-flexbox-item>
    </mu-flexbox>
  </div>
</template>

<script>
  import axios from '../../config/axios'

  export default {
    name: 'home',
    data () {
      return {
        activeMenu: 'menu1-1',
        menuIsOpen: true
      }
    },
    computed: {
      menuAndContentWidth () {
        if (this.menuIsOpen) return [1, 4]
        return [0, 1]
      },
      firstName () {
        return this.$store.state.oneself ? this.$store.state.oneself.username[0].toUpperCase() : ''
      },
      headColor () {
        let colors = ['#dd4e41', '#4c8bf5', '#ffce42', '#717171', '#b2b2b2', '#7e57c2', '#9999FF', '#660033', '#3399CC', '#333333']
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
              console.log(self.$store.state.oneself.username)
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
      background-color: rgb(236, 236, 236);
      .header {
        background-color: #7e57c2;
        .logo {
          font-size: 24px;
          color: #fff;
          display: inline-block;
          text-indent: 20px;
          height: 10vh;
          line-height: 10vh;
          min-width: auto;
        }
        .profile {
          .mu-appbar {
            height: 10vh;
          }
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
      }
      .content {
        overflow: hidden;
        .content-left {
          min-width: auto;
          background-color: white;
          margin-bottom: -4000px;
          padding-bottom: 4000px;
        }
        .content-right {
          padding: 10px 15px;
          box-sizing: border-box;
          background-color: rgba(0, 0, 0, 0);
          height: 90vh;
          .body {
            background-color: #fff;
            border-radius: 5px;
            min-height: 85vh;
            .mu-sub-header {
              font-size: 18px;
            }
          }
        }
        .scrollbar {
          overflow: scroll;
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
