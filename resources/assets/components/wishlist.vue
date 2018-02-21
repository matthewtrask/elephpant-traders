<style lang='scss'>

</style>
<template>
    <div>
        <et-nav> :user="user"</et-nav>
        <div class="container">
            <div class="row">

            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../js/auth.js';
  import EtNav from './nav.vue';

  export default {
    created() {
      this.checkAuth();
      this.getWantedElephpants();
    },

    data() {
      return {
        auth: auth,
        user:null,
        wantedElephpants: [],
      };
    },

    methods: {
      getWantedElephpants() {
        axios.get('/api/wishlist').then(response => {
          this.wantedElephpants = response.data.data;
        }).catch(error => {
          console.log(error);
        });
      },

      checkAuth() {
        return auth.check();
      },
    },

    components: {
      EtNav,
    }
  };
</script>