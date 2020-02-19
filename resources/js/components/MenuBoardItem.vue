<template>
</template>
<script>
export default {
	name: 'MenuBoardItem',
  	props: ['item', 'index'],
	data () {
	},
	mounted () {
		this.state.item = this.item;
	},
}
</script>
