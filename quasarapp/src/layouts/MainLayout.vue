<template>
  <q-layout view="lHh Lpr lFf">

    <q-page-container>
      <div class="row flex flex-center justify-center">
        <div class="col col-xs-12 col-sm-12 col-md-5 q-px-lg" style="padding-top: 1%;background-color: whitesmoke">

          <router-view v-slot="{ Component }">
            <keep-alive>
              <component :key="$route.fullPath" :is="Component" />
            </keep-alive>
          </router-view>

        </div>
      </div>
    </q-page-container>
  </q-layout>
</template>

<script>


import {defineComponent} from 'vue'

export default defineComponent({
  name: 'MainLayout',


  setup() {


  }
})
</script>
