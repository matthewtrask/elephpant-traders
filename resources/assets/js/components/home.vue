<style lang='scss'>
  .thumbnail {
    box-shadow: 5px 5px 2px #888888;
  }
</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Elephpant Trade <small>{{ randomSubheading }}</small></h1>
                        <p>This is a community driven site aimed at helping people trade elephpants.</p>
                        <p>For more information on the elephpants themselves, check out <a href="http://afieldguidetoelephpants.net/">A Field Guide To Elephpants</a></p>
                    </div>
                </div>
            </div>
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
    </div>
</template>
<script>
  import axios from 'axios';
  import { orderBy, sample } from 'lodash';
  import Moment from 'moment';
  import auth from '../auth.js';
  import EtNav from './nav.vue';

  export default {
    data() {
      return {
        posts: [],
        auth: auth,
        user: auth.user,
        subheading: [
          'Community driven elephpant migration.',
          'Migrating the herd since 2017.',
          'Get that elephpant you have always wanted. For a price.',
        ]
      };
    },

    created() {
      return auth.check();
    },

    computed: {
      orderedPosts() {
        return orderBy(this.posts, 'posted.date');
      },

      randomSubheading() {
        return sample(this.subheading);
      }
    },

    mounted() {
      this.getPosts();
    },

    methods: {
      getPosts() {
        axios.get('/api/elephpants').then(response => {
          this.posts = response.data.data;
        }).catch(error => {
          console.log(error);
        });
      },
    },

    filters: {
      date(value) {
        return new Moment(value.date).format('MM/DD/YYYY');
      }
    },

    components: {
      EtNav,
    },
  };
</script>
