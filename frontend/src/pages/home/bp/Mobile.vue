<template>
  <div class="bp-mobile">
    <mu-sub-header>移动霸屏</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field fullWidth label="公司名称:" v-model="hospital"/>
          </mu-col>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field fullWidth label="电话:" v-model="phone"/>
          </mu-col>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field fullWidth label="手机站 域名绑定:" v-model="domainname"/>
          </mu-col>
          <mu-col width="30" tablet="30" desktop="30">
            <mu-text-field fullWidth label="广告链接:" v-model="swturl"/>
          </mu-col>
          <mu-col width="65" tablet="65" desktop="65">
            <mu-text-field fullWidth label="开启时段:" hintText=" (为空默认全天,填写方式 按小时以逗号分开如：00,01,08,09,10,11,12,23)"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <p>投放地区:</p>
            <p>勾选即为投放，如：勾选"北京"则表示投放北京ip的功能，支持多选(全部不选为全国投放)。</p>
            <mu-checkbox label="北京" nativeValue="北京" v-model="area"/>
            <mu-checkbox label="安徽" nativeValue="安徽" v-model="area"/>
            <mu-checkbox label="福建" nativeValue="福建" v-model="area"/>
            <mu-checkbox label="甘肃" nativeValue="甘肃" v-model="area"/>
            <mu-checkbox label="广东" nativeValue="广东" v-model="area"/>
            <mu-checkbox label="广西" nativeValue="广西" v-model="area"/>
            <mu-checkbox label="贵州" nativeValue="贵州" v-model="area"/>
            <mu-checkbox label="海南" nativeValue="海南" v-model="area"/>
            <mu-checkbox label="河北" nativeValue="河北" v-model="area"/>
            <mu-checkbox label="河南" nativeValue="河南" v-model="area"/>
            <mu-checkbox label="黑龙江" nativeValue="黑龙江" v-model="area"/>
            <mu-checkbox label="湖北" nativeValue="湖北" v-model="area"/>
            <mu-checkbox label="湖南" nativeValue="湖南" v-model="area"/>
            <mu-checkbox label="吉林" nativeValue="吉林" v-model="area"/>
            <mu-checkbox label="江苏" nativeValue="江苏" v-model="area"/>
            <mu-checkbox label="江西" nativeValue="江西" v-model="area"/>
            <mu-checkbox label="辽宁" nativeValue="辽宁" v-model="area"/>
            <mu-checkbox label="内蒙古" nativeValue="内蒙古" v-model="area"/>
            <mu-checkbox label="宁夏" nativeValue="宁夏" v-model="area"/>
            <mu-checkbox label="青海" nativeValue="青海" v-model="area"/>
            <mu-checkbox label="山东" nativeValue="山东" v-model="area"/>
            <mu-checkbox label="山西" nativeValue="山西" v-model="area"/>
            <mu-checkbox label="陕西" nativeValue="陕西" v-model="area"/>
            <mu-checkbox label="上海" nativeValue="上海" v-model="area"/>
            <mu-checkbox label="四川" nativeValue="四川" v-model="area"/>
            <mu-checkbox label="天津" nativeValue="天津" v-model="area"/>
            <mu-checkbox label="西藏" nativeValue="西藏" v-model="area"/>
            <mu-checkbox label="新疆" nativeValue="新疆" v-model="area"/>
            <mu-checkbox label="云南" nativeValue="云南" v-model="area"/>
            <mu-checkbox label="浙江" nativeValue="浙江" v-model="area"/>
            <mu-checkbox label="重庆" nativeValue="重庆" v-model="area"/>
            <mu-checkbox label="香港" nativeValue="香港" v-model="area"/>
            <mu-checkbox label="澳门" nativeValue="澳门" v-model="area"/>
            <mu-checkbox label="台湾" nativeValue="台湾" v-model="area"/>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="100" tablet="100" desktop="100">
            <h3>广告位展示</h3>
            <h5 style="margin:0;">
              (可使用通配符{*}飘红关键词 [red]飘红[/red] 链接中[key]代替关键词 链接中[formurl]代替来路(使用[formurl]必须设置返回页面方式为搜索结果页),如: http://wap.url.com/?keyword=[key]&formurl=[formurl]  商务通参数&p=[formurl]&r=bpjiechi&e=bpjiechi</h5>
            <mu-raised-button icon="add" label="点击增加广告位" @click="adItemLength++" style="margin:20px 0;"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <mu-text-field label="提交后广告展示测试：" hintText="关键词"/>
            <mu-raised-button label="测试" style="margin-left:15px;"/>
          </mu-col>
          <mu-paper :zDepth="2" class="ad-container">
            <mu-row gutter>
              <mu-col width="100" tablet="100" desktop="100">
                <mu-select-field v-model="game2" label="选择多个">
                  <mu-menu-item value="2" title="普通广告位"/>
                  <mu-menu-item value="3" title="品牌推广位"/>
                  <mu-menu-item value="4" title="图片轮翻"/>
                  <mu-menu-item value="5" title="专家咨询广告位"/>
                  <mu-menu-item value="6" title="自定义代码"/>
                </mu-select-field>
              </mu-col>
              <mu-col width="100" tablet="100" desktop="100">
                <mu-row gutter>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field fullWidth label="匹配关键词:" hintText="(不同关键词显示不同广告,逗号分开)"/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field fullWidth label="否定关键词:" hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field fullWidth label="*标题:" hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field fullWidth label="*描述:" hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field fullWidth label="*链接:" hintText=""/>
                  </mu-col>
                  <mu-col width="45" tablet="45" desktop="45">
                    <mu-text-field fullWidth label="*显示链接:" hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="100" desktop="100">
                    <span style="display: inline-block;vertical-align: top">底部显示：</span>
                    <mu-radio label="链接" name="group" nativeValue="simple1" v-model="value" class="demo-radio"/>
                    <mu-radio label="咨询框" name="group" nativeValue="simple1" v-model="value" class="demo-radio"/>
                  </mu-col>
                </mu-row>
              </mu-col>
            </mu-row>
          </mu-paper>
        </mu-row>
      </mu-paper>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="45" tablet="45" desktop="45">
            <mu-text-field fullWidth label="底部漂浮广告:" hintText="(尺寸:360x50 请用站外图片带http://)" v-model="piaoimg"/>
          </mu-col>
          <mu-col width="45" tablet="45" desktop="45">
            <mu-text-field fullWidth label="漂浮广告点击链接地址:" hintText="(带http://)" v-model="piaourl"/>
          </mu-col>
          <mu-col width="100" tablet="100" desktop="100">
            <mu-text-field fullWidth label="顶部仿微信消息广告链接地址:" hintText="(带http://)" v-model="wxdz"/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field label="IP屏蔽功能(系统已屏蔽百度总部IP段)"
                           hintText="屏蔽IP段方法： 211.211.211.10-211.211.211.100 之间IP 用-分开每行一个规则"
                           multiLine
                           v-model="ipduan"
                           :rows="3"
                           :rowsMax="6"
                           fullWidth/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field label="关键词替换功能"
                           hintText="自然排名中的负面信息 黑 坑 骗子之类的 替换成指定关键词 替换格式： 黑-好 用-分开 每行一个规则"
                           multiLine
                           v-model="cith"
                           :rows="3"
                           :rowsMax="6"
                           fullWidth/>
          </mu-col>
          <mu-col width="75" tablet="75" desktop="75">
            <mu-text-field label="[第三方统计代码]  手机统计代码:"
                           hintText="(使用51la统计，并隐藏图标)"
                           multiLine
                           v-model="mobilecode"
                           :rows="3"
                           :rowsMax="6"
                           fullWidth/>
          </mu-col>
          <mu-col width="50" tablet="50" desktop="50">
            <mu-text-field fullWidth
                           label="商务通霸屏代码:"
                           hintText="(将此代码放入你需要的商务通后台中,安装说明)"
                           v-model="daima"/>
          </mu-col>
        </mu-row>
      </mu-paper>
      <mu-raised-button primary label="提交" fullWidth/>
    </mu-content-block>
  </div>
</template>

<script>
  export default {
    name: 'bp_mobile',
    data () {
      return {
        hospital: '',
        phone: '',
        domainname: '',
        swturl: '',
        area: ['北京', '浙江'],
        piaoimg: '',
        piaourl: '',
        wxdz: '',
        ipduan: '',
        cith: '',
        mobilecode: '',
        daima: '',
        adItemLength: 1
      }
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
  }
</style>
