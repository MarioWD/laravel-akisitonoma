<template>
<div class='col-12'>
    <div class='row__board col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 col-12 col-md-8 offset-md-2' v-if="menu">
        <div class='container-fluid' id='menu-order'>
            <div class='row row__menu-header mb-3'>
                <div class='col-12'>
                    <h1 class='mb-2'>The Menu for the week!</h1>
                    <p>Clicking the button will add the item to your order</p>
                    <hr/>
                    <div style='min-height:50px;'>
                    <button v-if='!start' class='btn btn-olive' @click='startForm'>Start</button>
                    </div>
                </div>
            </div>

            <MenuItem v-for="(item, i) in menu.items" v-if="item.pivot.sold_out != 1" :key='item.id' :item="item" :i="i"/>

            <div class='text-center mt-3'>
                <button v-if='start' class='btn btn-olive' data-target="#order-submit-modal" data-toggle='modal' type='button'>Finish Order</button>
            </div>
        </div>
    </div>
    <loading :active.sync='isFinishing' :is-full-page='true'></loading>
    <!--MODAL-->
    <MenuModal v-if="start" />
</div>
</template>

<script>
import vueSmoothScroll from 'vue2-smooth-scroll'
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
import { bus }  from '../app';
import MenuItem from './MenuItem.vue';
import MenuModal from './MenuModal.vue';

Vue.use(vueSmoothScroll)
Vue.use(Loading)

export default {
	name: 'WelcomeMenu',
	props: ['menu'],
    components: { Loading, MenuItem, MenuModal },
	data () {
		return {
		  	isFinishing: false,
            index: 0,
			errors: {},
            name: "",
            phone: "",
            email: "",
            address: "",
            notes: "",
            total: 0,
            sum: 0,
            items: [],
            start: false,
		};
	},
    created () {
        bus.$on('menu-change', (data) => {
            this.menu['orderItems'] = this.items;
            bus.$emit('cache-menu', {menu: this.menu, index: this.index});
            this.menu = data.menu;
            this.index = data.index;
            this.items = data.menu.orderItems? data.menu.orderItems : [];
            this.updateTotal();
        });
    },
	methods: {
		toggleModal () {$("#order-submit-modal").modal('toggle');},
        updateTotal () {bus.$emit('item-total-update', this.items.length);},
        startForm () {this.start = true;},
        getUniqueItems () {
            return this.items.reduce((arr, a) => {
                if (!arr.some(el => el.id == a.id)) arr.push(a);
                return arr;
            }, []);
        },
        addItem (item) {
            this.items.push(item);
            this.updateTotal();
        },
        removeItem (item) {
            let itemIndex = this.items.findIndex(el => item.id == el.id);
            this.items.splice(itemIndex, 1);
            this.updateTotal();
        },
        itemExists (item) {
            return this.items.some(a => a.id == item.id);
        },
        getItemAmount (item) {
            return this.items.filter(el => item.id == el.id).length;
        },
        getItemSum (item) {
            return parseFloat(this.getItemAmount(item)*item.price).toFixed(2); 
        },
        getOrderSum () {
            let itemSum = this.items.reduce((sum, el) => parseFloat(sum)+parseFloat(el.price), 0);
            itemSum += parseFloat(this.menu.delivery);
            return itemSum.toFixed(2);
        },
        packageOrder () {
            let items = {};
            this.getUniqueItems().map((v, i) => {
                items[`${v.id}`] = this.getItemAmount(v); 
            });
            return {
                name: this.name,
                email: this.email, 
                phone: this.phone, 
                notes: this.notes,
                address: this.address,
                menu_id: this.menu.id,
                items: items,
                sum: this.getOrderSum(),
            };
        },
		finishOrder (event) {
			event.preventDefault();
            let orderJSON = this.packageOrder();
            this.isFinishing = true;
			axios.post("/api/order", orderJSON)
				.then(response => {
					this.toggleModal();
                    this.isFinishing = false;
					this.name = "";
					this.email = "";
					this.address = "";
					this.phone = "";
					this.total = 0;
					this.sum = 0;
                    this.items = [];
					this.errors = {};
					this.start = false;
					alert("Tu Orden ha sido confirmada cheque su email! / Your order has been confirmed check your email!");
				})
				.catch(error => {
                    this.isFinishing = false;
					this.errors = error.response.data.errors;
				});
		},
	},
}
</script>
