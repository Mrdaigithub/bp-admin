<template>
  <div class="bp-mobile-ad">
    <mu-sub-header>移动霸屏 - 广告位设置</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <div class="paper-container">
        <mu-row gutter>
          <mu-col width="100" tablet="50" desktop="50">
            <p class="ad-tips">提示: 兼容HTML标签 &lt;em&gt;&lt;/em&gt;标签飘红</p>
          </mu-col>
          <mu-col width="100" tablet="30" desktop="30">
            <mu-text-field v-model="previewKeyword"
                           hintText="键入关键词回车预览"
                           @keyup.native.enter="handlerPreview"
                           fullWidth/>
          </mu-col>
          <mu-paper :zDepth="2" class="ad-container" v-for="(adItem, index) of ad" :key="adItem.id">
            <mu-row gutter>
              <mu-col width="100" tablet="50" desktop="50">
                <mu-sub-header style="font-weight: 600">{{adItem.id}}号广告位</mu-sub-header>
              </mu-col>
              <mu-col width="100" tablet="20" desktop="10">
                <mu-icon-button
                  icon="vertical_align_top"
                  :disabled="index===0"
                  @click="toTop(index)"/>
                <mu-icon-button
                  icon="vertical_align_bottom"
                  :disabled="index===ad.length-1"
                  @click="toBottom(index)"/>
              </mu-col>
            </mu-row>
            <mu-divider style="margin-bottom: 40px"/>
            <mu-row gutter>
              <mu-col width="100" tablet="100" desktop="100">
                <mu-row>
                  <mu-col width="100" tablet="50" desktop="50">
                    <mu-select-field v-model.trim="adItem.type" label="广告类型">
                      <mu-menu-item value="default" title="普通广告位 (带图片)"/>
                      <mu-menu-item value="defaulttext" title="普通广告位 (纯文字)"/>
                      <mu-menu-item value="brand" title="品牌推广位"/>
                      <mu-menu-item value="doctor" title="专家咨询广告位"/>
                    </mu-select-field>
                  </mu-col>
                  <mu-col width="50" tablet="25" desktop="10">
                    <mu-raised-button label="删除" @click="removeAd(adItem.id)" icon="delete" backgroundColor="#dd5044"/>
                  </mu-col>
                </mu-row>
                <mu-row>
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="* 标题"
                      :name="adItem.id + '号广告的标题'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的标题')"
                      v-model.trim="adItem.title"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" desktop="45" v-if="adItem.type !=='defaulttext'">
                    <mu-text-field
                      fullWidth
                      :label="adItem.type === 'doctor' ? '专家照片' : '广告图片'"
                      :name="adItem.id + '号广告的图片'"
                      v-validate="'url'"
                      :errorText="errors.first(adItem.id + '号广告的图片')"
                      v-model.trim="adItem.picture"
                      hintText="图片尺寸: 200*200"/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="(adItem.type ==='doctor')">
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="* 专家姓名"
                      v-model.trim="adItem.doctor_name"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="* 专家职务"
                      v-model.trim="adItem.doctor_job"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row>
                  <mu-col width="100" tablet="45" desktop="30" v-if="adItem.type !=='brand'">
                    <mu-text-field
                      fullWidth
                      :label="adItem.type ==='doctor' ? '* 专家描述' : '* 描述'"
                      :name="adItem.id + '号广告的描述'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的描述')"
                      v-model.trim="adItem.description"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" :desktop="adItem.type ==='brand' ? '45' : '30'">
                    <mu-text-field
                      fullWidth
                      label="* 链接:"
                      :name="adItem.id + '号广告的链接'"
                      v-validate="'required|url'"
                      :errorText="errors.first(adItem.id + '号广告的链接')"
                      v-model.trim="adItem.link"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" :desktop="adItem.type ==='brand' ? '45' : '30'">
                    <mu-text-field
                      fullWidth
                      label="* 显示链接:"
                      :name="adItem.id + '号广告的显示链接'"
                      v-validate="''"
                      :errorText="errors.first(adItem.id + '号广告的显示链接')"
                      v-model.trim="adItem.show_link"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="adItem.type === 'brand'">
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="下标题描述1"
                      v-model.trim="adItem.brand_description1"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="下标题描述2"
                      v-model.trim="adItem.brand_description2"
                      hintText=""/>
                  </mu-col>
                </mu-row>
              </mu-col>
            </mu-row>
          </mu-paper>
          <mu-col width="100" tablet="100" desktop="100">
            <mu-raised-button icon="add" primary label="点击增加广告位" @click="addAd" style="margin:20px 0;"/>
          </mu-col>
        </mu-row>
      </div>
      <mu-float-button @click="handleSubmit" class="submit-button" ref="submitButton" @hover="tooltipShow = true"
                       @hoverExit="tooltipShow = false">
        <mu-icon value="cloud_upload"/>
        <mu-tooltip label="提交当前表单" :show="tooltipShow" :trigger="$refs['submitButton']" verticalPosition="top"
                    horizontalPosition="center"/>
      </mu-float-button>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'bpMobileAd',
    data () {
      return {
        ad: [],
        idList: [],
        tooltipShow: false,
        previewKeyword: ''
      }
    },
    methods: {
      addAd () {
        axios.post('/ad')
          .then(res => {
            this.ad.push(res)
            this.$toast('添加成功', {
              horizontalPosition: 'center',
              duration: 1000
            })
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
            this.ad = this.ad.map((ad, index) => {
              ad.id = this.idList[index]
              return ad
            })
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
      },
      handlerPreview () {
        if (!this.previewKeyword) return
        window.open(`${this.$store.state.configs.fronturl}/?uid=${this.$store.state.oneself.uid}&word=${this.previewKeyword}&mykey=${this.$store.state.configs.hospital}&sourceurl=后台预览&flag=1`)
        this.previewKeyword = ''
      },
      toTop (index) {
        let tmp = this.ad[index - 1]
        this.ad.splice(index - 1, 1, this.ad[index])
        this.ad.splice(index, 1, tmp)
      },
      toBottom (index) {
        let tmp = this.ad[index + 1]
        this.ad.splice(index + 1, 1, this.ad[index])
        this.ad.splice(index, 1, tmp)
      }
    },
    mounted () {
      let self = this
      !(async function () {
        if (!self.$store.state.configs) self.$store.commit('getConfig', await axios.get('/config'))
        if (!self.$store.state.ad) self.$store.commit('getAd', await axios.get('/ad'))
        self.ad = self.$store.state.ad
        self.idList = self.ad.map(ad => ad.id)
      })()
    }
  }
</script>

<style lang="scss">
  .bp-mobile-ad {
    .paper-container {
      margin: 20px 0;
      .ad-tips {
        color: #db4639;
        font-size: 15px;
        margin-bottom: 20px;
        font-weight: bold;
      }
      .ad-container {
        width: 100%;
        margin: 10px 0;
        padding: 20px;
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
