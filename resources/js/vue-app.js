window.Vue = require('vue')

import groupsComponent from './components/Groups';

Vue.component('groupsComponent', groupsComponent);

const groups = new Vue({
    el: '#groups'
});

