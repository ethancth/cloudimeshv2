!function(e,t){if("object"==typeof exports&&"object"==typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var n=t();for(var o in n)("object"==typeof exports?exports:e)[o]=n[o]}}(self,(function(){return e={93738:function(e,t,n){var o,r,c;function i(e){return i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},i(e)}c=function(){"use strict";function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function t(e){return t=Object.setPrototypeOf?Object.getPrototypeOf.bind():function(e){return e.__proto__||Object.getPrototypeOf(e)},t(e)}function n(e,t){return n=Object.setPrototypeOf?Object.setPrototypeOf.bind():function(e,t){return e.__proto__=t,e},n(e,t)}function o(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function r(e){var n=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var r,c=t(e);if(n){var a=t(this).constructor;r=Reflect.construct(c,arguments,a)}else r=c.apply(this,arguments);return function(e,t){if(t&&("object"===i(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return o(e)}(this,r)}}var c=FormValidation.Plugin,a=FormValidation.utils.fetch,u=function(t){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&n(e,t)}(l,t);var c,i,u,s=r(l);function l(e){var t;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,l),(t=s.call(this,e)).opts=Object.assign({},{minimumScore:0},e),t.iconPlacedHandler=t.onIconPlaced.bind(o(t)),t}return c=l,i=[{key:"install",value:function(){var e=this;this.core.on("plugins.icon.placed",this.iconPlacedHandler);var t=void 0===window[l.LOADED_CALLBACK]?function(){}:window[l.LOADED_CALLBACK];window[l.LOADED_CALLBACK]=function(){t();var n=document.createElement("input");n.setAttribute("type","hidden"),n.setAttribute("name",l.CAPTCHA_FIELD),document.getElementById(e.opts.element).appendChild(n),e.core.addField(l.CAPTCHA_FIELD,{validators:{promise:{message:e.opts.message,promise:function(t){return new Promise((function(t,n){window.grecaptcha.execute(e.opts.siteKey,{action:e.opts.action}).then((function(o){var r,c,i;a(e.opts.backendVerificationUrl,{method:"POST",params:(r={},c=l.CAPTCHA_FIELD,i=o,c in r?Object.defineProperty(r,c,{value:i,enumerable:!0,configurable:!0,writable:!0}):r[c]=i,r)}).then((function(n){var o="true"==="".concat(n.success)&&n.score>=e.opts.minimumScore;t({message:n.message||e.opts.message,meta:n,valid:o})})).catch((function(e){n({valid:!1})}))}))}))}}}})};var n=this.getScript();if(!document.body.querySelector('script[src="'.concat(n,'"]'))){var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.defer=!0,o.src=n,document.body.appendChild(o)}}},{key:"uninstall",value:function(){this.core.off("plugins.icon.placed",this.iconPlacedHandler);var e=this.getScript();[].slice.call(document.body.querySelectorAll('script[src="'.concat(e,'"]'))).forEach((function(e){return e.parentNode.removeChild(e)})),this.core.removeField(l.CAPTCHA_FIELD)}},{key:"getScript",value:function(){var e=this.opts.language?"&hl=".concat(this.opts.language):"";return"https://www.google.com/recaptcha/api.js?"+"onload=".concat(l.LOADED_CALLBACK,"&render=").concat(this.opts.siteKey).concat(e)}},{key:"onIconPlaced",value:function(e){e.field===l.CAPTCHA_FIELD&&(e.iconElement.style.display="none")}}],i&&e(c.prototype,i),u&&e(c,u),Object.defineProperty(c,"prototype",{writable:!1}),l}(c);return u.CAPTCHA_FIELD="___g-recaptcha-token___",u.LOADED_CALLBACK="___reCaptcha3Loaded___",u},"object"===i(t)?e.exports=c():void 0===(r="function"==typeof(o=c)?o.call(t,n,t,e):o)||(e.exports=r)}},t={},function n(o){var r=t[o];if(void 0!==r)return r.exports;var c=t[o]={exports:{}};return e[o].call(c.exports,c,c.exports,n),c.exports}(93738);var e,t}));