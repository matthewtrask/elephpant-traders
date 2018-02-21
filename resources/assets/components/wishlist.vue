<style lang='scss'>
    .panel {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.12), 0 2px 4px 0 rgba(0,0,0,0.08);
    }
</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>Wanted Elephpants</h2>
                    <p>These community people have been so kind as to list out some elephpants they want. Maybe you can help them out?</p>
                </div>
                <div class="col-xs-12 col-sm-4" v-for="elephpant in wantedElephpants.data">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ elephpant.elephpant }}</div>
                        <div class="panel-body">
                            <p>Who wants it? <a :href="/sellers/ + elephpant.sellerId">{{ elephpant.poster }}</a></p>
                            <p>Want Level: {{ elephpant.desire }}</p>
                            <p>Posted at: {{ elephpant.posted.date | date }}</p>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import moment from 'moment';
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
        user: auth.user || null,
        wantedElephpants: [],
      };
    },

    methods: {
      getWantedElephpants() {
        axios.get('/api/wishlist').then(response => {
          this.wantedElephpants = response.data;
        }).catch(error => {
          console.log(error);
        });
      },

      checkAuth() {
        return auth.check();
      },
    },

    filters: {
      date(value) {
        return moment(value).format('MM/DD/YYYY');
      },
    },

    components: {
      EtNav,
    }
  };
</script>