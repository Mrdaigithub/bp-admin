<template>
  <div id="home">
    <mu-row class="header" gutter>
      <mu-col width="100" tablet="25" desktop="25" class="logo">霸屏后台管理</mu-col>
      <mu-col width="100" tablet="15" desktop="15" class="profile">
        <div class="headimg">R</div>
        <mu-icon-menu icon="more_vert" :open="profileIsOpen">
          <mu-menu-item title="Refresh"/>
          <mu-menu-item title="Send feedback"/>
          <mu-menu-item title="Settings"/>
          <mu-menu-item title="Help"/>
          <mu-menu-item title="Sign out"/>
        </mu-icon-menu>
      </mu-col>
    </mu-row>
    <div class="content">
      <div class="content-left">
        <mu-list @change="handleMenuChange" :value="activeMenu">
          <mu-list-item title="霸屏设置" toggleNested value="menu1">
            <mu-icon slot="left" value="inbox"/>
            <mu-list-item slot="nested" title="移动霸屏" value="menu1-1">
              <mu-icon slot="left" value="grade"/>
            </mu-list-item>
          </mu-list-item>
          <mu-list-item title="统计代码" toggleNested value="menu2">
            <mu-icon slot="left" value="inbox"/>
            <mu-list-item slot="nested" title="手机统计代码" value="menu2-1">
              <mu-icon slot="left" value="grade"/>
            </mu-list-item>
          </mu-list-item>
          <mu-list-item title="系统管理" toggleNested value="menu3">
            <mu-icon slot="left" value="inbox"/>
            <mu-list-item slot="nested" title="个人设置" value="menu3-1">
              <mu-icon slot="left" value="grade"/>
            </mu-list-item>
          </mu-list-item>
        </mu-list>
      </div>
      <div class="content-right">
        <div class="body">
          <mu-sub-header>title</mu-sub-header>
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
        profileIsOpen: false
      }
    },
    methods: {
      handleMenuChange (val) {
        this.activeMenu = val
      },
      handleProfileToggle () {
        this.profileIsOpen = !this.profileIsOpen
      }
    }
  }
</script>

<style lang="scss">
  #app {
    background-color: rgb(236, 236, 236);
    .header {
      background-color: #7e57c2;
      height: 8vh;
      line-height: 8vh;
      .logo {
        font-size: 24px;
        color: #fff;
        display: inline-block;
        padding: 0 20px;
      }
      .profile {
        height: 8vh;
        line-height: 8vh;
        .headimg {
          width: 5vh;
          height: 5vh;
          line-height: 5vh;
          font-size: 22px;
          color: #fff;
          font-weight: bold;
          display: inline-block;
          vertical-align: middle;
          background-color: #dd5044;
          border-radius: 50%;
          text-align: center;
        }
        .mu-icon-menu {
          height: 8vh;
          vertical-align: middle;
          .mu-icon-button {
            line-height: 8vh;
            padding: 0;
          }
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
        background-color: rgba(0, 0, 0, 0)
      }
    }
  }

  .body {
    background-color: white;
    border-radius: 5px;
    min-height: 89vh;
  }

  .footer {
    padding: 20px 0;
    text-align: center;
  }
</style>
