<template>
  <div class="log">
    <mu-sub-header>系统管理 - 访问日志</mu-sub-header>
    <mu-divider/>
    <mu-content-block>
      <mu-row>
        <mu-col width="100" tablet="100" desktop="100">
          <mu-table ref="table" :showCheckbox="false" :enableSelectAll="false" :multiSelectable="false">
            <mu-thead>
              <mu-tr>
                <mu-th>ID</mu-th>
                <mu-th>关键词</mu-th>
                <mu-th>渠道</mu-th>
                <mu-th>来源页</mu-th>
                <mu-th>IP</mu-th>
                <mu-th>地理位置</mu-th>
                <mu-th>访问时间</mu-th>
              </mu-tr>
            </mu-thead>
            <mu-tbody>
              <mu-tr v-for="log of logData" :key="log.id">
                <mu-td>{{log.id}}</mu-td>
                <mu-td>{{log.keyword}}</mu-td>
                <mu-td>{{log.channel}}</mu-td>
                <mu-td class="sourceurl">{{log.sourceurl}}</mu-td>
                <mu-td>{{log.ip}}</mu-td>
                <mu-td><a :href="log.geography" target="_blank">查询IP</a></mu-td>
                <mu-td>{{log.created_at}}</mu-td>
              </mu-tr>
            </mu-tbody>
          </mu-table>
        </mu-col>
      </mu-row>
      <mu-pagination :total="page.total" :current="page.current"
                     @pageChange="changePage" :pageSize="30"></mu-pagination>
    </mu-content-block>
  </div>
</template>

<script>
  import axios from '@/config/axios'

  export default {
    name: 'log',
    data () {
      return {
        logs: null
      }
    },
    computed: {
      page () {
        return this.logs ? {
          total: this.logs.total,
          current: this.logs.current_page,
          pageSize: this.logs.per_page
        } : {
          total: 1,
          current: 1
        }
      },
      logData () {
        return this.logs ? this.logs.data : []
      }
    },
    methods: {
      getPage (pageIndex) {
        this.selectedRowsIndex = []
        axios.get(`/log?page=${pageIndex}`)
          .then(logs => {
            logs.data.forEach(log => {
              log.geography = `http://www.baidu.com/s?wd=${log.ip}`
            })
            this.logs = logs
          })
      },
      changePage (newIndex) {
        this.getPage(newIndex)
      }
    },
    mounted () {
      this.getPage(1)
    }
  }
</script>

<style lang="scss">
  .log {
    .mu-table {
      .mu-thead {
        .mu-tr {
          .mu-th:nth-child(1) {
            width: 5%;
          }
          .mu-th:nth-child(2) {
            width: 15%;
          }
          .mu-th:nth-child(4) {
            width: 35%;
          }
          .mu-th:nth-child(6) {
            width: 8%;
          }
        }
      }
      tbody{
        .mu-td:nth-child(4){
          white-space: normal;
        }
      }
    }
  }
</style>
