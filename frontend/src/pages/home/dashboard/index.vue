<template>
  <div class="dashboard">
    <mu-sub-header>仪表盘</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-row class="yesterday-box" gutter>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>百度昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">百</i>
              <span class="pull-right">{{yesterdayData.baidu}}</span>
            </div>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>搜狗昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">搜</i>
              <span class="pull-right">{{yesterdayData.sougou}}</span>
            </div>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>360昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">3</i>
              <span class="pull-right">{{yesterdayData['360']}}</span>
            </div>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>神马昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">神</i>
              <span class="pull-right">{{yesterdayData.sm}}</span>
            </div>
          </mu-paper>
        </mu-col>
      </mu-row>
      <mu-row class="chart-box" gutter>
        <mu-col width="100" tablet="50" desktop="50">
          <mu-paper id="roundChart" :zDepth="1">
            <ve-pie :data="roundChartData" :settings="roundChartSettings"></ve-pie>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="50">
          <mu-paper id="lineChart" :zDepth="1">
            <ve-line :data="lineChartData" :settings="lineChartSettings"></ve-line>
          </mu-paper>
        </mu-col>
      </mu-row>
      <mu-row class="table-box" gutter>
        <mu-col width="100" tablet="100" desktop="100">
          <mu-paper :zDepth="1">
            <mu-table :selectable="false" :showCheckbox="false" ref="table">
              <mu-thead>
                <mu-tr>
                  <mu-th>日期</mu-th>
                  <mu-th>百度</mu-th>
                  <mu-th>搜狗</mu-th>
                  <mu-th>360</mu-th>
                  <mu-th>神马</mu-th>
                </mu-tr>
              </mu-thead>
              <mu-tbody>
                <mu-tr>
                  <mu-td>1</mu-td>
                  <mu-td>John Smith</mu-td>
                  <mu-td>Employed</mu-td>
                  <mu-td>Employed</mu-td>
                  <mu-td>Employed</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>2</mu-td>
                  <mu-td>Randal White</mu-td>
                  <mu-td>Unemployed</mu-td>
                  <mu-td>Unemployed</mu-td>
                  <mu-td>Unemployed</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>3</mu-td>
                  <mu-td>Stephanie Sanders</mu-td>
                  <mu-td>Employed</mu-td>
                  <mu-td>Employed</mu-td>
                  <mu-td>Employed</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>4</mu-td>
                  <mu-td>Steve Brown</mu-td>
                  <mu-td>Employed</mu-td>
                  <mu-td>Employed</mu-td>
                  <mu-td>Employed</mu-td>
                </mu-tr>
              </mu-tbody>
            </mu-table>
          </mu-paper>
        </mu-col>
      </mu-row>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'dashboard',
    data () {
      return {
        yesterdayData: {baidu: [], sougou: [], 360: [], sm: []},
        monthData: {baidu: [], sougou: [], 360: [], sm: []},
        roundChartData: {
          columns: ['百度', '搜狗', '360', '神马'],
          rows: [
            {'searchEngine': '百度', 'value': 1523},
            {'searchEngine': '搜狗', 'value': 1223},
            {'searchEngine': '360', 'value': 2123},
            {'searchEngine': '神马', 'value': 4123}
          ]
        },
        roundChartSettings: {
          dimension: 'searchEngine',
          metrics: 'value',
          selectedMode: 'single',
          hoverAnimation: true,
          radius: 150,
          offsetY: 230
        },
        lineChartData: {
          columns: ['日期', '百度', '搜狗', '360', '神马'],
          rows: [
            {'日期': '08-01', '百度': 1523, '搜狗': 1523, '360': 0.12, '神马': 1000},
            {'日期': '08-02', '百度': 1223, '搜狗': 1523, '360': 0.345, '神马': 1000},
            {'日期': '08-03', '百度': 2123, '搜狗': 1523, '360': 0.7, '神马': 1000},
            {'日期': '08-04', '百度': 4123, '搜狗': 1523, '360': 0.31, '神马': 10000},
            {'日期': '08-05', '百度': 3123, '搜狗': 1523, '360': 0.12, '神马': 1000},
            {'日期': '08-06', '百度': 7123, '搜狗': 1523, '360': 0.65, '神马': 1000}
          ]
        },
        lineChartSettings: {
          dimension: ['日期'],
          metrics: ['百度', '搜狗', '360', '神马'],
          area: true
        }
      }
    },
    computed: {},
    methods: {},
    mounted () {
      axios.get('dashboard/yesterday')
        .then(res => {
          this.yesterdayData = res
        })
    }
  }
</script>

<style lang="scss">
  .dashboard {
    .yesterday-box {
      margin-top: 25px;
      .yesterday-box-item {
        .yesterday-box-item-paper {
          padding: 15px 25px;
          h4 {
            font-size: 14px;
            font-weight: 300;
          }
          span {
            font-size: 36px;
            font-weight: 600;
          }
          .icon {
            display: inline-block;
            vertical-align: middle;
            text-align: center;
            font-style: normal;
            width: 66px;
            height: 66px;
            line-height: 66px;
            box-sizing: border-box;
            border-radius: 5000px;
            font-size: 28px;
            color: #fff;
          }
        }
      }
      .yesterday-box-item:nth-child(1) {
        .icon {
          background-color: #fb9678;
        }
      }
      .yesterday-box-item:nth-child(2) {
        .icon {
          background-color: #03a9f3;
        }
      }
      .yesterday-box-item:nth-child(3) {
        .icon {
          background-color: #00c292;
        }
      }
      .yesterday-box-item:nth-child(4) {
        .icon {
          background-color: #4c5667;
        }
      }
    }
    .chart-box {
      margin-top: 30px;
      #roundChart, #lineChart {
        padding: 20px 0;
      }
    }
    .table-box {
      margin-top: 30px;
    }
  }
</style>
