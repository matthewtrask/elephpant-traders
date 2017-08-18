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
                <p class="text-right"><button class="btn btn-success"><router-link to="/profile/elephpant/post">Add Elepahant</router-link></button></p>
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
                    <img :src="post.image" alt="...">
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
</template>
<script>
  import axios from 'axios';
  import auth from '../../auth.js';
  import Moment from 'moment';

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
    },

    created() {
      return auth.check();
    },

    filters: {
      date(value) {
        return Moment(value.date).format('MM/DD/YYYY');
      },
    }
  };
</script>