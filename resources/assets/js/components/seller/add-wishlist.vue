<style lang='scss'>

</style>
<template>
    <div>
        <div class="row">
            <div class="alert alert-success" role="alert" v-if="showSuccess">
                <p> {{ elephpant }} was added </p>
            </div>
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <h2>Add Elephpant</h2>
                <form method="post" action="" @submit.prevent="addElephpant">
                    <div class="form-group">
                        <label for="elephpant">Elephpant</label>
                        <input type="text" class="form-control" id="elephpant" placeholder="elephpant" v-model="elephpant">
                    </div>
                    <div class="form-group">
                        <label for="wantLevel">How much do you want this elephpant? (1 is lowest, 5 is highest)</label>
                        <select id="wantLevel" class="form-control" v-model="desireLevel">
                            <option selected>Pick One</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5">Five</option>
                        </select>
                    </div>
                    <button class="btn btn-success">Submit</button>
                </form>
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
        elephpant: '',
        desireLevel: '',
        showSuccess: false,
      };
    },

    methods: {
      addElephpant() {
        let token = localStorage.getItem('id_token');

        axios.post('/api/elephpants/wishlist?token=' + token, {
          elephpant: this.elephpant,
          desireLevel: this.desireLevel,
        }).then(response => {
          this.showSuccess = true;

          setTimeout(() => {
            this.showSuccess = false;
          }, 5000);
        }).catch(error => {
          console.error(error);
        });
      },
    },
  };
</script>