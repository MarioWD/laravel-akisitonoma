<template>
	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id='order-submit-modal'>
	  	<div class="modal-dialog modal-lg">
			<div class="modal-content p-md-5">
				<div class='container'>
					<form @submit='$parent.finishOrder($event)'>
						<div class='card card-body'>
							<div class='text-center'>
                                <p>Finish your order by pressing the "Submit" button at the end or press the "Continue" button to continue modifying your order.</p>
							</div>
							<div class='form-group row'>
                                <label for='name' class='col-md-4 col-form-label text-md-right'>Your Name</label>
								<div class='col-md-6'>
									<input class='form-control' type='text' v-model="$parent.name" id='name' :class="{'is-invalid': $parent.errors.name}">
									<span class='invalid-feedback' role='alert' v-if='$parent.errors.name'>
										<strong>{{ ($parent.errors.name? $parent.errors.name[0] : "") }}</strong>
									</span>
								</div>
							</div>
							<div class='form-group row'>
                                <label for='email' class='col-md-4 col-form-label text-md-right'>Your Email<!--/Tu Email--></label>
								<div class='col-md-6'>
									<input class='form-control' type='email' v-model="$parent.email" id='email' :class="{'is-invalid': $parent.errors.email}">
									<span class='invalid-feedback' role='alert' v-if='$parent.errors.email'>
									<strong>{{ ($parent.errors.email? $parent.errors.email[0] : "") }}</strong>
									</span>
								</div>
							</div>
							<div class='form-group row'>
                                <label for='address' class='col-md-4 col-form-label text-md-right'>Your Address<!--/Tu Direccion--></label>
								<div class='col-md-6'>
									<input class='form-control' type='address' v-model="$parent.address" id='address' :class="{'is-invalid': $parent.errors.address}">
									<span class='invalid-feedback' role='alert' v-if='$parent.errors.address'>
										<strong>{{ ($parent.errors.address? $parent.errors.address[0] : "") }}</strong>
									</span>
								</div>
							</div>

							<div class='form-group row'>
                                <label for='phone' class='col-md-4 col-form-label text-md-right'>Your Phone<!--/Tu Telefono--></label>
								<div class='col-md-6'>
									<input class='form-control' type='tel' v-model="$parent.phone" id='phone' :class="{'is-invalid': $parent.errors.phone}">
									<span class='invalid-feedback' role='alert' v-if='$parent.errors.phone'>
										<strong>{{ ($parent.errors.phone? $parent.errors.phone[0] : "") }}</strong>
									</span>
								</div>
							</div>

							<div class='form-group row'>
								<label for='notes' class='col-md-4 col-form-label text-md-right'>Notes for your order</label>
								<div class='col-md-6'>
									<textarea class='form-control' type='tel' v-model="$parent.notes" id='notes' :class="{'is-invalid': $parent.errors.notes}"></textarea>
									<span class='invalid-feedback' role='alert' v-if='$parent.errors.notes'>
										<strong>{{ ($parent.errors.notes? $parent.errors.notes[0] : "") }}</strong>
									</span>
								</div>
							</div>

                            <div class='form-group row' v-if="($parent.items.length > 0)" v-for='item in $parent.getUniqueItems()'>
								<div class='col-md-4 text-md-right'>{{ item.name }}</div>
                                <div class='col-md-6'>${{ parseFloat(item.price).toFixed(2) }} X {{ $parent.getItemAmount(item) }} = ${{ $parent.getItemSum(item) }}</div>
							</div>
                            <div class='form-group row' v-if="$parent.items.length > 0">
								<div class='col-md-4 text-md-right'>Delivery</div>
								<div class='col-md-6'>${{ parseFloat($parent.menu.delivery).toFixed(2) }}</div>
							</div>
                            <div class='form-group row' v-if="$parent.items.length > 0">
								<div class='col-md-4 text-md-right'>Total</div>
								<div class='col-md-6'>
									${{ $parent.getOrderSum() }}<input type='hidden' class='form-control' :class="{'is-invalid': $parent.errors.item_id}"/>
									<span class='invalid-feedback' role='alert' v-if='$parent.errors.item_id'>
										<strong>{{ ($parent.errors.item_id ? $parent.errors.item_id[0]:"") }}</strong>
									</span>
								</div>
							</div>
							<div class='row'>
								<div class='col-12 text-center'>
                                    <button type='button' class='btn btn-primary' @click="$parent.toggleModal()">Continue</button>
                                    <button type='submit' class='btn btn-success' :disabled="$parent.isFinishing">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
	  	</div>
  	</div>

</template>
<script>
export default {
    name: 'MenuModal',
}
</script>
