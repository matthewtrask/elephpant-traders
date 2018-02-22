<style lang='scss' scoped>
  .thumbnail {
      box-shadow: 0px 3px 15px rgba(0,0,0,0.2);
  }

  a.link {
    color: #1f648b;
    &:hover {
      color: #1f648b;
    }
  }

  .image {
    height: 35rem;
    width: 225rem;
  }

  .thumbnail {
    min-height: 58rem;
    max-height: 58rem;
  }

    .text-3xl {
        font-size: 6rem;
    }
</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h3>Elephpant Trade</h3>
                        <h1>{{ randomSubheading }}</h1>
                        <p>This is a community driven site aimed at helping people trade elephpants.</p>
                        <p>For more information on the elephpants themselves, check out <a class="link" href="http://afieldguidetoelephpants.net/">A Field Guide To Elephpants</a></p>
                        <p><a class="link" v-bind:href="'/login'">Sign In</a> or <a class="link" v-bind:href="'/register'">Register</a> to post an elephpant or make a trade!</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div>
                        <h3>Elephpants Migrated</h3>
                        <p class="lead text-3xl">{{ count.completedTradeCount }}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div>
                        <h3>Pending Migration</h3>
                        <p class="lead text-3xl">{{ count.pendingTradeCount }}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div>
                        <h3>Total Elephpants</h3>
                        <p class="lead text-3xl">{{ count.totalElephpant }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4" v-for="post in orderedPosts">
                    <div class="thumbnail">
                        <img class="image" :src="post.image" alt="...">
                        <div class="caption">
                            <h3>{{ post.title }} <span v-if="post.newPost === true" class="label label-success">New Post!</span>
                            </h3>
                            <p>Seller: {{ post.seller }}</p>
                            <p>Posted: {{ post.posted | date }}</p>
                            <p>
                                <a v-bind:href="'/posts/' + post.id"  class="btn btn-primary" role="button">View Post</a>
                                <a v-bind:href="'/sellers/' + post.sellerId" class="btn btn-default" role="button">View Seller</a>
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
  import auth from '../js/auth.js';
  import EtNav from './nav.vue';

  export default {
    data() {
      return {
        posts: [],
        auth: auth,
        user: auth.user || null,
        count:[],
        subheading: [
          'Community driven elephpant migration.',
          'Migrating the herd since 2017.',
          'Get that elephpant you have always wanted. For a price.',
        ]
      };
    },

    created() {
      auth.check();
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
      this.getCount();
    },

    methods: {
      getPosts() {
        axios.get('/api/elephpants').then(response => {
          this.posts = response.data.data;
        }).catch(error => {
          console.log(error);
        });
      },

      getCount() {
        axios.get('/api/elephpants/count').then(response => {
          this.count = response.data.data[0];
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
