<template>
  <div class="bp-mobile-ad">
    <mu-sub-header>移动霸屏 - 广告位设置</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-paper :zDepth="3" class="paper-container">
        <mu-row gutter>
          <mu-col width="100" tablet="100" desktop="100">
            <h3>广告位展示</h3>
            <mu-divider/>
            <p class="ad-tips">提示: 兼容HTML标签</p>
          </mu-col>
          <mu-paper :zDepth="2" class="ad-container" v-for="adItem of ad" :key="adItem.id">
            <mu-sub-header style="font-weight: 600">{{adItem.id}}号广告位</mu-sub-header>
            <mu-divider style="margin-bottom: 40px"/>
            <mu-row gutter>
              <mu-col width="100" tablet="100" desktop="100">
                <mu-row>
                  <mu-col width="50" tablet="50" desktop="50">
                    <mu-select-field v-model.trim="adItem.type" label="广告类型">
                      <mu-menu-item value="default" title="普通广告位"/>
                      <mu-menu-item value="brand" title="品牌推广位"/>
                      <mu-menu-item value="doctor" title="专家咨询广告位"/>
                    </mu-select-field>
                  </mu-col>
                  <mu-col width="15" tablet="15" desktop="15">
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
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="广告图片"
                      :name="adItem.id + '号广告的广告图片'"
                      v-validate="'url'"
                      :errorText="errors.first(adItem.id + '号广告的广告图片')"
                      v-model.trim="adItem.picture"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="(adItem.type ==='doctor')">
                  <mu-col width="30" tablet="30" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 专家姓名"
                      v-model.trim="adItem.doctor_name"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="30" tablet="30" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 专家职务"
                      v-model.trim="adItem.doctor_job"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="30" tablet="30" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 专家照片"
                      v-model.trim="adItem.doctor_pic"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row>
                  <mu-col width="100" tablet="45" desktop="30">
                    <mu-text-field
                      fullWidth
                      :label="adItem.type ==='doctor' ? '* 专家描述' : '* 描述'"
                      :name="adItem.id + '号广告的描述'"
                      v-validate="'required'"
                      :errorText="errors.first(adItem.id + '号广告的描述')"
                      v-model.trim="adItem.description"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 链接:"
                      :name="adItem.id + '号广告的链接'"
                      v-validate="'required|url'"
                      :errorText="errors.first(adItem.id + '号广告的链接')"
                      v-model.trim="adItem.link"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" desktop="30">
                    <mu-text-field
                      fullWidth
                      label="* 显示链接:"
                      :name="adItem.id + '号广告的显示链接'"
                      v-validate="'required|url'"
                      :errorText="errors.first(adItem.id + '号广告的显示链接')"
                      v-model.trim="adItem.show_link"
                      hintText=""/>
                  </mu-col>
                </mu-row>
                <mu-row v-if="adItem.type === 'brand'">
                  <mu-col width="100" tablet="100" desktop="100">
                    <mu-text-field
                      fullWidth
                      label="下标题链接"
                      v-model.trim="adItem.brand_link"
                      :name="adItem.id + '号广告的下标题链接'"
                      v-validate="'url'"
                      :errorText="errors.first(adItem.id + '号广告的下标题链接')"
                      hintText=""/>
                  </mu-col>
                  <mu-col width="100" tablet="45" desktop="45">
                    <mu-text-field
                      fullWidth
                      label="下标题1"
                      v-model.trim="adItem.brand_title1"
                      hintText=""/>
                  </mu-col>
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
                      label="下标题2"
                      v-model.trim="adItem.brand_title2"
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
          <mu-raised-button icon="add" label="点击增加广告位" @click="addAd" style="margin:20px 0;" backgroundColor="#19a15f"/>
        </mu-row>
      </mu-paper>
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
        tooltipShow: false
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
        if (!self.$store.state.ad) self.$store.commit('getAd', await axios.get('/ad'))
        self.ad = self.$store.state.ad
      })()
    }
  }
</script>

<style lang="scss">
  .bp-mobile-ad {
    .paper-container {
      margin: 60px 0;
      padding: 20px 30px;
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
