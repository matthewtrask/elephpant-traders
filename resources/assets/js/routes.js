import VueRouter from 'vue-router';
import HomeComponent from './components/home.vue';
import PostComponent from './components/post.vue';
import SellerComponent from './components/seller.vue';
import ProfileComponent from './components/seller/profile.vue';
import ProfilePostComponent from './components/seller/post.vue';
import RegisterComponent from './components/auth/register.vue';
import LoginComponent from './components/auth/login.vue';


const routes = [
  {
    path: '/',
    component: HomeComponent,
    name: 'HomeComponent',
  },
  {
    path: '/posts/:id',
    component: PostComponent,
    name: 'PostComponent',
  },
  {
    path: '/sellers/:id',
    component: SellerComponent,
    name: 'SellerComponent',
  },
  {
    path: '/profile',
    component: ProfileComponent,
    name: 'ProfileComponent',
    meta: { requiresAuth: false }
  },
  {
    path: '/profile/elephpant/post',
    component: ProfilePostComponent,
    name: 'ProfilePostComponent',
    meta: { requiresAuth: false }
  },
  {
    path: '/register',
    component: RegisterComponent,
    name: 'RegisterComponent',
  },
  {
    path: '/login',
    component: LoginComponent,
    name: 'LoginComponent',
  },
];

export default new VueRouter({
  hashbang: false,
  routes
});