<style lang='scss'>
    .image {
        height: 10rem;
        width: 10rem;
    }
</style>
<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h2>{{ seller.name }}</h2>
                <img v-bind:src="seller.image" class="image img-responsive img-circle" alt="Responsive image">
                <a v-bind:href="'https://twitter.com/' + seller.twitter">@{{ seller.twitter }}</a>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-xs-12 col-md-4" v-for="post in posts">
                <div class="thumbnail">
                    <img :src="post.image" alt="...">
                    <div class="caption">
                        <h3>{{ post.title }}</h3>
                        <p>Seller: {{ post.seller }}</p>
                        <p>Posted: {{ post.posted | date }}</p>
                        <p>{{ post.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import Moment from 'moment';
  import { orderBy } from 'lodash';

  export default {
    created() {
      axios.get(`/api/elephpants/sellers/${this.$route.params.id}`).then(response => {
        this.seller = response.data.data;
      }).catch(error => {
        console.error(error);
      });
    },

    data() {
      return {
        seller: '',
        posts: [],
      };
    },

    watch: {
      seller(value) {
        console.log(value);
        this.posts = value.posts.data;
      }
    },

    filters: {
      date(value) {
        return Moment(value.date).format('MM/DD/YYYY');
      },
    },
  };
</script>