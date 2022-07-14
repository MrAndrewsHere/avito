<template>
  <q-carousel  v-if="!!photo && photo.length > 0|| false"
              swipeable v-model:fullscreen="fullscreen"

              animated
              v-model="slide"
              thumbnails
              infinite
  >
    <q-carousel-slide v-for="(p,index) in photo" :name="index" :key="index" :img-src="p.url" />
    <template v-slot:control>
      <q-carousel-control
        position="bottom-right"
        :offset="[18, 18]"
      >
        <q-btn
          push round dense color="white" text-color="primary"
          :icon="fullscreen ? 'fullscreen_exit' : 'fullscreen'"
          @click="fullscreen = !fullscreen"
        />
      </q-carousel-control>
    </template>
  </q-carousel>
</template>

<script>
export default {
  name: "carousel",
  props:['photo'],
  data:()=>{
    return {
      slide:0,
      fullscreen:false,
    }
  },
  computed:{
    currentSlide:{
      get(){
        return !!this.photo[this.slide] || this.photo?.find(e => e) || 0
      },
      set(val){
        this.slide = val
      },
    }
  },

}
</script>

<style scoped>

</style>
