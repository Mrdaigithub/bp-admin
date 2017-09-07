<template>
  <div class="bp-mobile-config">
    <mu-sub-header>移动霸屏 - 参数设置</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row>
          <mu-col width="100" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="公司名称"
              name="公司名称"
              v-model.trim="configs.hospital"
              v-validate="''"
              :errorText="errors.first('公司名称')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="电话"
              name="电话"
              v-model.trim="configs.phone"
              v-validate="'phone'"
              :errorText="errors.first('电话')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="医院地址"
              name="医院地址"
              v-model.trim="configs.address"
              v-validate="''"
              :errorText="errors.first('医院地址')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="手机站域名绑定"
              name="手机站域名绑定"
              v-model.trim="configs.domainname"
              v-validate="''"
              :errorText="errors.first('手机站域名绑定')"
              hintText="(以英文逗号分割 如m.aa.com,4g.bb.com"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="广告链接"
              name="广告链接"
              v-model.trim="configs.swturl"
              v-validate="'url'"
              :errorText="errors.first('广告链接')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-time-picker
              label="开启时刻"
              fullWidth
              name="开启时刻"
              v-model.trim="openTimeValue"
              v-validate="''"
              :errorText="errors.first('开启时刻')"
              format="24hr"
              mode="landscape"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-time-picker
              label="关闭时刻"
              fullWidth
              name="关闭时刻"
              v-model.trim="closeTimeValue"
              v-validate="''"
              :errorText="errors.first('关闭时刻')"
              format="24hr"
              mode="landscape"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <p>投放地区:</p>
            <p>勾选即为投放，如：勾选"北京"则表示投放北京ip的功能</p>
            <mu-checkbox label="北京" nativeValue="北京" v-model="configs.area"/>
            <mu-checkbox label="安徽" nativeValue="安徽" v-model="configs.area"/>
            <mu-checkbox label="福建" nativeValue="福建" v-model="configs.area"/>
            <mu-checkbox label="甘肃" nativeValue="甘肃" v-model="configs.area"/>
            <mu-checkbox label="广东" nativeValue="广东" v-model="configs.area"/>
            <mu-checkbox label="广西" nativeValue="广西" v-model="configs.area"/>
            <mu-checkbox label="贵州" nativeValue="贵州" v-model="configs.area"/>
            <mu-checkbox label="海南" nativeValue="海南" v-model="configs.area"/>
            <mu-checkbox label="河北" nativeValue="河北" v-model="configs.area"/>
            <mu-checkbox label="河南" nativeValue="河南" v-model="configs.area"/>
            <mu-checkbox label="黑龙江" nativeValue="黑龙江" v-model="configs.area"/>
            <mu-checkbox label="湖北" nativeValue="湖北" v-model="configs.area"/>
            <mu-checkbox label="湖南" nativeValue="湖南" v-model="configs.area"/>
            <mu-checkbox label="吉林" nativeValue="吉林" v-model="configs.area"/>
            <mu-checkbox label="江苏" nativeValue="江苏" v-model="configs.area"/>
            <mu-checkbox label="江西" nativeValue="江西" v-model="configs.area"/>
            <mu-checkbox label="辽宁" nativeValue="辽宁" v-model="configs.area"/>
            <mu-checkbox label="内蒙古" nativeValue="内蒙古" v-model="configs.area"/>
            <mu-checkbox label="宁夏" nativeValue="宁夏" v-model="configs.area"/>
            <mu-checkbox label="青海" nativeValue="青海" v-model="configs.area"/>
            <mu-checkbox label="山东" nativeValue="山东" v-model="configs.area"/>
            <mu-checkbox label="山西" nativeValue="山西" v-model="configs.area"/>
            <mu-checkbox label="陕西" nativeValue="陕西" v-model="configs.area"/>
            <mu-checkbox label="上海" nativeValue="上海" v-model="configs.area"/>
            <mu-checkbox label="四川" nativeValue="四川" v-model="configs.area"/>
            <mu-checkbox label="天津" nativeValue="天津" v-model="configs.area"/>
            <mu-checkbox label="西藏" nativeValue="西藏" v-model="configs.area"/>
            <mu-checkbox label="新疆" nativeValue="新疆" v-model="configs.area"/>
            <mu-checkbox label="云南" nativeValue="云南" v-model="configs.area"/>
            <mu-checkbox label="浙江" nativeValue="浙江" v-model="configs.area"/>
            <mu-checkbox label="重庆" nativeValue="重庆" v-model="configs.area"/>
            <mu-checkbox label="香港" nativeValue="香港" v-model="configs.area"/>
            <mu-checkbox label="澳门" nativeValue="澳门" v-model="configs.area"/>
            <mu-checkbox label="台湾" nativeValue="台湾" v-model="configs.area"/>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="顶部漂浮广告图片url"
              name="顶部漂浮广告图片url"
              v-model.trim="configs.piaoimg"
              v-validate="'url:true'"
              hintText="尺寸:360x50"
              :errorText="errors.first('顶部漂浮广告图片url')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="漂浮广告点击url"
              name="漂浮广告点击url"
              v-model.trim="configs.piaourl"
              v-validate="'url:true'"
              hintText=""
              :errorText="errors.first('漂浮广告点击url')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="75" desktop="75">
            <mu-text-field
              fullWidth
              label="IP屏蔽功能(系统已屏蔽百度总部IP段)"
              name="IP屏蔽"
              v-model.trim="configs.ipduan"
              hintText="屏蔽IP段方法： 211.211.211.10-211.211.211.100 之间IP 用-分开每行一个规则"
              v-validate="''"
              multiLine
              :rows="3"
              :rowsMax="6"
              :errorText="errors.first('IP屏蔽')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="75" desktop="75">
            <mu-text-field fullWidth
                           label="关键词替换功能"
                           hintText="自然排名中的负面信息 黑 坑 骗子之类的 替换成指定关键词 替换格式： 黑-好 用-分开 每行一个规则"
                           multiLine
                           v-model.trim="configs.cith"
                           :rows="3"
                           :rowsMax="6"/>
          </mu-col>
          <mu-col width="100" tablet="75" desktop="75">
            <mu-text-field fullWidth
                           label="[第三方统计代码]  手机统计代码:"
                           hintText="(使用51la统计，并隐藏图标)"
                           multiLine
                           v-model.trim="configs.mobilecode"
                           :rows="3"
                           :rowsMax="6"/>
          </mu-col>
          <mu-col width="100" tablet="75" desktop="75">
            <mu-text-field fullWidth
                           label="商务通霸屏代码"
                           hintText="(将此代码放入你需要的商务通后台中,安装说明)"
                           v-model.trim="configs.daima"/>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-float-button @click="handleSubmit"
                       class="submit-button"
                       ref="submitButton"
                       @hover="tooltipShow = true"
                       @hoverExit="tooltipShow = false">
        <mu-icon value="cloud_upload"/>
        <mu-tooltip label="提交当前表单"
                    :show="tooltipShow"
                    :trigger="$refs['submitButton']"
                    verticalPosition="top"
                    horizontalPosition="center"/>
      </mu-float-button>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'bpMobileConfig',
    data () {
      return {
        configs: {
          hospital: '',
          area: []
        },
        openTimeValue: '',
        closeTimeValue: '',
        tooltipShow: false
      }
    },
    watch: {
      openTimeValue (val) {
        let timeArr = this.configs.opentime.split('-')
        timeArr[0] = `${val}:00`
        this.configs.opentime = timeArr.join('-')
      },
      closeTimeValue (val) {
        let timeArr = this.configs.opentime.split('-')
        timeArr[1] = `${val}:59`
        this.configs.opentime = timeArr.join('-')
      }
    },
    methods: {
      handleSubmit () {
        this.$validator.validateAll().then(res => {
          if (res) this.$store.dispatch('updateConfig', this.configs)
          else {
            this.$toast('表单验证未通过', {
              horizontalPosition: 'center',
              className: ['et-alert'],
              duration: 1500
            })
          }
          return res
        })
      }
    },
    mounted () {
      let self = this
      !(async function () {
        if (!self.$store.state.configs) self.$store.commit('getConfig', await axios.get('/config'))
        let configs = self.$store.state.configs
        self.configs.hospital = configs.hospital ? configs.hospital : ''
        self.configs.phone = configs.phone ? configs.phone : ''
        self.configs.address = configs.address ? configs.address : ''
        self.configs.domainname = configs.domainname ? configs.domainname : ''
        self.configs.swturl = configs.swturl ? configs.swturl : ''
        self.configs.opentime = configs.opentime ? configs.opentime : ''
        self.configs.area = configs.area ? configs.area.split(',') : []
        self.configs.piaoimg = configs.piaoimg ? configs.piaoimg : ''
        self.configs.piaourl = configs.piaourl ? configs.piaourl : ''
        self.configs.ipduan = configs.ipduan ? configs.ipduan : ''
        self.configs.cith = configs.cith ? configs.cith : ''
        self.configs.mobilecode = configs.mobilecode ? configs.mobilecode : ''
        self.configs.daima = configs.daima ? configs.daima : ''
        if (self.configs.opentime) {
          self.openTimeValue = `${self.configs.opentime.split('-')[0].split(':')[0]}:${self.configs.opentime.split('-')[0].split(':')[1]}`
          self.closeTimeValue = `${self.configs.opentime.split('-')[1].split(':')[0]}:${self.configs.opentime.split('-')[1].split(':')[1]}`
        }
      })()
    }
  }
</script>

<style lang="scss">
  .mu-time-display-time {
    display: table;
    span:nth-child(2) {
      margin:0 8px;
    }
  }

  .bp-mobile-config {
    .paper-container {
      margin: 60px 0;
      padding: 20px 30px;
      .mu-text-field {
        color: rgba(0, 0, 0, .87);
      }
    }
    .submit-button {
      position: fixed;
      bottom: 5vh;
      right: 5vw;
    }
  }
</style>
