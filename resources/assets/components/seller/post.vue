<style lang='scss'>
    .vue-dropzone {
        border: 2px dashed #8795A1;
        margin-right: 1.5rem;
        width: 62rem;
        float: right;
    }
</style>
<template>
    <div>
        <et-nav :user="user"></et-nav>
        <div class="container">
            <div class="row">
                <div class="alert alert-danger" role="alert" v-if="showError"><i class="fa fa-times-circle" aria-hidden="true"></i>
                    There was an error marking this Elephpant for trade. Please try again soon!
                </div>

                <div class="alert alert-success" role="alert" v-if="showSuccess === true"><i class="fa fa-check" aria-hidden="true"></i>
                    Your elephpant was posted and is ready to be traded!
                </div>


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
                                <div class="alert alert-success" role="alert" v-if="imageUploaded"><i class="fa fa-check" aria-hidden="true"></i>
                                     Your image was uploaded successfully!
                                </div>
                            </div>
                            <vue-dropzone
                                    ref="myVueDropzone"
                                    id="dropzone"
                                    :options="dropzoneOptions"
                                    v-on:vdropzone-thumbnail="thumbnail"
                                    v-on:vdropzone-success="success">
                            </vue-dropzone>
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
  import VueDropzone from 'vue2-dropzone';
  import 'vue2-dropzone/dist/vue2Dropzone.css';
  import auth from '../../js/auth.js';
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
        showError: false,
        imageUploaded: false,
        dropzoneOptions: {
          acceptedFiles: 'image/*',
          url: '/api/elephpants/image',
          thumbnailWidth: 150,
          maxFilesize: 2,
          dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> UPLOAD",
          headers: { 'Authorization': `Bearer ${localStorage.getItem('id_token')}` },
        },
      };
    },

    created() {
      return auth.check();
    },

    methods: {
      upload() {
        axios.post('/api/elephpants', {
          title: this.title,
          description: this.description,
          image: this.image,
          userId: this.user.profile.id,
        }, {
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('id_token'),
          },
        }).then(response => {
          this.showSuccess = true;

          setTimeout(() => {
            this.showSuccess = false;
            window.location.replace('/#/profile');
          }, 5000);
        }).catch(error => {
          this.showError = true;

          setTimeout(() => {
            this.showError = false;
          }, 5000);
        });
      },

      success(res) {
        this.imageUploaded = true;
        this.image = res.name;
      },
    },

    components: {
      EtNav,
      VueDropzone
    },
  };
</script>