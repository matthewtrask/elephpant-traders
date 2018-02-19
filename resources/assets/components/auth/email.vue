<style lang='scss'>

</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="alert alert-danger" v-if="showErrorMessage">
                        <p class="text-center">There was an error logging you in. Please try again.</p>
                    </div>
                    <div class="alert alert-success" v-if="showErrorMessage">
                        <p class="text-center">Thanks for registering! Time to log in and get trading!</p>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="text-center">Elephpant Traders</h2>
                            <h4 class="text-center">Password Reset</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="/password/email">
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" required autofocus autocomplete='email'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../../js/auth.js';
  import EtNav from '../nav.vue';

  export default {
    created() {
      auth.check();
    },

    data() {
      return {
        auth: auth,
        user: auth.user || null,
      }
    },

    components: {
      EtNav,
    }
  };
</script>