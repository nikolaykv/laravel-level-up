window.Vue = require('vue')

import tabs from './components/tabs';

Vue.component('tabs', tabs)

const Tabs = new Vue({
    el: '#tabs',
});


