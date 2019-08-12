module.exports = {
  markdown: {
    lineNumbers: true
  },
  head: [
    ['link', { rel: 'stylesheet', href: '/css/custom.css'}],
    ['link', { rel: 'shortcut icon', href: '/images/favicon.ico'}],
  ],
  markdown: {
    lineNumbers: true,
  },
  base: '/bquiz03/',
  title:'ABC影城',
  description: '國家技術士網頁設計乙級檢定第三題',
  plugins: [
    ['vuepress-plugin-container', { type: 'tip' }],
    ['vuepress-plugin-container', { type: 'warning' }],
    ['vuepress-plugin-container', { type: 'danger' }],
    'vuepress-plugin-nprogress',
    [ 
      '@vuepress/google-analytics',{
        'ga': 'UA-131804412-2'
      }
    ], 'vuepress-plugin-smooth-scroll',
  ],
  themeConfig: {
    yuu: {
      defaultDarkTheme: true,
      defaultTheme: 'blue',
      disableThemeIgnore: true,
      codeTheme: 'okaidia'
    },
    nav: [
      { text: '首頁', link: 'https://bquiz.kento520.tw' },
      { text: 'GitHub', link: 'https://github.com/rogeraabbccdd/bquiz03' },
    ],
    sidebar: [
      ['/', '首頁'],
      {
        title: '前置作業',
        collapsable: false,
        children: [
          'before/file',
          'before/sql',
          'before/func',
          'before/data'
        ]
      },
      {
        title: '前台',
        collapsable: false,
        children: [
          'front/index-post',
          'front/index-movie',
          'front/movie',
          'front/book',
          'front/seat',
          'front/out'
        ]
      },
      {
        title: '後台',
        collapsable: false,
        children: [
          'back/admin',
          'back/post',
          'back/movie',
          'back/order'
        ]
      },
      ['end/end', '結語'],
    ]
  }
};