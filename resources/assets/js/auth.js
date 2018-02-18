import axios from 'axios';
import router from './routes.js';

export default {
  user: {
    authenticated: false,
    profile: null,
  },

  check() {
    let token = localStorage.getItem('id_token');
    if (token !== null) {

      axios.get('/api/user', {
        headers: {
          'Authorization': `Bearer ${token}`,
        },
      }).then(response => {
        this.user.authenticated = true;
        this.user.profile = response.data.data;
      });
    }
  },

  register(context, email, password, name, twitter) {
    return axios.post('api/register', {
      email: email,
      password: password,
      name: name,
      twitter: twitter,
    }).then(response => {
      context.success = true;
      router.push({
        name: 'LoginComponent',
      });

      router.push({
        name: 'LoginComponent'
      }, response => {
        context.error = true
      });
    }, response => {
      context.response = response.data;
      context.error = true;
    });
  },

  signin(context, email, password, rememberMe) {
    axios.post('/oauth/token', {
      grant_type: 'password',
      client_id: 2,
      client_secret: 'cwX10cEUXvwpVp7SxFFB5n2TAJjsepbFIotv8UtH',
      username: email,
      password: password,
      rememberMe: rememberMe,
    }).then(response => {
      context.error = false;
      localStorage.setItem('id_token', response.data.access_token);
      window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');

      this.user.authenticated = true;
      this.user.profile = response.data.user;
      this.user.posts = response.data.posts;

      router.push({
        name: 'ProfileComponent'
      }, response => {
        context.error = true
      });
    });
  },

  signout() {
    localStorage.removeItem('id_token');
    this.user.authenticated = false;
    this.user.profile = null;
    window.location.href = '/';
  },
};