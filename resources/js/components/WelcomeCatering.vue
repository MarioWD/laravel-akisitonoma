<template>
<div class='row'>
    <div class='row__header-intro col-12 text-center mt-5'>
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
    <div class='row__catering_cta col-12 my-5 py-5 px-5'>
        <h1 class='text-center font-color-chocoorange font-family-cursive mb-3'>Hosting an event?</h1>
        <p class='text-center font-weight-bold'>
            For special orders and event catering we have a great variety of entrees and appetizers for your events and parties.<br>
            For more information and comments you can contact us at our <a class='text-decoration-none font-weight-bold' href='mailto:floresemilia@hotmail.com' target='_blank'>Email</a> or through the <a class='text-decoration-none font-weight-bold' href='tel:7788891245' target='_blank'>Phone</a>.
        </p>
        <div class='d-flex justify-content-center'>
            <a class='btn btn-olive' href='/catalog'>Catering Menu</a>
        </div>
        <hr/>
        <p></p>
        <p class='text-center font-weight-bold'>
        You can also check us out on <a href="https://www.facebook.com/Akisito-Noma-1532949476978572" class='font-weight-bold text-decoration-none' target='_blank'>Facebook!</a>
        </p>
    </div>
</div>
</template>
<script>
import { bus } from '../app';
export default {
    name: 'WelcomeCatering',
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
