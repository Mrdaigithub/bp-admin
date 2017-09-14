<template>
  <div class="bp-mobile-config">
    <a style="display: none" id="parseUrl"></a>
    <mu-sub-header>移动霸屏 - 参数设置</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="公司名称"
              name="公司名称"
              v-model.trim="configs.hospital"
              v-validate="''"
              :errorText="errors.first('公司名称')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="电话"
              name="电话"
              v-model.trim="configs.phone"
              v-validate="'phone'"
              :errorText="errors.first('电话')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45">
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
              hintText="(以英文逗号分割 如aa.com,bb.com"
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
          <mu-col width="100" tablet="100" desktop="100" class="channel">
            <p>投放渠道</p>
            <mu-checkbox name="channel"
                         v-for="channelItem of allChannel"
                         :key="channelItem"
                         :label="channelItem"
                         :nativeValue="channelItem"
                         labelLeft
                         class="area-item"
                         v-model="configs.channel"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <p>投放地区</p>
            <div class="select-all-area">
              <mu-checkbox label="全选" nativeValue="全选" labelLeft class="area-item" v-model="selectAllState"/>
            </div>
            <mu-checkbox name="area"
                         v-for="areaItem of allArea"
                         :key="areaItem"
                         :label="areaItem"
                         :nativeValue="areaItem"
                         labelLeft
                         class="area-item"
                         v-model="configs.area"
                         @change="changeArea"/>
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
              hintText="尺寸:650x190"
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
          <mu-col width="100" tablet="45" desktop="45"
                  v-if="$store.state.oneself ? $store.state.oneself.power === 1 : false">
            <mu-text-field fullWidth
                           label="霸屏文件url"
                           name="霸屏文件url"
                           v-model.trim="configs.swturl"
                           @input="changeSwturl"
                           v-validate="'required|url'"
                           hintText="http://bpfile.php"
                           :errorText="errors.first('霸屏文件url')"/>
          </mu-col>
          <mu-col width="100" tablet="45" desktop="45"
                  v-if="$store.state.oneself ? $store.state.oneself.power === 1 : false">
            <mu-text-field
              fullWidth
              label="前端url"
              name="前端url"
              v-model.trim="configs.fronturl"
              v-validate="'required|url'"
              :errorText="errors.first('前端url')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <mu-text-field disabled
                           fullWidth
                           label="预览商务通霸屏url"
                           name="预览商务通霸屏url"
                           v-model="previewurl"
                           :errorText="errors.first('预览商务通霸屏url')"/>
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
          area: [],
          channel: []
        },
        allArea: ['北京', '安徽', '福建', '甘肃', '广东', '广西', '贵州', '海南', '河北', '河南', '湖北', '湖南', '吉林', '江苏', '江西', '辽宁', '宁夏', '青海', '山东', '山西', '陕西', '上海', '四川', '天津', '西藏', '新疆', '云南', '浙江', '重庆', '香港', '澳门', '台湾', '黑龙江', '内蒙古'],
        allChannel: ['baidu', 'sogou', '360', 'sm'],
        selectAllState: false,
        openTimeValue: '',
        previewurl: '',
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
      },
      selectAllState (val) {
        if (val) this.configs.area = this.allArea
        else {
          if (this.configs.area.length === this.allArea.length) this.configs.area = []
        }
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
      },
      changeArea (val) {
        this.selectAllState = val.length === this.allArea.length
      },
      changeSwturl (val) {
        if (!val) {
          this.previewurl = ''
          return
        }
        this.previewurl = `<script src="${val}?uid=${this.$store.state.oneself.uid}"><`
        this.previewurl += `/script>`
      }
    },
    mounted () {
      let self = this
      !(async function () {
        if (!self.$store.state.configs) self.$store.commit('getConfig', await axios.get('/config'))
        if (!self.$store.state.oneself) self.$store.commit('getOneself', await axios.get('/user/0'))
        let configs = self.$store.state.configs
        self.configs.hospital = configs.hospital ? configs.hospital : ''
        self.configs.phone = configs.phone ? configs.phone : ''
        self.configs.address = configs.address ? configs.address : ''
        self.configs.domainname = configs.domainname ? configs.domainname : ''
        self.configs.opentime = configs.opentime ? configs.opentime : ''
        self.configs.channel = configs.channel ? configs.channel.split(',') : []
        self.configs.area = configs.area ? configs.area.split(',') : []
        self.configs.piaoimg = configs.piaoimg ? configs.piaoimg : ''
        self.configs.piaourl = configs.piaourl ? configs.piaourl : ''
        self.configs.ipduan = configs.ipduan ? configs.ipduan : ''
        self.configs.cith = configs.cith ? configs.cith : ''
        self.configs.mobilecode = configs.mobilecode ? configs.mobilecode : ''
        self.configs.fronturl = configs.fronturl ? configs.fronturl : ''
        self.configs.swturl = configs.swturl ? configs.swturl : ''
        self.configs.previewurl = configs.previewurl ? configs.previewurl : ''
        self.previewurl = self.configs.previewurl
        if (self.configs.opentime) {
          self.openTimeValue = `${self.configs.opentime.split('-')[0].split(':')[0]}:${self.configs.opentime.split('-')[0].split(':')[1]}`
          self.closeTimeValue = `${self.configs.opentime.split('-')[1].split(':')[0]}:${self.configs.opentime.split('-')[1].split(':')[1]}`
        }
        self.selectAllState = self.configs.area.length === self.allArea.length
      })()
    }
  }
</script>

<style lang="scss">
  .mu-time-display-time {
    display: table;
    span:nth-child(2) {
      margin: 0 8px;
    }
  }

  .bp-mobile-config {
    .paper-container {
      margin: 60px 0;
      padding: 20px 30px;
      .mu-text-field {
        color: rgba(0, 0, 0, .87);
      }
      .select-all-area {
        margin: 5px 0 20px 0;
      }
      .channel {
        margin: 20px 0 50px 0;
      }
      .area-item {
        margin-right: 30px;
        .mu-checkbox-wrapper {
          .mu-checkbox-icon {
            margin-left: 3px;
          }
        }
      }
    }
    .submit-button {
      position: fixed;
      bottom: 5vh;
      right: 5vw;
    }
  }
</style>
