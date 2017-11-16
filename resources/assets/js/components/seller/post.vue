<style lang='scss'>

</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <h2 class="text-center">Add New Elephpant</h2>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data" @submit.prevent="upload">
                        <div class="form-group">
                            <label for="postTitle" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="postTitle" placeholder="Title (make it stand out!)" v-model="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postDescription" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea rows="10" class="form-control" id="postDescription" placeholder="Describe the elephpant, is it signed? Is it a rare conference elephpant?" v-model="description"></textarea>
                                <small>Markdown is supported</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <vue-core-image-upload
                                        :class="['btn', 'btn-success']"
                                        :crop="false"
                                        @imageuploaded="imageuploaded"
                                        inputOfFile="elephpant"
                                        :data="data"
                                        :max-file-size="5242880"
                                        url="/api/elephpants/image" >
                                </vue-core-image-upload>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Save Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import axios from 'axios';
  import auth from '../../auth.js';
  import VueCoreImageUpload  from 'vue-core-image-upload';
  import EtNav from '../nav.vue';

  export default {
    data() {
      return {
        auth: auth,
        user: auth.user,
        title: '',
        description: '',
        image: '',
        showSuccess: false,
        token: '',
      };
    },

    created() {
      return auth.check();
    },

    methods: {
      upload() {
        let token = localStorage.getItem('id_token');

        axios.post('/api/elephpants', {
          headers: {
            'Authorization': 'Bearer ' + token,
          },
          title: this.title,
          description: this.description,
          image: this.image,
          userId: this.user.profile.id,
        }).then(response => {
          this.showSuccess = true;
          window.location.replace('/#/profile');
        }).catch(error => {
          console.error(error);
        });
      },

      imageuploaded(res) {
        this.image = res.split('/')[1];
      },
    },

    components: {
      VueCoreImageUpload,
      EtNav
    },
  };
</script>