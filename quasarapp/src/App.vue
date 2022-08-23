<template>
  <router-view />
</template>
<script>
import { defineComponent } from 'vue';
import axios from "boot/axios";
export default defineComponent({
  name: 'App',
  beforeMount () {


    axios.interceptors.response.use(res => {
      console.log(res)
      switch (res.data?.code) {
        case 422: {
          const msgs = Object.values(res.data.data).join(' ')
          this.$q.notify({
            message: msgs
          })
          break
        }

        default: {
          return res
        }
      }
    }, error => {
      switch (error.response.status) {
        case 404: {
          this.$q.notify({
            message: 'Not found'
          })
          break
        }
        case 422: {
          this.$q.notify({

            message: Object.values(error.response.data)
          })
          break
        }

        default: {
          this.$q.notify({

            message: 'Не удалось выполнить запрос'
          })
          break
        }
      }

      throw error
    })
  }
})
</script>
