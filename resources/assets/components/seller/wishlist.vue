<style lang='scss'>
    .fa-times {
        color: red;
    }

    .add {
        padding-top: 3rem;
        button.btn {
            float: right;
        }
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
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12 col-md-9">
                        <h2> {{ user.profile.name }}</h2>
                        <h4>Wishlist</h4>
                    </div>
                    <div class="col-xs-12 col-md-3 add">
                        <button class="btn btn-success"><router-link to="/profile/elephpant/wishlist/add">Add Elephpant</router-link></button>
                    </div>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Elephpant</th>
                            <th>Desire</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in user.profile.wishlist.data">
                            <td>{{ item.elephpant }}</td>
                            <td>{{ item.desire }}</td>
                            <td>{{ item.posted | date }}</td>
                            <td @click.prevent="removeElephpant(item.id)"><i class="fa fa-times" aria-hidden="true"></i> Remove</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import { remove } from 'lodash';
  import auth from '../../js/auth.js';
  import EtNav from '../nav.vue';
  import Moment from 'moment';

  export default {
    data() {
      return {
        auth: auth,
        user: auth.user,
        showAddModal: false,
      };
    },

    created() {
      this.checkAuth();
    },

    methods: {
      checkAuth() {
        return auth.check();
      },

      removeElephpant(id) {
        axios.delete('/api/elephpants/wishlist/' + id).then(response => {
          return auth.check();
        }).catch(error => {
          console.error(error);
        });
      },
    },

    filters: {
      date(value) {
        return new Moment(value.date).format('MM/DD/YYYY');
      }
    },

    components: {
      EtNav
    },
  };
</script>