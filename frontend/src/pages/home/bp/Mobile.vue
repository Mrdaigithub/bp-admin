<template>
  <div class="bp-mobile">
    <mu-sub-header>移动霸屏</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="公司名称"
              name="公司名称"
              v-model.trim="config.hospital"
              v-validate="''"
              :errorText="errors.first('公司名称')"
              type="text"/>
          </mu-col>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="电话"
              name="电话"
              v-model.trim="config.phone"
              v-validate="''"
              :errorText="errors.first('电话')"
              type="text"/>
          </mu-col>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="手机站域名绑定"
              name="手机站域名绑定"
              v-model.trim="config.domainname"
              v-validate="''"
              :errorText="errors.first('手机站域名绑定')"
              hintText="(以,分割(英文逗号分割) 如wap.aaa.com,m.bbb.com)"
              type="text"/>
          </mu-col>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field
              fullWidth
              label="广告链接"
              name="广告链接"
              v-model.trim="config.swturl"
              v-validate="''"
              :errorText="errors.first('广告链接')"
              type="text"/>
          </mu-col>
          <mu-col width="65" tablet="65" desktop="65">
            <mu-text-field
              fullWidth
              label="开启时段"
              name="开启时段"
              v-model.trim="config.opentime"
              v-validate="''"
              :errorText="errors.first('开启时段')"
              hintText=" (为空默认全天,填写方式 按小时以逗号分开如：00,01,08,09,10,11,12,23)"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <p>投放地区:</p>
            <p>勾选即为投放，如：勾选"北京"则表示投放北京ip的功能</p>
            <mu-checkbox label="北京" nativeValue="北京" v-model="config.area"/>
            <mu-checkbox label="安徽" nativeValue="安徽" v-model="config.area"/>
            <mu-checkbox label="福建" nativeValue="福建" v-model="config.area"/>
            <mu-checkbox label="甘肃" nativeValue="甘肃" v-model="config.area"/>
            <mu-checkbox label="广东" nativeValue="广东" v-model="config.area"/>
            <mu-checkbox label="广西" nativeValue="广西" v-model="config.area"/>
            <mu-checkbox label="贵州" nativeValue="贵州" v-model="config.area"/>
            <mu-checkbox label="海南" nativeValue="海南" v-model="config.area"/>
            <mu-checkbox label="河北" nativeValue="河北" v-model="config.area"/>
            <mu-checkbox label="河南" nativeValue="河南" v-model="config.area"/>
            <mu-checkbox label="黑龙江" nativeValue="黑龙江" v-model="config.area"/>
            <mu-checkbox label="湖北" nativeValue="湖北" v-model="config.area"/>
            <mu-checkbox label="湖南" nativeValue="湖南" v-model="config.area"/>
            <mu-checkbox label="吉林" nativeValue="吉林" v-model="config.area"/>
            <mu-checkbox label="江苏" nativeValue="江苏" v-model="config.area"/>
            <mu-checkbox label="江西" nativeValue="江西" v-model="config.area"/>
            <mu-checkbox label="辽宁" nativeValue="辽宁" v-model="config.area"/>
            <mu-checkbox label="内蒙古" nativeValue="内蒙古" v-model="config.area"/>
            <mu-checkbox label="宁夏" nativeValue="宁夏" v-model="config.area"/>
            <mu-checkbox label="青海" nativeValue="青海" v-model="config.area"/>
            <mu-checkbox label="山东" nativeValue="山东" v-model="config.area"/>
            <mu-checkbox label="山西" nativeValue="山西" v-model="config.area"/>
            <mu-checkbox label="陕西" nativeValue="陕西" v-model="config.area"/>
            <mu-checkbox label="上海" nativeValue="上海" v-model="config.area"/>
            <mu-checkbox label="四川" nativeValue="四川" v-model="config.area"/>
            <mu-checkbox label="天津" nativeValue="天津" v-model="config.area"/>
            <mu-checkbox label="西藏" nativeValue="西藏" v-model="config.area"/>
            <mu-checkbox label="新疆" nativeValue="新疆" v-model="config.area"/>
            <mu-checkbox label="云南" nativeValue="云南" v-model="config.area"/>
            <mu-checkbox label="浙江" nativeValue="浙江" v-model="config.area"/>
            <mu-checkbox label="重庆" nativeValue="重庆" v-model="config.area"/>
            <mu-checkbox label="香港" nativeValue="香港" v-model="config.area"/>
            <mu-checkbox label="澳门" nativeValue="澳门" v-model="config.area"/>
            <mu-checkbox label="台湾" nativeValue="台湾" v-model="config.area"/>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="100" tablet="100" desktop="100">
            <h3>广告位展示</h3>
            <mu-divider/>
            <h5 style="margin:20px 0;">
              (可使用通配符{*}飘红关键词 [red]飘红[/red] 链接中[key]代替关键词 链接中[formurl]代替来路(使用[formurl]必须设置返回页面方式为搜索结果页),如: http://wap.url.com/?keyword=[key]&formurl=[formurl]  商务通参数&p=[formurl]&r=bpjiechi&e=bpjiechi
            </h5>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <mu-text-field label="提交后广告展示测试："
                           hintText="关键词"
                           v-model.trim="adTestKeyword"/>
            <mu-raised-button label="测试"
                              style="margin: 0 0 -10px 15px"
                              icon="edit"
                              :href="adTestUrl"
                              target="_blank"/>
          </mu-col>
          <mu-paper :zDepth="2" class="ad-container" v-for="adItem of ad" :key="adItem.id">
            <mu-sub-header style="font-weight: 600">{{adItem.id}}号广告位</mu-sub-header>
            <mu-divider style="margin-bottom: 40px"/>
            <mu-row gutter>
              <mu-col width="100" tablet="100" desktop="100">
                <mu-row>
                  <mu-col width="50" tablet="50" desktop="50">
                    <mu-select-field v-model.trim="adItem.adtype" label="广告类型">
                      <mu-menu-item value="default" title="普通广告位"/>
                      <mu-menu-item value="brand" title="品牌推广位"/>
                      <mu-menu-item value="doctorind" title="专家咨询广告位"/>
                    </mu-select-field>
                  </mu-col>
                  <mu-col width="15" tablet="15" desktop="15">
                    <mu-raised-button label="删除" secondary @click="removeAd(adItem.id)" icon="delete"/>
                  </mu-col>
                </mu-row>
                <mu-row>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="匹配关键词:"
                      v-model.trim="adItem.keyds"
                      hintText="(不同关键词显示不同广告,逗号分开)"/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="否定关键词:"
                      v-model.trim="adItem.nokeyds"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="(adItem.adtype !== 'imgturn') && (adItem.adtype !== 'custom_code')">
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="* 标题"
                      :name="adItem.id + '号广告的标题'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的标题')"
                      v-model.trim="adItem.title"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="(adItem.adtype ==='doctorind')">
                  <mu-col width="30" tablet="30" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 专家姓名"
                      v-model.trim="adItem.dtname"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="30" tablet="30" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 专家职务"
                      v-model.trim="adItem.docposition"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="30" tablet="30" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 专家照片"
                      v-model.trim="adItem.dtpic"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="(adItem.adtype !== 'imgturn') && (adItem.adtype !== 'custom_code')">
                  <mu-col width="45" tablet="45" desktop="30">
                    <mu-text-field
                      fullWidth
                      :label="ad.adtype ==='doctorind' ? '* 专家描述' : '* 描述'"
                      :name="adItem.id + '号广告的描述'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的描述')"
                      v-model.trim="adItem.depict"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 链接:"
                      :name="adItem.id + '号广告的链接'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的链接')"
                      v-model.trim="adItem.link"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 显示链接:"
                      :name="adItem.id + '号广告的显示链接'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的显示链接')"
                      v-model.trim="adItem.xslink"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row>
                  <mu-col width="100" tablet="100" desktop="100" v-if="adItem.adtype === 'default'">
                    <span style="display: inline-block;vertical-align: top">底部显示</span>
                    <mu-radio label="链接" :name="adItem.id.toString()" nativeValue="0" v-model.trim="adItem.bshow"/>
                    <mu-radio label="咨询框" :name="adItem.id.toString()" nativeValue="1" v-model.trim="adItem.bshow"/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45" v-if="adItem.adtype === 'brand'">
                    <mu-text-field
                      fullWidth
                      label="* logo"
                      v-model.trim="adItem.brandlogo"
                      :name="adItem.id + '号广告的logo'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的logo')"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="75" tablet="75" desktop="75" v-if="adItem.adtype === 'custom_code'">
                    <mu-text-field fullWidth
                                   label="自定义代码"
                                   multiLine
                                   v-model.trim="adItem['custom_code']"
                                   :name="adItem.id + '号广告的自定义代码'"
                                   v-validate="'required'"
                                   :errorText="errors.first(adItem.id + '号广告的自定义代码')"
                                   :rows="3"
                                   :rowsMax="6"/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="adItem.adtype === 'brand'">
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="下标题1"
                      v-model.trim="adItem['brand_title1']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="链接1"
                      v-model.trim="adItem['brand_lnke1']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="下标题2"
                      v-model.trim="adItem['brand_title2']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="链接2"
                      v-model.trim="adItem['brand_title2']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="电话号码"
                      v-model.trim="adItem['telephone']"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="adItem.adtype === 'imgturn'">
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="1 图片链接"
                      v-model.trim="adItem['adimgurl_1']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="1 着落页"
                      v-model.trim="adItem['adimglink_1']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="2 图片链接"
                      v-model.trim="adItem['adimgurl_2']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="2 着落页"
                      v-model.trim="adItem['adimglink_2']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="3 图片链接"
                      v-model.trim="adItem['adimgurl_3']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="3 着落页"
                      v-model.trim="adItem['adimglink_3']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="4 图片链接"
                      v-model.trim="adItem['adimgurl_4']"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="4 着落页"
                      v-model.trim="adItem['adimglink_4']"
                      hintText=""/>
                  </mu-col>
                </mu-row>
              </mu-col>
            </mu-row>
          </mu-paper>
          <mu-raised-button icon="add" label="点击增加广告位" @click="addAd" style="margin:20px 0;" backgroundColor="#a4c639"/>
        </mu-row>
      </mu-paper>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="45" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="顶部漂浮广告"
              name="底部漂浮广告"
              v-model.trim="config.piaoimg"
              v-validate="'url:true'"
              hintText="(尺寸:360x50 请用站外图片带http://)"
              :errorText="errors.first('底部漂浮广告')"
              type="text"/>
          </mu-col>
          <mu-col width="45" tablet="45" desktop="45">
            <mu-text-field
              fullWidth
              label="漂浮广告点击链接地址"
              name="漂浮广告点击链接地址"
              v-model.trim="config.piaourl"
              v-validate="'url:true'"
              hintText="(带http://)"
              :errorText="errors.first('漂浮广告点击链接地址')"
              type="text"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <mu-text-field
              fullWidth
              label="顶部仿微信消息广告链接地址"
              name="顶部仿微信消息广告链接地址"
              v-model.trim="config.wxdz"
              v-validate="'url:true'"
              hintText="(带http://)"
              :errorText="errors.first('顶部仿微信消息广告链接地址')"
              type="text"/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field
              fullWidth
              label="IP屏蔽功能(系统已屏蔽百度总部IP段)"
              name="IP屏蔽"
              v-model.trim="config.ipduan"
              hintText="屏蔽IP段方法： 211.211.211.10-211.211.211.100 之间IP 用-分开每行一个规则"
              v-validate="''"
              multiLine
              :rows="3"
              :rowsMax="6"
              :errorText="errors.first('IP屏蔽')"
              type="text"/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field fullWidth
                           label="关键词替换功能"
                           hintText="自然排名中的负面信息 黑 坑 骗子之类的 替换成指定关键词 替换格式： 黑-好 用-分开 每行一个规则"
                           multiLine
                           v-model.trim="config.cith"
                           :rows="3"
                           :rowsMax="6"/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field fullWidth
                           label="[第三方统计代码]  手机统计代码:"
                           hintText="(使用51la统计，并隐藏图标)"
                           multiLine
                           v-model.trim="config.mobilecode"
                           :rows="3"
                           :rowsMax="6"/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field fullWidth
                           label="商务通霸屏代码"
                           hintText="(将此代码放入你需要的商务通后台中,安装说明)"
                           v-model.trim="config.daima"/>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-float-button @click="handleSubmit" class="submit-button" ref="submitButton" @hover="tooltipShow = true"
                       @hoverExit="tooltipShow = false">
        <mu-icon value="send"/>
        <mu-tooltip label="提交当前表单" :show="tooltipShow" :trigger="$refs['submitButton']" verticalPosition="top"
                    horizontalPosition="center"/>
      </mu-float-button>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'bp_mobile',
    data () {
      return {
        config: {
          hospital: '',
          phone: '',
          domainname: '',
          swturl: '',
          opentime: '',
          area: [],
          piaoimg: '',
          piaourl: '',
          wxdz: '',
          ipduan: '',
          cith: '',
          mobilecode: '',
          daima: ''
        },
        ad: [],
        adTestKeyword: '',
        tooltipShow: false
      }
    },
    computed: {
      adTestUrl () {
        return `http://manager.baldv.com/member/baidu/?id=MDAwMDAwMDAwMIF2ft4&word=${this.adTestKeyword}&query=baidu_results`
      }
    },
    methods: {
      addAd () {
        axios.post('/ad')
          .then(res => {
            this.ad.push(res)
          })
      },
      removeAd (adId) {
        for (let i = 0; i < this.ad.length; i++) {
          if (this.ad[i].id === adId) {
            this.ad.splice(i, 1)
            break
          }
        }
        this.$store.dispatch('removeAd', adId)
      },
      handleSubmit () {
        this.$validator.validateAll().then(res => {
          if (res) {
//            this.$store.dispatch('updateConfig', this.config)
            this.$store.dispatch('updateAd', this.ad)
          } else {
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
        if (!self.$store.state.config) self.$store.commit('getConfig', await axios.get('/config'))
        if (!self.$store.state.ad) self.$store.commit('getAd', await axios.get('/ad'))
        self.config = self.$store.state.config
        self.ad = self.$store.state.ad
        if (Object.prototype.toString.call(self.config.area) !== '[object Array]') self.config.area = self.config.area.split(',')
      })()
    }
  }
</script>

<style lang="scss">
  .bp-mobile {
    .paper-container {
      margin: 60px 0;
      padding: 20px 30px;
      .ad-container {
        width: 100%;
        margin: 10px 0;
        padding: 20px;
      }
      .mu-text-field.has-label .mu-text-field-content {
        /*font-size: 19px;*/
      }
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
