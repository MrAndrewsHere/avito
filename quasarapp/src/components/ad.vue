<template>
  <div>
    <div class="q-py-lg q-gutter-y-md">
      <div class="cursor-pointer" @click="back()">
        <q-icon size="xs" name="west" class="q-px-xs "></q-icon>
        <span class="text-primary">К списку</span>
      </div>
      <q-item-label class="main-color q-py-sm"
                    style=";font-weight: 500;font-size: 25px;">{{ ad && ad.name }}
      </q-item-label>
      <q-item-label class="text-body2 q-py-sm">
        {{ ad.price && ad.price+' руб.' }}
      </q-item-label>
      <q-item-label class="text-body1 q-py-sm">
        {{ ad && ad.description }}
      </q-item-label>
      <carousel :photo="ad && ad.photo"></carousel>

    </div>
  </div>
</template>

<script>
import Carousel from "components/carousel";
import {api} from "boot/axios";
import {api_ad_get} from "src/router/API";

export default {
  name: "ad",
  props: ['query'],
  components: {Carousel},
  data: () => {
    return {
      ad: {
        name: null,
        description: null,
        preview: null,
        price: null,
        photo: [

        ],

      },
    }
  },
  methods: {
    back() {
      this.$router.push('/ads')
    },
    getAd() {
      api(Object.assign(api_ad_get, {
        params: {
          id: this.query.id,
          fields:['description','photo'],
        }
      })).then(res => {
        this.ad = res.data.data
      }).catch(() => {
        this.$q.notify({
          type: 'error',
          message: 'Не удалось получить объявление.',
          timeout: 60
        })
      })
    }
  },
  activated() {
    this.getAd()
  }
}
</script>

<style scoped>

</style>
