<style lang='scss'>
    .description {
        padding-top: 6rem;
    }

    img {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.12), 0 2px 4px 0 rgba(0,0,0,0.08);
    }
</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="alert alert-danger" v-if="showLoginAlert">
                        You need to login in order to initiate a trade.
                    </div>

                    <div class="alert alert-success" v-if="showSuccessAlert">
                        {{ post.seller }} has been alerted of your interested!
                </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <h2>{{ post.title }}</h2>
                            <img v-bind:src="post.image" class="img-responsive" alt="Responsive image">
                        </div>
                        <div class="col-xs-12 col-md-6 description">
                            <p>Seller: <a :href="user.profile.links.profile">{{ post.seller }}</a></p>
                            <p>Posted: {{ post.posted | date }}</p>
                            <div v-html="post.description"></div>
                            <br>
                            <button class="btn btn-success" @click="initiateTrade()">Im interested!</button><hr>
                            <h4>Wanted Elephpants</h4>
                            <ul v-for="elephpant in wanted">
                                <li> {{ elephpant.elephpant }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../js/auth.js';
  import Moment from 'moment';
  import EtNav from './nav.vue';

  export default {
    created() {
      return auth.check();
    },

    data() {
      return {
        post: '',
        wanted: [],
        auth: auth,
        user: auth.user,
        showLoginAlert: false,
        showSuccessAlert: false,
      };
    },

    mounted() {
      this.getPost();
    },

    watch: {
      post(post) {
        this.wanted = this.post.wanted.data;
      }
    },

    methods: {
      getPost() {
        axios.get(`/api/elephpants/post/${this.$route.params.id}`).then(response => {
          this.post = response.data.data[0];
        }).catch(error => {
          console.error(error);
        });
      },

      initiateTrade() {
        let token = localStorage.getItem('id_token');

        if (!token) {
          this.showLoginAlert = true;

          setTimeout(() => {
            this.showLoginAlert = false;
          }, 5000);
        }

        axios.post('/api/elephpants/trade', {
          postId: this.post.id,
          sellerId: this.post.sellerId,
        }, { headers: {
            'Authorization': `Bearer ${token}`
        }}).then(response => {
          this.showSuccessAlert = true;

          setTimeout(() => {
            this.showSuccessAlert = false;
          }, 5000);
        }).catch(error => {

        });
      },

      logout() {
        return auth.signout();
      },
    },

    filters: {
      date(value) {
        return Moment(value.date).format('MM/DD/YYYY');
      }
    },

    components: {
      EtNav,
    },
  };
</script>