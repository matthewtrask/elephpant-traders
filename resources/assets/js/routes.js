import VueRouter from 'vue-router';
import HomeComponent from '../components/home.vue';
import AboutComponent from '../components/about.vue';
import PostComponent from '../components/post.vue';
import SellerComponent from '../components/seller.vue';
import ProfileComponent from '../components/seller/profile.vue';
import ProfilePostComponent from '../components/seller/post.vue';
import ProfileWishlistComponent from '../components/seller/wishlist.vue';
import ProfileAddWishlistComponent from '../components/seller/add-wishlist.vue';
import RegisterComponent from '../components/auth/register.vue';
import LoginComponent from '../components/auth/login.vue';
import EmailResetComponent from '../components/auth/email.vue';
import PasswordResetComponent from '../components/auth/password.vue';

const routes = [
  {
    path: '/',
    component: HomeComponent,
    name: 'HomeComponent',
  },
  {
    path: '/about',
    component: AboutComponent,
    name: 'AboutComponent',
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
    path: '/profile/elephpant/wishlist',
    component: ProfileWishlistComponent,
    name: 'ProfileWishlistComponent',
    meta: { requiresAuth: false }
  },
  {
    path: '/profile/elephpant/wishlist/add',
    component: ProfileAddWishlistComponent,
    name: 'ProfileAddWishlistComponent',
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
  {
    path: '/password-reset',
    component: EmailResetComponent,
    name: 'EmailResetComponent',
  },
  {
    path: '/password/reset/:token',
    component: PasswordResetComponent,
    name: 'PasswordResetComponent',
  },
];

export default new VueRouter({
  routes,
  hashbang: false,
  linkActiveClass: 'active',
  mode: 'history',
});