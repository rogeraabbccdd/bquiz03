(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{105:function(e,t,o){"use strict";t.a={data:function(){return{darkTheme:!1,ignoreForcedThemes:!1}},mounted:function(){!1===this.yuu.defaultDarkTheme||localStorage.getItem("dark-theme")||localStorage.setItem("dark-theme",!0),!0!==this.yuu.disableDarkTheme&&(this.darkTheme="true"===localStorage.getItem("dark-theme"),this.toggleDarkTheme()),!0!==this.yuu.disableThemeIgnore&&(this.ignoreForcedThemes="true"===localStorage.getItem("ignore-forced-themes"))},methods:{toggleDarkTheme:function(){if(this.darkTheme)return document.body.classList.add("yuu-theme-dark"),localStorage.setItem("dark-theme",!0);document.body.classList.remove("yuu-theme-dark"),localStorage.setItem("dark-theme",!1)},toggleForcedThemes:function(){if(this.ignoreForcedThemes)return this.setTheme(localStorage.getItem("color-theme")),localStorage.setItem("ignore-forced-themes",!0);localStorage.removeItem("ignore-forced-themes")}}}},118:function(e,t,o){},16:function(e,t,o){"use strict";o(15);t.a={data:function(){return{yuu:{}}},mounted:function(){var e=this.$site.themeConfig.yuu,t=void 0===e?{}:e;this.yuu={themes:t.colorThemes||["blue","red"],disableDarkTheme:t.disableDarkTheme||!1,disableThemeIgnore:t.disableThemeIgnore||!1,extraOptions:t.extraOptions||{},defaultDarkTheme:t.defaultDarkTheme||!1,defaultTheme:t.defaultTheme||"green"},this.yuu.hasThemes=Array.isArray(this.yuu.themes)&&this.yuu.themes.length>0}}},19:function(e,t,o){"use strict";o(30),o(62),o(63);var r=o(35);o(23),o(15);t.a={mounted:function(){this.setPageTheme()},beforeUpdate:function(){this.setPageTheme()},methods:{setTheme:function(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],o=this.yuu.themes||{};if(Array.isArray(o)&&o.length){var a=document.body.classList,s=o.map(function(e){return"yuu-theme-".concat(e)});if(!e)return t&&localStorage.setItem("color-theme",""),a.remove.apply(a,Object(r.a)(s));if(e&&!o.includes(e)){var h=localStorage.getItem("color-theme");return this.setTheme(o.includes(h)?h:null)}a.remove.apply(a,Object(r.a)(s.filter(function(t){return t!=="yuu-theme-".concat(e)}))),a.add("yuu-theme-".concat(e)),t&&localStorage.setItem("color-theme",e)}},setPageTheme:function(){"green"!==this.yuu.defaultTheme&&""!=localStorage.getItem("color-theme")&&localStorage.setItem("color-theme",this.yuu.defaultTheme);var e=this.$page.frontmatter.forceTheme,t=localStorage.getItem("color-theme"),o="true"===localStorage.getItem("ignore-forced-themes"),r=!0!==this.yuu.disableThemeIgnore&&o?t:e||t;this.setTheme(r,!1)}}}},231:function(e,t,o){"use strict";var r=o(118);o.n(r).a},244:function(e,t,o){"use strict";o.r(t);var r=o(16),a=o(19),s=o(105),h=["There's nothing here!.","How did we get here?!","That's a Four-Oh-Four.1","Looks like we've got some broken links!."],i={name:"NotFound",mixins:[r.a,a.a,s.a],methods:{displayMessage:function(){return h[Math.floor(Math.random()*h.length)]}}},n=(o(231),o(1)),u=Object(n.a)(i,function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"theme-container"},[t("div",{staticClass:"content__default"},[t("h1",[this._v("404")]),this._v(" "),t("blockquote",[this._v(this._s(this.displayMessage()))]),this._v(" "),t("router-link",{attrs:{to:"/"}},[this._v("Take me home.")])],1)])},[],!1,null,null,null);t.default=u.exports}}]);