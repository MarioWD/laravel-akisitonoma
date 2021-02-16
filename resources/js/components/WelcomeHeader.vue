<template>
<header class='row row__resto'>
    <div class='navbar col-12 sticky-top d-flex align-items-center'>
        <a class='navbar-brand' href='/'><img src='/assets/chili.svg' height='50px'/></a>
        <div class='navbar-right text-light'>
            <a class='p-2 text-decoration-none text-light' href='/catalog'>Catering</a>
            |
            <a class='p-2 text-decoration-none text-light' href='#' data-target='#order-submit-modal' data-toggle='modal'><i class='fa fa-shopping-cart'></i> <strong>{{ this.total }}</strong></a>
        </div>
    </div>
</header>
</template>
<script>
import { bus } from '../app';
export default {
    name: 'WelcomeHeader'
}
</script>
