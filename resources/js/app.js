/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';

import axios from 'axios';
import { Ziggy } from './ziggy';

import adminNavbar from './components/admin/NavBar.vue';
import adminNav from './components/admin/Nav.vue';
import adminFooter from './components/admin/Footer.vue';
import adminHeader from './components/admin/Header.vue';
import adminCardInfo from './components/admin/CardInfo.vue';
import adminChartLine from './components/admin/chart/chart-line.vue';
import adminChartLineGrandient from './components/admin/chart/chart-line-chart-gradient.vue';
import adminListGroupItem from './components/admin/ListGroupItem.vue';
import adminTable from './components/table/Table.vue';
import adminFilterSelect from './components/filter/SelectFilter.vue';
import adminFilterInput from './components/filter/InputFilter.vue';
import adminThead from './components/table/Thead.vue';
import adminTr from './components/table/Tr.vue';
import adminSubscriptionInfo from './components/admin/SubscriptionInfo.vue';
import adminReportNav from './components/admin/report/components/Nav.vue';
import adminReportFooter from './components/admin/report/components/Footer.vue';
import adminReportGeneral from './components/admin/report/general.vue';
import adminReportComment from './components/admin/report/comment.vue';
import adminCategoryCreate from './components/admin/category/create.vue';
import adminCategoryIndex from './components/admin/category/index.vue';
import adminCategoryTypeIndex from './components/admin/category-type/index.vue';
import adminCategoryTypeCreate from './components/admin/category-type/create.vue';
import adminClientIndex from './components/admin/client/index.vue';
import adminClientShow from './components/admin/client/show.vue';
import adminClientEdit from './components/admin/client/edit.vue';
import adminDashboard from './components/admin/dashboard/index.vue';
import adminDashboardRoot from './components/admin/dashboard/index-root.vue';
import adminIndicativeIndex from './components/admin/indicative-rating/index.vue';
import adminIndicativeCreate from './components/admin/indicative-rating/create.vue';
import adminPlanIndex from './components/admin/plan/index.vue';
import adminPlanCreate from './components/admin/plan/create.vue';
import adminPostIndex from './components/admin/post/index.vue';
import adminPostCreate from './components/admin/post/create.vue';
import adminPostShow from './components/admin/post/show.vue';
import adminPostEdit from './components/admin/post/edit.vue';
import adminMemberIndex from './components/admin/member/index.vue';
import adminMemberCreate from './components/admin/member/create.vue';
import adminMemberActive from './components/admin/member/active.vue';
import adminSubscriptionIndex from './components/admin/subscription/index.vue';
import adminSettingsCreate from './components/admin/setting/create.vue';
import adminLogIndex from './components/admin/log/index.vue';
import adminLogShow from './components/admin/log/show.vue';
import adminPermissionIndex from './components/admin/permission/index.vue';
import adminPermissionCreate from './components/admin/permission/create.vue';
import adminProfileCreate from './components/admin/profile/create.vue';
import componentTd from './components/table/Td.vue';
import componentSpanStatus from './components/SpanStatus.vue';
import componentDropdown from './components/Dropdown.vue';
import componentDropdownItem from './components/Dropdown-item.vue';
import componentCard from './components/Card.vue';
import componentAccordion from './components/Accordion.vue';
import componentAccordionItem from './components/Accordion-item.vue';
import componentInput from './components/Input.vue';
import componentSelect from './components/Select.vue';
import componentTextArea from './components/TextArea.vue';
import listGroup from './components/ListGroup.vue';
import listGroupItem from './components/ListGroup-item.vue';
import fixedBottom from './components/FixedBottom.vue';
import breadcrumb from './components/Breadcrumb.vue';
import model from './components/Model.vue';
import componentProgress from './components/Progress.vue';
import componentPaginate from './components/Paginate.vue';
import siteHeader from './components/site/Header.vue';
import siteFooter from './components/site/Footer.vue';
import siteSocialLinks from './components/site/SocialLinks.vue';
import siteNavBar from './components/site/NavBar.vue';
import siteNav from './components/site/Nav.vue';
import sitePost from './components/site/Post.vue';
import sitePlan from './components/site/Plan.vue';
import siteCarousel from './components/site/Carousel.vue';
import siteComment from './components/site/post/comment/Comment.vue';
import siteCreateComment from './components/site/post/comment/CreateComment.vue';
import siteChildrenComment from './components/site/post/comment/ChildrenComment.vue';
import siteCreateUser from './components/site/user/create.vue';
import siteMyAccount from './components/site/user/my-account.vue';
import siteIndexUser from './components/site/user/index.vue';
import siteHome from './components/site/home/index.vue';
import sitePostShow from './components/site/post/show.vue';
import siteCommentDestroy from './components/site/post/comment/delete.vue';
import siteCategoryIndex from './components/site/category/index.vue';
import siteCategoryShow from './components/site/category/show.vue';
import siteSearch from './components/site/search/index.vue';
import createPayment from './components/payment/create.vue';
import summaryPayment from './components/payment/summary.vue';
import fileUpload from './components/FilePond.vue';

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

const app = createApp({});
const pinia = createPinia();
app.use(pinia);

app.config.globalProperties.route = route;
app.provide('ziggy', Ziggy);

app.component('admin-navbar', adminNavbar);
app.component('admin-nav', adminNav);
app.component('admin-footer', adminFooter);
app.component('admin-header', adminHeader);
app.component('admin-card-info', adminCardInfo);
app.component('admin-chart-line', adminChartLine);
app.component('admin-chart-line-grandient', adminChartLineGrandient);
app.component('admin-list-group-item', adminListGroupItem);
app.component('admin-table', adminTable);
app.component('admin-filter-select', adminFilterSelect);
app.component('admin-filter-input', adminFilterInput);
app.component('admin-thead', adminThead);
app.component('admin-tr', adminTr);
app.component('admin-subscription-info', adminSubscriptionInfo);
app.component('admin-report-nav', adminReportNav);
app.component('admin-report-footer', adminReportFooter);
app.component('admin-report-general', adminReportGeneral);
app.component('admin-report-comment', adminReportComment);
app.component('admin-category-create', adminCategoryCreate);
app.component('admin-category-index', adminCategoryIndex);
app.component('admin-category-type-index', adminCategoryTypeIndex);
app.component('admin-category-type-create', adminCategoryTypeCreate);
app.component('admin-client-index', adminClientIndex);
app.component('admin-client-show', adminClientShow);
app.component('admin-client-edit', adminClientEdit);
app.component('admin-dashboard', adminDashboard);
app.component('admin-dashboard-root', adminDashboardRoot);
app.component('admin-indicative-index', adminIndicativeIndex);
app.component('admin-indicative-create', adminIndicativeCreate);
app.component('admin-plan-index', adminPlanIndex);
app.component('admin-plan-create', adminPlanCreate);
app.component('admin-post-index', adminPostIndex);
app.component('admin-post-create', adminPostCreate);
app.component('admin-post-show', adminPostShow);
app.component('admin-post-edit', adminPostEdit);
app.component('admin-member-index', adminMemberIndex);
app.component('admin-member-create', adminMemberCreate);
app.component('admin-member-active', adminMemberActive);
app.component('admin-subscription-index', adminSubscriptionIndex);
app.component('admin-settings-create', adminSettingsCreate);
app.component('admin-log-index', adminLogIndex);
app.component('admin-log-show', adminLogShow);
app.component('admin-permission-index', adminPermissionIndex);
app.component('admin-permission-create', adminPermissionCreate);
app.component('admin-profile-create', adminProfileCreate);
app.component('component-td', componentTd);
app.component('component-span-status', componentSpanStatus);
app.component('component-dropdown', componentDropdown);
app.component('component-dropdown-item', componentDropdownItem);
app.component('component-card', componentCard);
app.component('component-accordion', componentAccordion);
app.component('component-accordion-item', componentAccordionItem);
app.component('component-input', componentInput);
app.component('component-select', componentSelect);
app.component('component-text-area', componentTextArea);
app.component('list-group', listGroup);
app.component('list-group-item', listGroupItem);
app.component('fixed-bottom', fixedBottom);
app.component('breadcrumb', breadcrumb);
app.component('model', model);
app.component('component-progress', componentProgress);
app.component('component-paginate', componentPaginate);
app.component('site-header', siteHeader);
app.component('site-footer', siteFooter);
app.component('site-social-links', siteSocialLinks);
app.component('site-nav-bar', siteNavBar);
app.component('site-nav', siteNav);
app.component('site-post', sitePost);
app.component('site-plan', sitePlan);
app.component('site-carousel', siteCarousel);
app.component('site-comment', siteComment);
app.component('site-create-comment', siteCreateComment);
app.component('site-children-comment', siteChildrenComment);
app.component('site-create-user', siteCreateUser);
app.component('site-my-account', siteMyAccount);
app.component('site-index-user', siteIndexUser);
app.component('site-home', siteHome);
app.component('site-post-show', sitePostShow);
app.component('site-comment-destroy', siteCommentDestroy);
app.component('site-category-index', siteCategoryIndex);
app.component('site-category-show', siteCategoryShow);
app.component('site-search', siteSearch);
app.component('create-payment', createPayment);
app.component('summary-payment', summaryPayment);
app.component('list-group', listGroup);
app.component('list-group-item', listGroupItem);
app.component('fixed-bottom', fixedBottom);
app.component('breadcrumb', breadcrumb);
app.component('model', model);
app.component('file-upload', fileUpload);

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');