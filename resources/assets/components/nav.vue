<style lang='scss'>

</style>
<template>
    <div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="/">
                        Elephpant Trade
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/wishlist"><img height="1rem" width="1rem" src="/img/default_user.png"> Wanted Elephpants</a></li>
                        <!-- Authentication Links -->
                        <li v-if="!this.user.profile"><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i>
                             Login</a></li>
                        <li v-if="!this.user.profile"><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i>
                             Register</a></li>
                        <li class="dropdown" v-if="this.user.profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ user.profile.name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/profile"><i class="fa fa-user" aria-hidden="true"></i>
                                     Profile</a></li>
                                <li>
                                    <a href @click.prevent="logUserOut">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                         Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../js/auth.js';

  export default {
    methods: {
      logUserOut() {
        return auth.signout();
      },
    },

    data() {
      return {
        auth: auth,
      };
    },

    props: ['user'],
  };
</script>