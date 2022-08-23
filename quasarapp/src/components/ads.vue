<template>
  <div>
    <q-table
      grid
      ref="table"
      :rows="rows"
      :columns="columns"
      row-key="id"
      :filter="filter"
      hide-header
      hide-pagination
      :pagination="{
        rowsPerPage: pagination.rowsPerPage
      }"

    >
      <template v-slot:top-left>
        <div class="q-py-md">
          <q-btn @click="$router.push('/ad/create')" no-caps label="Создать" color="primary" flat size="sm"></q-btn>
        </div>

      </template>
      <template v-slot:top-right>
        <div class=" q-py-md flex flex-inline justify-end q-gutter-x-xs" style="align-content: center">
          <span class="q-px-xs">Сортировка:</span>

          <div v-for="(sort,index) in sorts" :key="index" class="text-caption cursor-pointer"
                @click="sort.descending = !sort.descending, pagination.sortBy = sort.sortBy, pagination.descending = !sort.descending">
            <div :class="currentSort.sortBy === sort.sortBy ? 'text-primary':''">
               {{sort.label}}
            <q-icon size="xs" :name="sort.descending ? 'arrow_drop_down':'arrow_drop_up'"></q-icon>
            </div>

          </div>


        </div>
      </template>

      <template v-slot:item="props">
        <div class="q-pa-xs col-xs-12 col-sm-12 col-md-6">
          <q-card class="my-card cursor-pointer" @click="$router.push({path:'/ad', query:{id:props.row.id}})">
            <q-img :src="props.row.preview?.url" alt="image" ratio="1.5"

            >
              <div class="absolute-bottom text-body1">
                {{ props.row.price }} руб.
              </div>
            </q-img>

            <q-card-section>
              <q-item-label lines="3">
                {{ props.row.name }}
              </q-item-label>
            </q-card-section>
          </q-card>


        </div>
      </template>
    </q-table>
    <div class="q-pa-lg flex flex-center">
      <q-pagination
        v-model="pagination.page"
        color="grey-8"
        :max="maxPage"
        :max-pages="6"
        size="sm"
      />
    </div>
  </div>
</template>

<script>
import {api_view_ads} from "src/router/API";
import {api} from "boot/axios";

export default {
  name: "ads",
  data: () => {
    return {
      sorts: [
        {
          label: 'Дата',
          sortBy: 'created_at',
          descending: false
        },
        {
          label: 'Цена',
          sortBy: 'price',
          descending: false
        }
      ],
      pagination: {
        sortBy: 'created_at',
        descending: false,
        page: 1,
        rowsPerPage: 10
      },
      filter: '',
      response: null

    }
  },
  watch:{
    paginatorHash(){
      this.getAds()
      this.scrollToTop()
    }
  },
  computed: {
    paginatorHash(){
      return JSON.stringify(this.pagination)
    },
    maxPage(){
      return this.response && this.response.meta.last_page || 0
    },
    currentSort() {
      return {
        sortBy: this.pagination.sortBy,
        desc: this.pagination.descending,
      };
    },
    columns() {
      return [
        {name: 'name', label: 'Название', field: 'name'},
        {name: 'price', label: 'Цена', field: 'price',},
        {name: 'img', label: 'Фотография', field: row => row.preview?.url || null},
      ]
    },
    rows() {
      return Object.values(this.response?.data || {})
    },
  },
  methods: {
    scrollToTop(){
      this.$refs.table.$el.scrollIntoView({ behavior: 'smooth', block: 'start', inline: 'nearest' })
    },
    getAds() {
      api(Object.assign(api_view_ads, {
        params: {
          page: this.pagination?.page,
          sortBy: this.pagination?.sortBy,
          descending: this.pagination?.descending ? 1 : 0
        }
      })).then(res => {
        this.response = res.data
      })
    }
  },
  activated() {
     this.getAds()
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%

</style>
