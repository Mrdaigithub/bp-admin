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
              <span class="pull-right">{{yesterdayData.sogou}}</span>
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
                  <mu-td>今日</mu-td>
                  <mu-td v-for="i of tableData.today" :key="i">{{i}}</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>昨日</mu-td>
                  <mu-td v-for="i of tableData.yesterday" :key="i">{{i}}</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>本月</mu-td>
                  <mu-td v-for="i of tableData.currentMonth" :key="i">{{i}}</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>上月</mu-td>
                  <mu-td v-for="i of tableData.lastMonth" :key="i">{{i}}</mu-td>
                </mu-tr>
                <mu-tr>
                  <mu-td>环比增长率</mu-td>
                  <mu-td v-for="i of tableData.mom" :key="i">{{i}}</mu-td>
                </mu-tr>
              </mu-tbody>
            </mu-table>
          </mu-paper>
        </mu-col>
      </mu-row>
      <mu-row class="chart-box" gutter>
        <mu-col width="100" tablet="50" desktop="50">
          <mu-paper id="roundChart" :zDepth="1">
            <ve-pie :data="roundChartData" :settings="roundChartSettings" :title="roundChartSettings.title"></ve-pie>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="50">
          <mu-paper id="lineChart" :zDepth="1">
            <ve-line :data="lineChartData" :settings="lineChartSettings" :title="lineChartSettings.title"></ve-line>
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
        yesterdayData: {baidu: 0, sogou: 0, 360: 0, sm: 0},
        monthData: {baidu: [], sogou: [], 360: [], sm: []},
        roundChartData: {
          columns: ['百度', '搜狗', '360', '神马'],
          rows: []
        },
        roundChartSettings: {
          title: {
            text: '近30天占比',
            textStyle: {
              fontWeight: 'normal'
            },
            padding: [0, 0, 0, 20]
          },
          dimension: 'searchEngine',
          metrics: 'value',
          selectedMode: 'single',
          hoverAnimation: true,
          radius: 150,
          offsetY: 230
        },
        lineChartData: {
          columns: ['date', '百度', '搜狗', '360', '神马'],
          rows: []
        },
        lineChartSettings: {
          title: {
            text: '近30天趋势',
            textStyle: {
              fontWeight: 'normal'
            },
            padding: [0, 0, 0, 20]
          },
          dimension: ['date'],
          metrics: ['百度', '搜狗', '360', '神马'],
          area: true
        },
        tableData: {
          today: [0, 0, 0, 0],
          yesterday: [0, 0, 0, 0],
          lastMonth: [0, 0, 0, 0],
          currentMonth: [0, 0, 0, 0],
          mom: ['0%', '0%', '0%', '0%']
        }
      }
    },
    methods: {
      mergeMonthData (sourceData) {
        let res = [
          {'searchEngine': '百度', 'value': 0},
          {'searchEngine': '搜狗', 'value': 0},
          {'searchEngine': '360', 'value': 0},
          {'searchEngine': '神马', 'value': 0}
        ]
        sourceData.forEach(item => {
          res[0].value += item['百度']
          res[1].value += item['搜狗']
          res[2].value += item['360']
          res[3].value += item['神马']
        })
        return res
      }
    },
    mounted () {
      let self = this
      !(async function () {
        [
          self.yesterdayData,
          self.lineChartData.rows,
          self.tableData
        ] = await Promise.all([
          axios.get('dashboard/yesterday'),
          axios.get('dashboard/month'),
          axios.get('dashboard/table')
        ])
        self.roundChartData.rows = self.mergeMonthData(self.lineChartData.rows)
      })()
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
