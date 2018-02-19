<style lang='scss'>
    .error {
        border: 1px solid red;
    }

    .disabled {
        pointer-events: none;
    }
</style>

<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="alert alert-danger" v-if="showErrorBanner">
                        <p class="text-center">There was an error creating your account. Please try again in a bit.</p>
                    </div>

                    <div class="alert alert-danger" v-if="showPasswordBanner">
                        <p class="text-center">The password entered does not match the confirmed password. Please try again.</p>
                    </div>

                    <div class="alert alert-success" v-if="showSuccessBanner">
                        <p class="text-center">Your account was made, time to log in!</p>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="text-center">Elephpant Trade Register</h2>
                        </div>
                        <div class="panel-body">
                            <form class="col-xs-8 col-xs-offset-2" method="post" @submit.prevent="submitUserForm">
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" class="form-control" id="username" placeholder="Email" v-model="email">
                                </div>
                                <div class="form-group">
                                    <label for="firstName">Name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Name" v-model="name">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" placeholder="Twitter" v-model="twitter">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <small>(minimum 8 characters)</small></label>
                                    <input v-bind:class="{ error: showPasswordBanner }" type="password" class="form-control" id="password" placeholder="Password" v-model="password">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input v-bind:class="{ error: showPasswordBanner }" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" v-model="confirmPassword">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" v-bind:class="{ disabled: disabled}">Submit</button>
                                    <button class="btn btn-default" @click.prevent="emptyForm">Cancel</button>
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
  import auth from '../../js/auth';
  import EtNav from '../nav.vue';

  export default {

    mounted() {
      this.$nextTick(() => {
        auth.check();
      });
    },

    data() {
      return {
        email: '',
        name: '',
        twitter: '',
        password: '',
        confirmPassword: '',
        showSuccessBanner: false,
        showErrorBanner: false,
        showPasswordBanner: false,
        disabled: false,
        auth: auth,
        user: auth.user || null,
      };
    },

    methods: {
      submitUserForm() {
        if (this.password !== this.confirmPassword || this.password.length < 7) {
          this.showPasswordBanner = true;
        }

        this.createUser();
      },

      createUser() {
        const register = auth.register(this, this.email, this.password, this.name, this.twitter);
      },

      emptyForm() {
        this.name = '';
        this.email = '';
        this.twitter = '';
        this.password = '';
        this.confirmPassword = '';
      },
    },

    components: {
      EtNav,
    }
  };
</script>