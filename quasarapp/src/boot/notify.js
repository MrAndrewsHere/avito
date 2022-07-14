import { Notify } from 'quasar'

Notify.registerType('success', {
  group: false,

  actions: [
    { icon: 'close', color: 'black', handler: () => { /* ... */ } }
  ],
  timeout: 230,
  position: 'bottom',
  icon: 'check_circle_outline',
  attrs: {
    style: 'opacity:0.90'
  },
  color: 'secondary',
  classes: [
    'successNotify'
  ],

  textColor: 'black'
})
Notify.registerType('warning', {
  group: false,
  actions: [
    { icon: 'close', color: 'black', handler: () => { /* ... */ } }
  ],
  timeout: 60000,
  position: 'bottom',
  icon: 'warning_amber',
  attrs: {
    style: 'opacity:0.90',
    class: 'defBack'
  },
  color: 'warning',
  classes: [
    'warningNotify'
  ],
  textColor: 'black'
})
Notify.registerType('error', {
  group: false,
  actions: [
    { icon: 'close', color: 'black', handler: () => { /* ... */ } }
  ],

  timeout: 10000,
  position: 'bottom',
  attrs: {
    style: 'opacity:0.93'
  },
  classes: [
    'errorNotify'
  ],
  color: 'red-8',
  textColor: 'black',
  icon: 'error_outline'
})
