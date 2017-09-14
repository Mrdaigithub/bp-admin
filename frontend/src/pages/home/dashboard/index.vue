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
              <span class="pull-right">3</span>
            </div>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>搜狗昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">搜</i>
              <span class="pull-right">300</span>
            </div>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>360昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">3</i>
              <span class="pull-right">300</span>
            </div>
          </mu-paper>
        </mu-col>
        <mu-col width="100" tablet="50" desktop="25" class="yesterday-box-item">
          <mu-paper class="yesterday-box-item-paper" :zDepth="1">
            <h4>神马昨日访问人数</h4>
            <div class="clearfix">
              <i class="icon pull-left">神</i>
              <span class="pull-right">300</span>
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
  //  import axios from '@/config/axios'

  export default {
    name: 'dashboard',
    data () {
      return {
        roundChartData: {
          columns: ['日期', '销售额-1季度', '销售额-2季度', '占比', '其他'],
          rows: [
            {'日期': '1月1日', '销售额-1季度': 1523, '销售额-2季度': 1523, '占比': 0.12, '其他': 100},
            {'日期': '1月2日', '销售额-1季度': 1223, '销售额-2季度': 1523, '占比': 0.345, '其他': 100},
            {'日期': '1月3日', '销售额-1季度': 2123, '销售额-2季度': 1523, '占比': 0.7, '其他': 100},
            {'日期': '1月4日', '销售额-1季度': 4123, '销售额-2季度': 1523, '占比': 0.31, '其他': 100},
            {'日期': '1月5日', '销售额-1季度': 3123, '销售额-2季度': 1523, '占比': 0.12, '其他': 100},
            {'日期': '1月6日', '销售额-1季度': 7123, '销售额-2季度': 1523, '占比': 0.65, '其他': 100}
          ]
        },
        roundChartSettings: {
          dimension: '日期',
          metrics: '销售额-1季度',
          dataType: 'KMB',
          selectedMode: 'single',
          hoverAnimation: false,
          radius: 100,
          offsetY: 200
        },
        lineChartData: {
          columns: ['日期', '销售额-1季度', '销售额-2季度', '占比', '其他'],
          rows: [
            {'日期': '1月1日', '销售额-1季度': 1523, '销售额-2季度': 1523, '占比': 0.12, '其他': 100},
            {'日期': '1月2日', '销售额-1季度': 1223, '销售额-2季度': 1523, '占比': 0.345, '其他': 100},
            {'日期': '1月3日', '销售额-1季度': 2123, '销售额-2季度': 1523, '占比': 0.7, '其他': 100},
            {'日期': '1月4日', '销售额-1季度': 4123, '销售额-2季度': 1523, '占比': 0.31, '其他': 100},
            {'日期': '1月5日', '销售额-1季度': 3123, '销售额-2季度': 1523, '占比': 0.12, '其他': 100},
            {'日期': '1月6日', '销售额-1季度': 7123, '销售额-2季度': 1523, '占比': 0.65, '其他': 100}
          ]
        },
        lineChartSettings: {
          dimension: ['日期'],
          metrics: ['销售额-1季度', '销售额-2季度', '占比'],
          axisSite: {
            right: ['占比']
          },
          yAxisType: ['KMB', 'percent'],
          yAxisName: ['销售额', '占比'],
          area: true,
          stack: {
            '销售额': ['销售额-1季度', '销售额-2季度']
          }
        }
      }
    },
    computed: {},
    methods: {},
    mounted () {
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
      #roundChart, #lineChart{
        padding:20px 0;
      }
    }
    .table-box {
      margin-top: 30px;
    }
  }
</style>
