/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';

import axios from 'axios';
import { Ziggy } from './ziggy'

// Recupera o token CSRF do meta tag
const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.content;

// Configura o Axios para enviar o token CSRF em todas as requisições
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp();
const pinia = createPinia();
app.use(pinia);

app.config.globalProperties.route = route
app.provide('ziggy', Ziggy)

app.component('admin-navbar', require('./components/admin/NavBar.vue').default);
app.component('admin-nav', require('./components/admin/Nav.vue').default);
app.component('admin-footer', require('./components/admin/Footer.vue').default);
app.component('admin-header', require('./components/admin/Header.vue').default);
app.component('admin-card-info', require('./components/admin/CardInfo.vue').default);
app.component('admin-chart-line', require('./components/admin/chart/chart-line.vue').default);
app.component('admin-chart-line-grandient', require('./components/admin/chart/chart-line-chart-gradient.vue').default);
app.component('admin-list-group-item', require('./components/admin/ListGroupItem.vue').default);
app.component('admin-table', require('./components/table/Table.vue').default);
app.component('admin-filter-select', require('./components/filter/SelectFilter.vue').default);
app.component('admin-filter-input', require('./components/filter/InputFilter.vue').default);
app.component('admin-thead', require('./components/table/Thead.vue').default);
app.component('admin-tr', require('./components/table/Tr.vue').default);
app.component('admin-subscription-info', require('./components/admin/SubscriptionInfo.vue').default);

app.component('admin-category-create', require('./components/admin/category/create.vue').default);
app.component('admin-category-index', require('./components/admin/category/index.vue').default);
app.component('admin-category-type-index', require('./components/admin/category-type/index.vue').default);
app.component('admin-category-type-create', require('./components/admin/category-type/create.vue').default);
app.component('admin-indicative-index', require('./components/admin/indicative-rating/index.vue').default);
app.component('admin-indicative-create', require('./components/admin/indicative-rating/create.vue').default);
app.component('admin-plan-index', require('./components/admin/plan/index.vue').default);
app.component('admin-plan-create', require('./components/admin/plan/create.vue').default);
app.component('admin-post-index', require('./components/admin/post/index.vue').default);
app.component('admin-post-create', require('./components/admin/post/create.vue').default);
app.component('admin-post-show', require('./components/admin/post/show.vue').default);
app.component('admin-post-edit', require('./components/admin/post/edit.vue').default);
app.component('admin-member-index', require('./components/admin/member/index.vue').default);
app.component('admin-member-create', require('./components/admin/member/create.vue').default);
app.component('admin-member-active', require('./components/admin/member/active.vue').default);
app.component('admin-subscription-index', require('./components/admin/subscription/index.vue').default);
app.component('admin-settings-create', require('./components/admin/setting/create.vue').default);
app.component('admin-log-index', require('./components/admin/log/index.vue').default);
app.component('admin-log-show', require('./components/admin/log/show.vue').default);
app.component('admin-permission-index', require('./components/admin/permission/index.vue').default);
app.component('admin-permission-create', require('./components/admin/permission/create.vue').default);
app.component('admin-profile-create', require('./components/admin/profile/create.vue').default);

app.component('component-td', require('./components/table/Td.vue').default);
app.component('component-span-status', require('./components/SpanStatus.vue').default);
app.component('component-dropdown', require('./components/Dropdown.vue').default);
app.component('component-dropdown-item', require('./components/Dropdown-item.vue').default);
app.component('component-card', require('./components/Card.vue').default);
app.component('component-accordion', require('./components/Accordion.vue').default);
app.component('component-accordion-item', require('./components/Accordion-item.vue').default);
app.component('component-input', require('./components/Input.vue').default);
app.component('component-select', require('./components/Select.vue').default);
app.component('component-text-area', require('./components/TextArea.vue').default);
app.component('list-group', require('./components/ListGroup.vue').default);
app.component('list-group-item', require('./components/ListGroup-item.vue').default);
app.component('fixed-bottom', require('./components/FixedBottom.vue').default);
app.component('breadcrumb', require('./components/Breadcrumb.vue').default);
app.component('model', require('./components/Model.vue').default);
app.component('component-progress', require('./components/Progress.vue').default);

app.component('site-header', require('./components/site/Header.vue').default);
app.component('site-social-links', require('./components/site/SocialLinks.vue').default);
app.component('site-nav-bar', require('./components/site/NavBar.vue').default);
app.component('site-nav', require('./components/site/Nav.vue').default);
app.component('site-post', require('./components/site/Post.vue').default);
app.component('site-plan', require('./components/site/Plan.vue').default);
app.component('site-carousel', require('./components/site/Carousel.vue').default);
app.component('site-comment', require('./components/site/Comment.vue').default);
app.component('site-create-comment', require('./components/site/CreateComment.vue').default);
app.component('site-children-comment', require('./components/site/ChildrenComment.vue').default);
app.component('site-create-user', require('./components/site/user/create.vue').default);
app.component('site-my-account', require('./components/site/user/my-account.vue').default)
app.component('site-index-user', require('./components/site/user/index.vue').default);

app.component('create-payment', require('./components/payment/create.vue').default)
app.component('summary-payment', require('./components/payment/summary.vue').default)
app.component('list-group', require('./components/ListGroup.vue').default);
app.component('list-group-item', require('./components/ListGroup-item.vue').default);
app.component('fixed-bottom', require('./components/FixedBottom.vue').default);
app.component('breadcrumb', require('./components/Breadcrumb.vue').default);
app.component('model', require('./components/Model.vue').default);
app.component('file-upload', require('./components/FilePond.vue').default);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
