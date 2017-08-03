<style lang='scss'>
    .description {
        padding-top: 6rem;
    }
</style>
<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
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
                        <h4>Wanted Elephpants</h4>
                        <ul v-for="elephpant in wanted">
                            <li> {{ elephpant.elephpant }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import Moment from 'moment';

  export default {
    created() {
      axios.get(`/api/elephpants/post/${this.$route.params.id}`).then(response => {
        this.post = response.data.data[0];
      }).catch(error => {
        console.error(error);
      });
    },

    data() {
      return {
        post: '',
        wanted: [],
      };
    },

    watch: {
      post(post) {
        this.wanted = this.post.wanted.data;
      }
    },

    filters: {
      date(value) {
        return Moment(value.date).format('MM/DD/YYYY');
      }
    }
  };
</script>