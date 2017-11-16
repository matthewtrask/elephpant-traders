<style lang='scss'>
    .image {
      height: 10rem;
      width: 10rem;
    }

    a {
      color: #fff;
      &:hover {
        color: #fff;
      }
    }

    a.twitter, a.trade {
        color: #1f648b;
        &:hover {
            color: #1f648b;
        }
    }

    .pending {
        color: #FFEB3B;
    }

    .declined {
        color: #F44336;
    }

    .accepted {
        color: #4CAF50;
    }

    .elephpant-image {
        height: 24rem;
    }
</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h1> {{ user.profile.name }}</h1>
                    <img v-bind:src="user.profile.image" class="image img-responsive img-circle" alt="Responsive image">
                </div>
                <div class="col-sm-12 col-md-8">
                    <h3 class="text-right">Profile Information</h3>
                    <p class="text-right"><a  v-bind:href="'https://twitter.com/' + user.profile.twitter" class="twitter">@{{ user.profile.twitter }}</a></p>
                    <p class="text-right">Elephpants posted: {{ user.profile.elephpantCount }}</p>
                    <p class="text-right"><button class="btn btn-success"><router-link tag="a" to="/profile/elephpant/post">Add Elephpant</router-link></button></p>
                    <p class="text-right"><button class="btn btn-success"><router-link tag="a" to="/profile/elephpant/wishlist">Edit Wishlist</router-link></button></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Elephpant</th>
                            <th>Buyer</th>
                            <th>Received</th>
                            <th>Approved At</th>
                            <th>Approve</th>
                            <th>Decline</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="trade in user.profile.trades.data">
                            <td><i class="fa fa-circle" v-bind:class="{ 'pending': trade.status === 'pending', 'accepted': trade.status === 'accepted', 'declined': trade.status === 'declined' }"></i></td>
                            <td>{{ trade.elephpant }}</td>
                            <td>{{ trade.buyer }}</td>
                            <td>{{ trade.received }}</td>
                            <td>{{ trade.approvedAt }}</td>
                            <td><a class="trade" href="" @click.prevent="approveTrade(trade.id)">Approve</a></td>
                            <td><a class="trade" href="" @click.prevent="declineTrade(trade.id)">Decline</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <h2>Elephpants posted by you</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4" v-for="post in user.profile.posts.data">
                    <div class="thumbnail">
                        <img class="elephpant-image" :src="post.image" alt="...">
                        <div class="caption">
                            <h3>{{ post.title }}</h3>
                            <p>Seller: {{ post.seller }}</p>
                            <p>Posted: {{ post.posted | date }}</p>
                            <p>{{ post.description }}</p>
                            <p>
                                <a v-bind:href="'/#/elephpant/' + post.id + '/edit'"  class="btn btn-primary" role="button">Edit Post</a>
                                <a @click="removePost(post.id)" class="btn btn-default" data-toggle="modal" data-target="#myModal" role="button">Remove Post</a>
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
  import auth from '../../auth.js';
  import Moment from 'moment';
  import EtNav from '../nav.vue';

  export default {
    data() {
      return {
        auth: auth,
        user: auth.user,
        showConfirmModal: false,
        postId: '',
      }
    },

    methods:{
      removePost(postId) {
        axios.delete(`/api/elephpants/remove/${postId}`).then(response => {
          auth.check();
        }).catch(error => {
          console.error(error);
        });
      },

      approveTrade(tradeId) {
        axios.put('/api/elephpants/trade', { postId: tradeId, sellerId: this.user.profile.id }).then(response => {
          return auth.check();
        }).catch(error => {
          console.log(error);
        })
      },

      declineTrade(tradeId) {
        axios.delete(`/api/elephpants/trade/${tradeId}`).then(response => {
          return auth.check();
        }).catch(error => {
          console.log(error);
        });
      },
    },

    created() {
      return auth.check();
    },

    filters: {
      date(value) {
        return Moment(value.date).format('MM/DD/YYYY');
      },
    },

    components: {
      EtNav,
    },
  };
</script>