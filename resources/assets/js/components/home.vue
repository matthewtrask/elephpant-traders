<style lang='scss'>

</style>
<template>
    <div>
        <div class="row">
            <div class="col-sm-6 col-md-4" v-for="post in orderedPosts">
                <div class="thumbnail">
                    <img :src="post.image" alt="...">
                    <div class="caption">
                        <h3>{{ post.title }}</h3>
                        <p>Seller: {{ post.seller }}</p>
                        <p>Posted: {{ post.posted | date }}</p>
                        <p>{{ post.description }}</p>
                        <p>
                            <a v-bind:href="'/#/posts/' + post.id"  class="btn btn-primary" role="button">View Post</a>
                            <a v-bind:href="'/#/sellers/' + post.sellerId" class="btn btn-default" role="button">View Seller</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import { orderBy } from 'lodash';
  import Moment from 'moment';
  import auth from '../auth.js';

  export default {
    data() {
      return {
        posts: [],
        auth: auth,
        user: auth.user,
      };
    },

    created() {
      return auth.check();
    },

    computed: {
      orderedPosts() {
        return orderBy(this.posts, 'posted.date');
      }
    },

    mounted() {
      this.getPosts();
      window.unload = auth.signout();
    },

    methods: {
      getPosts() {
        let token = localStorage.getItem('id_token');

        if (token !== null) {
          axios.get('/api/elephpants?token=' + token).then(response => {
            this.posts = response.data.data;
          }).catch(error => {
            console.log(error);
          });
        } else {
          axios.get('/api/elephpants').then(response => {
            this.posts = response.data.data;
          }).catch(error => {
            console.log(error);
          });
        }
      },
    },

    filters: {
      date(value) {
        return new Moment(value.date).format('MM/DD/YYYY');
      }
    }
  };
</script>