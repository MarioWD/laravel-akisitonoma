<template>	
<header class='row row__resto'>
    <div class='navbar col-12 sticky-top d-flex align-items-center'>
        <span class='navbar-brand'><img src='/assets/chili.svg' height='50px'/></span>
		<a class='navbar-right p-2 text-decoration-none text-light' href='#' data-target='#order-submit-modal' data-toggle='modal'><i class='fa fa-shopping-cart'></i> <strong>{{ this.total }}</strong></a>
    </div>
    <div class='col-12 text-center intro mt-5'>
        <h1><span class='font-color-beige'>A Comerrr!</span> Akisito No'ma</h1>
        <p>Comida autenticamente Peruana y Mexicana, directo a su hogar!</p>
        <div :if='menus' class='d-flex justify-content-around px-5'>
            <a v-for="(menu, i) in menus" :key="i" 
                class='btn btn-orange btn-lg' 
                href='#menu-order' 
               @click="changeMenu(i)"
               v-smooth-scroll><strong>Order for {{ getProperDate(menu.end_date) }}</strong></a>
        </div>
    </div>
</header>
</template>
<script>
import { bus } from '../app';
export default {
    name: 'WelcomeHeader',
    props: ['menus'],
    data () {
        return {
            keys: [],
            menu: {},
            total: 0,
            days: [
                'Sunday','Monday', 'Tuesday', 'Wednesday',
                'Thursday', 'Friday', 'Saturday'
            ],
        };
    },
    methods: {
        getProperDate (dateData) {
            let d  = new Date(dateData);
            d.setDate(d.getDate() + 1);
            return this.days[d.getDay()];
        },
        changeMenu (index) {
            bus.$emit('menu-change', {'menu':this.menus[index], index: index});
        }
    },
    created () {
        bus.$on('cache-menu', (data) => this.menus[data.index] = data.menu );
        bus.$on('item-total-update', (data) => this.total = data);
    },
    mounted () {
        this.keys = Object.keys(this.menus);
        this.menu = this.menus[0];
    }
}
</script>
