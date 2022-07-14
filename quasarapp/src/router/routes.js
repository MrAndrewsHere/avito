const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    props: (route) => ({query: route.query}),
    children: [
      {
        path: '/',
        component: () => import('components/ads.vue'),
        props: (route) => ({query: route.query})
      },
      {
        path: '/ads',
        component: () => import('components/ads.vue'),
        props: (route) => ({query: route.query})
      },
      {
        path: '/ad',
        component: () => import('components/ad.vue'),
        props: (route) => ({query: route.query})
      },
      {
        path: '/ad/create',
        component: () => import('components/create.vue'),
        props: (route) => ({query: route.query})
      },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  // {
  //   path: '/:catchAll(.*)*',
  //   component: () => import('pages/Error404.vue')
  // }
]

export default routes
