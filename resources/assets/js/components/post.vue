<style lang='scss'>
    .description {
        padding-top: 6rem;
    }
</style>
<template>
    <div>
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
                        <p>Seller: {{ post.seller }}</p>
                        <p>Posted: {{ post.posted | date }}</p>
                        <p> {{ post.description }}</p>
                        <br>
                        <button class="btn btn-success" @click="initiateTrade()">Im interested!</button><hr>
                        <h4>Wanted Elephpants</h4>
                        <ul v-for="elephpant in wanted">
                            <li> {{ elephpant.elephpant }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            ...
                          </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';
  import Moment from 'moment';

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
      window.unload = this.logout;
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
        console.log(token);
        if (!token) {
          this.showLoginAlert = true;

          setTimeout(() => {
            this.showLoginAlert = false;
          }, 5000);
        }

        axios.post('/api/elephpants/trade?token=' + token, {
          postId: this.post.id,
          sellerId: this.user.profile.id,
          token: token,
        }).then(response => {
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
    }
  };
</script>