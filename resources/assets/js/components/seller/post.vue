<style lang='scss'>

</style>
<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h2>Add New Elephpant</h2>
                <form method="post" enctype="multipart/form-data" @submit.prevent="submitElephpant">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';

  export default {

  };
</script>