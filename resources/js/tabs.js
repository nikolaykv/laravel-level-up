window.Vue = require('vue')

import Tabs from './components/Tabs';

Vue.component('tabs', Tabs);

const tabs = new Vue({
    el: '#tabs'
});

