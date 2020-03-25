<template>
    <div class='row row__item align-items-center mb-5 mb-md-0'
        :class="{'flex-row-reverse':((i+1)%2==0),'flex-row':!((i+1)%2==0)}">
            <div class='col-md-4 col__img mb-3'>
                <img :src="`/storage/${item.image}`" class='w-100'/>
            </div>
            <div class='col-md-8 col__info' :class="{'text-md-right':((i+1)%2==0)}">
                <blockquote class='blockquote'>
                    <h1 class='font-color-chocoorange'>
                        {{ item.name }} - <span class='font-color-saddlered'>${{ parseFloat(item.price).toFixed(2) }}</span>
                    </h1>
                    <p class='mb-0' v-if="item.description">{{ item.description }}</p>
                    <div class='mt-3' v-if='$parent.start'>
                        <button v-if="!$parent.itemExists(item)" class='btn btn-orange' @click="$parent.addItem(item)">Add</button>
                        <div v-if="$parent.itemExists(item)" class='d-flex' :class="{'justify-content-md-end': ((i+1)%2==0)}">
                            <input class='form-control' readonly 
                            :style="{width: '80px'}" min='0' 
                            step='1' type='number' :value="$parent.getItemAmount(item)"/>
                            <button class='btn btn-success ml-3' 
                            @click="$parent.addItem(item)">
                            <i class='fa fa-plus'></i>
                            </button>
                            <button class='btn btn-danger ml-3' 
                            @click="$parent.removeItem(item)">
                            <i class='fa fa-minus'></i>
                            </button>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
</template>
<script>
export default {
    name: 'MenuItem',
    props: ['item', 'i'],
}
</script>
