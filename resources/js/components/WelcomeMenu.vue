<template>
<div class='container-fluid'>
	<header class='row row__resto'>
		<div class='navbar col-12 sticky-top d-flex align-items-center'>
			<span class='navbar-brand'><img src='/assets/chili.svg' height='50px'/></span>
			<a class='navbar-right p-2 text-decoration-none text-light' href='#' data-target='#order-submit-modal' data-toggle='modal'><i class='fa fa-shopping-cart'></i> <strong>{{ order.total }}</strong></a>
		</div>
		<div class='col-12 text-center intro'>
			<h1><span class='font-color-beige'>A Comerrr!</span> Akisito No'ma</h1>
			<p>Comida autenticamente Peruana y Mexicana, directo a su hogar!</p>
			<a class='btn btn-orange btn-lg' href='#menu-order' v-smooth-scroll><strong>Ordena!</strong></a>
		</div>
	</header>
	<main class='row row__menu'>
		<div class='col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 col-12 col-md-8 offset-md-2' v-if="menu">
			<div class='container-fluid' id='menu-order'>
				<div class='row row__menu-header mb-3'>
					<div class='col-12'>
						<h1 class='mb-2'>El menu de la semana!</h1>
						<p class='mb-0'>Apretando el boton agregara la comida a su orden</p>
						<p>Clicking the button will add the item to your order</p>
						<hr/>
						<div style='min-height:50px;'>
							<button v-if='!order.start' class='btn btn-olive' @click='startForm'>Empezar/Start</button>
						</div>
					</div>
				</div>
				<div v-for="(item, i) in items" :key="i" 
				class='row row__item align-items-center'
				:class="{'flex-row-reverse':((i+1)%2==0),'flex-row':!((i+1)%2==0)}">
					<div class='col-md-4 col__img'>
						<img :src="`/storage/${item.image}`" class='w-100'/>
					</div>
					<div class='col-md-8 col__info' :class="{'text-md-right':((i+1)%2==0)}">
						<blockquote class='blockquote'>
							<h1 class='font-color-chocoorange'>
								{{ item.name }} - <span class='font-color-saddlered'>${{ item.price }}</span>
							</h1>
							<p class='mb-0' v-if="item.description">{{ item.description }}</p>
							<div class='mt-3' v-if='order.start'>
								<button v-if="!order.items[item.id]" class='btn btn-orange' @click="addItem($event, item)">Agregar/Add</button>
								<div v-if="order.items[item.id]" class='d-flex' :class="{'justify-content-end': ((i+1)%2==0)}">
									<input class='form-control' readonly :style="{width: '80px'}" min='0' step='1' type='number' v-model:lazy="order.items[item.id]" @change="changeAmount($event, item)" />
									<button class='btn btn-success ml-3' @click="addOne(item)"><i class='fa fa-plus'></i></button>
									<button class='btn btn-danger ml-3' @click="removeOne(item)"><i class='fa fa-minus'></i></button>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
				<div class='text-center mt-3'>
					<button v-if='order.start' class='btn btn-olive' data-target="#order-submit-modal" data-toggle='modal' type='button'>Termina Orden/Submit Order</button>
				</div>
			</div>
		</div>
	</main>
    <loading :active.sync='isFinishing' :is-full-page='true'></loading>
	<div v-if="order.start" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id='order-submit-modal'>
	  	<div class="modal-dialog modal-lg">
			<div class="modal-content p-md-5">
				<div class='container'>
					<form @submit='finishOrder'>
						<div class='card card-body'>
							<div class='text-center'>
								<p>Termina tu orden con el boton "Terminar/Finish" al final o aprete el boton "Continuar/Continue" para seguir modificando tu orden.</p>
								<hr/>
								<p>Finish your order by pressing the "Terminar/Finish" button at the end or press the "Continuar/Continue" button to continue modifying your order.</p>
							</div>
							<div class='form-group row'>
								<label for='name' class='col-md-4 col-form-label text-md-right'>You Name/Tu Nombre</label>
								<div class='col-md-6'>
									<input class='form-control' type='text' v-model="order.name" id='name' :class="{'is-invalid': this.errors.name}" @change='addOrderProperty($event)'>
									<span class='invalid-feedback' role='alert' v-if='this.errors.name'>
										<strong>{{ (this.errors.name?this.errors.name[0]:"") }}</strong>
									</span>
								</div>
							</div>
							<div class='form-group row'>
								<label for='email' class='col-md-4 col-form-label text-md-right'>Your Email/Tu Email</label>
								<div class='col-md-6'>
									<input class='form-control' type='email' v-model="order.email" id='email' :class="{'is-invalid': this.errors.email}" @change='addOrderProperty($event)'>
									<span class='invalid-feedback' role='alert' v-if='this.errors.email'>
										<strong>{{ (this.errors.email?this.errors.email[0]:"") }}</strong>
									</span>
								</div>
							</div>
							<div class='form-group row'>
								<label for='address' class='col-md-4 col-form-label text-md-right'>Your Address/Tu Direccion</label>
								<div class='col-md-6'>
									<input class='form-control' type='address' v-model="order.address" id='address' :class="{'is-invalid': this.errors.address}" @change='addOrderProperty($event)'>
									<span class='invalid-feedback' role='alert' v-if='this.errors.address'>
										<strong>{{ (this.errors.address?this.errors.address[0]:"") }}</strong>
									</span>
								</div>
							</div>

							<div class='form-group row'>
								<label for='phone' class='col-md-4 col-form-label text-md-right'>Your Phone/ Tu Telefono</label>
								<div class='col-md-6'>
									<input class='form-control' type='tel' v-model="order.phone" id='phone' :class="{'is-invalid': this.errors.phone}" @change='addOrderProperty($event)'>
									<span class='invalid-feedback' role='alert' v-if='this.errors.phone'>
										<strong>{{ (this.errors.phone?this.errors.phone[0]:"") }}</strong>
									</span>
								</div>
							</div>

							<div class='form-group row'>
								<label for='notes' class='col-md-4 col-form-label text-md-right'>Notas Para Tu Orden</label>
								<div class='col-md-6'>
									<textarea class='form-control' type='tel' v-model="order.notes" id='notes' :class="{'is-invalid': this.errors.notes}" @change='addOrderProperty($event)'></textarea>
									<span class='invalid-feedback' role='alert' v-if='this.errors.notes'>
										<strong>{{ (this.errors.notes?this.errors.notes[0]:"") }}</strong>
									</span>
								</div>
							</div>

							<div class='form-group row' v-for='(item, y) in items' v-if="order.items[item.id] > 0">
								<div class='col-md-4 text-md-right'>{{ item.name }}</div>
								<div class='col-md-6'>
${{ item.price }} X {{ order.items[item.id] }} = ${{ (order.items[item.id]*item.price).toFixed(2) }}
								</div>
							</div>
							<div class='form-group row'>
								<div class='col-md-4 text-md-right'>Total</div>
								<div class='col-md-6'>
									${{ (order.sum*1).toFixed(2) }}<input type='hidden' class='form-control' :class="{'is-invalid': this.errors.item_id}"/>
									<span class='invalid-feedback' role='alert' v-if='this.errors.item_id'>
										<strong>{{ (this.errors.item_id?this.errors.item_id[0]:"") }}</strong>
									</span>
								</div>
							</div>
							<div class='row'>
								<div class='col-12 text-center'>
									<button type='button' class='btn btn-primary' @click="toggleModal">Continuar/Continue</button>
									<button type='submit' class='btn btn-success' :disabled="isFinishing">Terminar/Finish</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
	  	</div>
  	</div>
</div>
</template>

<script>
import vueSmoothScroll from 'vue2-smooth-scroll'
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'

Vue.use(vueSmoothScroll)
Vue.use(Loading)

export default {
	name: 'WelcomeMenu',
	props: ['menu', 'items', 'order'],
    components: { Loading, },
	data () {
		return {
			itemList: this.items,
		  	menuInfo: this.menu,
		  	orderInfo: this.order,
		  	isFinishing: false,
			errors: {},
		};
	},
	methods: {
		toggleModal () {
			$("#order-submit-modal").modal('toggle');
		},
		addOrderProperty (event) {
			let prop = event.target.id;
			let val = event.target.value;
			this.order[prop] = val;
		},
	 	startForm () { 
			this.order.start = !this.order.start; 
			this.order.sum = this.order.sum? this.order.sum : 0;
			this.order.finish = false;
		},
		 changeAmount (event, item) {
			 this.order.items[item.id] = event.target.value ? parseInt(event.target.value) : 0;
			 this.order.total = parseInt(this.order.items.reduce((a, b) => a+b, 0));
			 this.calculateOrderSum();
		 },
		 calculateOrderSum () {
			 this.order.sum = 0;
			 for (let i in this.items) {
				 let amount = this.order.items[this.items[i].id]
				 let price = parseFloat(this.items[i].price);
				 this.order.sum += (amount ? (amount*price) : 0.00);
			 }
		 },
		 addOne (item) {
			this.order.items[item.id]++;
			this.order.total++;
		 	this.calculateOrderSum();
		 },
		removeOne (item) {
			this.order.items[item.id]--;
			this.order.total--;
		 	this.calculateOrderSum();
		},
		addItem (event, item) {
			this.order.items[item.id] = 1;
			this.order.total++;
			this.calculateOrderSum();
		},
		finishOrder (event) {
			event.preventDefault();
            this.isFinishing = true;
			axios.post("/api/order", this.order)
				.then(response => {
                    this.isFinishing = false;
					this.toggleModal();
					this.order.name = "";
					this.order.email = "";
					this.order.phone = "";
					this.order.total = 0;
					this.order.sum = 0;
					for (let i in this.items) {
						this.order.items[this.items[i].id] = 0;
					}
					this.errors = {};
					this.order.start = false;
					alert("Tu Orden a sido confirmada cheque su email! / Your order has been confirmed check your email!");
				})
				.catch(error => {
                    this.isFinishing = false;
					this.errors = error.response.data.errors;
				});
		},
	},
	mounted() {},
}
</script>
