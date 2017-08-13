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
</style>
<template>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <h1> {{ user.profile.name }}</h1>
                <img v-bind:src="user.profile.image" class="image img-responsive img-circle" alt="Responsive image">
            </div>
            <div class="col-sm-12 col-md-8">
                <h3 class="text-right">Profile Information</h3>
                <p class="text-right"><a  v-bind:href="'https://twitter.com/' + user.profile.twitter">@{{ user.profile.twitter }}</a></p>
                <p class="text-right">Elephpants posted: {{ user.profile.elephpantCount }}</p>
                <p class="text-right"><button class="btn btn-success"><router-link to="ProfilePostComponent">Add Elepahant</router-link></button></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4" v-for="post in user.profile.posts.data">
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
  import auth from '../../auth.js';

  export default {
    data() {
      return {
        auth: auth,
        user: auth.user,
      }
    },

    created() {
      return auth.check();
    },
  };
</script>