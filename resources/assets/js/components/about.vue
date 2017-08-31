<style lang='scss'>

</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">About Elephpant Trade</h2>
                    <p>What started as a tweet has morphed into this. Credit goes to Colin O'Dell for the initial idea, and letting me run with it.</p>
                    <p>This is a completely open source project, passphrases not included. See something you think could be different, open an issue!</p>
                    <p>If you are feeling froggy, you can make a PR against the current code base. I just ask that you branch off what will soon be a develop branc.</p>
                    <p>Eventually, I promise, we will have a full CI suite, as well as social auth. We have some bigger ideas too!</p>
                    <p>If you or your company would like to help cover some server costs, that would be absolutely wonder, and you can find me on <a href="https://twitter.com/matthewtrask">twitter to talk!</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">Colophone</h2>
                    <p>This site was built with the following technologies:</p>
                    <ul>
                        <li>PHP 7.1</li>
                        <li>Laravel 5.4</li>
                        <li>Vue.js 2.x</li>
                        <li>Multiple PHP League Packages</li>
                        <li>Lodash</li>
                        <li>Bootstrap</li>
                        <li>AWS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../auth.js';
  import EtNav from './nav.vue';

  export default {
    created() {
      return auth.check();
    },

    data() {
      return {
        auth: auth,
        user: auth.user,
      }
    },

    components: {
      EtNav
    },
  };
</script>