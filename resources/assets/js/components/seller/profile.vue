<style lang='scss'>

</style>
<template>
    <div>

    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../../auth.js';

  export default {
    data() {
      return {
        auth: auth,
      }
    },

    created() {
      auth.check();
    },
  };
</script>