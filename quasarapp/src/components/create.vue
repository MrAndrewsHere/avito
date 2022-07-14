<template>
  <q-form @submit="storeAds" ref="createAd" class="q-gutter-y-md q-pa-xs">
    <div class="q-py-lg">
      <div class="cursor-pointer" @click="back()">
        <q-icon size="xs" name="west" class="q-px-xs "></q-icon>
        <span class="text-primary">К списку</span>
      </div>

    </div>
    <q-input v-model.trim="ad.name"
             lazy-rules="ondemand"
             :rules="[
               val => val !== null && val !== '' || 'Введите название',
               val => val.length > 5 || 'Длина названия должны быть больше 5 символов',
             ]"
             dense filled label="Название*"></q-input>

    <q-input v-model.trim="ad.price"  dense filled label="Цена*"
             lazy-rules="ondemand"
             :rules="[
               val => val !== null && val !== '' || 'Введите цену',
               val => val > 0 || 'Цена должна быть положительным числом',
               val => val < 200000 || 'Цена должна быть меньше 200000',
             ]"
    ></q-input>
    <q-input type="textarea" v-model.trim="ad.description" dense filled label="Описание"></q-input>
    <q-input v-model.trim="photo1" dense filled label="Фото1"></q-input>
    <q-input v-model.trim="photo2" dense filled label="Фото2"></q-input>
    <q-input v-model.trim="photo3" dense filled label="Фото3"></q-input>

    <carousel :photo="photo"></carousel>
    <div class="full-width flex flex-inline ">

      <q-btn no-caps type="submit" color="primary" label="Сохранить"></q-btn>
      <q-btn @click="cancel" class="q-mx-md" no-caps label="Отмена"></q-btn>
    </div>

  </q-form>
</template>

<script>
import {api} from "boot/axios";
import {api_ad_store} from "src/router/API";
import Carousel from "components/carousel";

export default {
  name: "create",
  components: {Carousel},
  data: () => {
    return {

      ad: {
        name: null,
        description: null,
        price: null,

      },
      photo1: "https://picsum.photos/id/1/1900/1260",
      photo2: "https://picsum.photos/id/22/1900/1260",
      photo3: "https://picsum.photos/id/33/1900/1260",
    }
  },
  computed: {
    photo() {
      return this.collect.map(e => {
        return {url: e}
      })
    },
    collect(){
      return [this.photo1, this.photo2, this.photo3,].filter(e => !!e);
    },
  },
  methods: {
    clean(){

      this.ad.name = null;
      this.ad.description = null;
      this.ad.price = null;
      this.photo1 = null;
      this.photo2 = null;
      this.photo3 = null;
    },
    cancel() {
     this.clean()
      this.back()
    },
    back() {
      this.$router.push('/ads')
    },
    storeAds() {
      this.$refs.createAd.validate().then(s => {
        if(s){
          api(Object.assign(api_ad_store, {
            data: Object.assign(this.ad, {photo: this.photo})
          })).then(res => {
            this.clean()
            this.$router.push({path:'/ad', query:{id:res.data.data.id}})
          }).catch(() => {
            this.$q.notify({

              message:'Не удалось сохранить объявление.',
              timeout:60
            })
          })
        }
      })

    }
  }

}
</script>

<style scoped>

</style>
