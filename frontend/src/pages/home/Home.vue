<template>
  <div id="home">
    <mu-row class="header" gutter>
      <mu-col :width="menuAndContentWidth[0]" :tablet="menuAndContentWidth[0]" :desktop="menuAndContentWidth[0]" class="logo">霸屏后台管理</mu-col>
      <mu-col :width="menuAndContentWidth[1]" :tablet="menuAndContentWidth[1]" :desktop="menuAndContentWidth[1]" class="profile">
        <mu-appbar :zDepth="1">
          <mu-icon-button icon="menu" slot="left" @click="menuIsOpen=!menuIsOpen"/>
          <mu-paper class="user-headimg" circle :zDepth="1" slot="right">R</mu-paper>
          <mu-icon-menu icon="more_vert" slot="right">
            <mu-menu-item title="个人信息"/>
            <mu-menu-item title="退出"/>
          </mu-icon-menu>
        </mu-appbar>
      </mu-col>
    </mu-row>
    <div class="content">
      <div class="content-left">
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
      </div>
      <div class="content-right">
        <div class="body">
          <mu-content-block>
            <router-view></router-view>
          </mu-content-block>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
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
        if (this.menuIsOpen) return ['20', '80']
        return ['0', '100']
      }
    },
    methods: {
      handleMenuChange (val) {
        this.activeMenu = val
      }
    }
  }
</script>

<style lang="scss">
  #app {
    background-color: rgb(236, 236, 236);
    .header {
      background-color: #7e57c2;
      .logo {
        font-size: 24px;
        color: #fff;
        display: inline-block;
        padding: 0 20px;
        height: 64px;
        line-height: 64px;
      }
      .profile {
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
        width: 20%;
        float: left;
        background-color: white;
        margin-bottom: -4000px;
        padding-bottom: 4000px;
      }
      .content-right {
        width: 80%;
        display: inline-block;
        float: right;
        padding: 10px 20px;
        background-color: rgba(0, 0, 0, 0);
        .body {
          background-color: #fff;
          border-radius: 5px;
          min-height: 89vh;
          .mu-sub-header {
            font-size: 18px;
          }
        }
      }
    }
  }
</style>
