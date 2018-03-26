<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/



/* admin login, dashboard and forgot password */
$route['admin'] = "admin/index";
$route['comments'] = "user_account/comments";
$route['post-comment'] = "user_account/postComment";
$route['backend/change-languageversion-for-functionality'] = "admin/change_language_for_functionality";


$route['backend'] = "admin/index";
$route['backend/login'] = "admin/index";
$route['backend/index'] = "admin/index";
$route['backend/home'] = "admin/home";
$route['backend/dashboard'] = "admin/home";
$route['backend/log-out'] = "admin/logout";
$route['backend/forgot-password'] = "admin/forgotPassword";
$route['backend/forgot-password-email'] = "admin/checkForgotPasswordEmail";
/* admin login, dashboard and forgot password end here */

/* Global Settings:   */
$route['backend/global-settings/list']="global_setting/listGlobalSettings";
$route['backend/global-settings/edit/(:any)'] = "global_setting/editGlobalSettings/$1/$2";
$route['backend/global-settings/edit-parameter-language/(:any)'] = "global_setting/editParameterLanguage/$1";
$route['backend/global-settings/get-global-parameter-language'] = "global_setting/getGlobalParameterLanguage";
/* Global Settings End Here */

/* Manage Role: */
$route['backend/role/list']="role/listRole";
$route['backend/role/edit/(:any)']="role/addRole/$1";
$route['backend/role/add']="role/addRole";
$route['backend/role/check-role']="role/checkRole";
/* Manage Role End Here */

/* Manage Admin  */
$route['backend/admin/list']="admin/listAdmin";
$route['backend/admin/change-status']="admin/changeStatus";
$route['backend/admin/add']="admin/addAdmin";
$route['backend/admin/check-admin-username']="admin/checkAdminUsername";
$route['backend/admin/check-admin-email']="admin/checkAdminEmail";
$route['backend/admin/account-activate/(:any)']="admin/activateAccount/$1";
$route['backend/admin/edit/(:any)']="admin/editAdmin/$1";
$route['backend/admin/profile']="admin/adminProfile";
$route['backend/admin/edit-profile']="admin/editProfile";
$route['backend/country-change-language/(:any)'] = "countries/changeLanguage/$1";
$route['backend/country/country-name']="countries/getAllCountryNames";
/* Manage Admin End Here */

/*
 * Manage User Start Here
 */
$route['backend/user/list']="user/listUser";
$route['backend/user/w-list']="user/listWUser";
$route['backend/user/change-status']="user/changeStatus";
$route['backend/user/add']="user/addUser";
$route['backend/user/check-user-username']="user/checkUserUsername";
$route['backend/user/check-user-email']="user/checkUserEmail";
$route['backend/user/account-activate/(:any)']="user/activateAccount/$1";
$route['backend/user/edit/(:any)']="user/editUser/$1";
$route['backend/user/view/(:any)']="user/userProfile/$1";
$route['backend/user/delete-user/(:any)']="user/deleteUser/$1";
$route['backend/user/reverification-link/(:any)']="user/reverificationLink/$1/$2";
$route['backend/user/change-status-email']="user/changeStatusEmail";
/*
 * Manage User End Here
 */

/*
 * Manage email template routes
 */
$route['backend/email-template/list']="email_template/index";
$route['backend/edit-email-template/(:any)']="email_template/editEmailTemplate/$1";

/*
 * Manage email template routes end
 */
/*
 * Manage notification-template routes
 */
$route['backend/notification-template/list']="notification_template/index";
$route['backend/notification-template/add']="notification_template/add";
$route['backend/edit-notification-template/(:any)']="notification_template/editNotificationTemplate/$1";
$route['backend/send-notification/(:any)']="notification/sendNotification/$1";

/*
 * Manage notification-template routes end
 */

#Manage Categories End Here
//contact us
$route['backend/contact-us']="contact_us/listContactUs";
$route['backend/contact-us/view/(:any)']="contact_us/view/$1";
$route['backend/contact-us/reply/(:any)']="contact_us/reply/$1";

//cms
$route['backend/cms']="cms/listCMS";
$route['backend/cms/edit-cms/(:any)']="cms/editCMS/$1";
$route['backend/cms/edit-cms-language/(:any)'] = "cms/editCmsLanguage/$1";
$route['backend/cms/get-cms-language'] = "cms/getCmsLanguage";
/**Common  Editor validation while uploading image file  route  here **/
$route['upload-image'] = "cms/uploadImage";


/*** Manage Categories **/
$route['backend/categories/list']="category/listCategory";
$route['backend/category/add-category']="category/addCategory";
$route['backend/category/edit-category/(:any)']="category/editCategory/$1";
$route['backend/change-category-language/(:any)']="category/changeLanguage/$1";
$route['backend/category/check-category-name']="category/checkCategoryName";
$route['backend/category/category-name']="category/getAllCategoryNames";
$route['backend/categories/validate-page-url']="category/validatePageUrl";
$route['backend/categories/get-language-for-categories']="category/getLanguageForCategories";
$route['category-detail/(:any)']="category/handleCleanUrls/$1";
$route['categories-home/(:any)']="category/categoriesHome/$1";
$route['categories-home']="category/categoriesHome";


$route['backend/products']="product/listProductBackend";
$route['backend/change-status-product'] = "product/changeProductStatus";
$route['backend/product/add-product']="product/addProduct";
$route['backend/edit-product/(:any)'] = "product/editProductBackend/$1";
$route['backend/view-product/(:any)'] = "product/viewProductBackend/$1";

/* Manage FAQs Backend side Start */
$route['backend/faqs/list']="faqs/listFAQS";
$route['backend/faqs/add']="faqs/addFAQ";
$route['backend/faqs/add/(:any)']="faqs/addFAQ/$1";
$route['backend/faqs/lang-faq/(:any)']="faqs/addLangFAQ/$1";
$route['backend/faqs/delete']="faqs/deleteFAQ";
$route['backend/faqs/categories']="faqs/getFaqCategories";
$route['backend/faqs/lang-category/(:any)']="faqs/langCategory/$1";
$route['backend/faqs/get-language-for-faq']="faqs/getLanguageForFaq";
$route['backend/faqs/validate-page-url']="faqs/validatePageUrl";
$route['backend/faqs/get-language-for-categories']="faqs/getLanguageForCategories";
$route['backend/faqs/delete-category']="faqs/deleteCategory";
$route['backend/faqs/add-category']="faqs/addFaqCategories";
$route['backend/faqs/add-category/(:any)']="faqs/addFaqCategories/$1";
$route['backend/faqs/check-duplicate-category-name']="faqs/checkDuplicateCategoryName";
$route['backend/faqs/change-status']="faqs/changeStatus";
/* Manage FAQs Backend side End */

/* Manage FAQs Backend side End */
$route['faqs']="faqs/index";
/* Manage FAQs Backend side End */


/* Manage countries here */
$route['backend/countries']="countries/countriesList";
$route['backend/manage-countries']="countries/deleteCountriesList";
$route['backend/delete-countries']="countries/deleteCountriesList";
$route['backend/countries/edit-country/(:any)']="countries/editCountry/$1";
$route['backend/countries/add']="countries/addCountry";
$route['backend/check-country-name']="countries/checkCountryName";
$route['backend/check-country-iso']="countries/checkCountryIso";
/* Manage countries end*/

/* Manage States here */
$route['backend/states']="states/statesList";
$route['backend/delete-states']="states/deleteStatesList";
$route['backend/states/add']="states/addState";
$route['backend/states/edit-states/(:any)']="states/editStates/$1";
$route['backend/check-states-name']="states/checkStatesName";

$route['backend/state-change-language/(:any)'] = "states/changeLanguage/$1";
$route['backend/state/state-name']="states/getAllStateNames";
/* Manage States end */

/* Manage Cities */
$route['backend/cities']="city/listCity";
$route['backend/manage-cities']="city/deleteCity";
$route['backend/cities/add']="city/addCity";
$route['backend/cities/edit-city/(:any)']="city/editCity/$1";
$route['backend/check-city-name']="city/checkCityName";
$route['backend/get-state-info']="city/getAllStateInfo";
$route['get-sub-category']="category/getSubCategory";

$route['backend/city-change-language/(:any)'] = "city/changeLanguage/$1";
$route['backen/city/get-all-city-names'] = "city/getAllCityNames";


/* Manage Cities end */

/* Database Error Page */
$route['page-not-found']="cms/databaseError";
/* Database Error Page */

/*
 * Manage slider banner routes
 */
$route['backend/slider-banner/list-sliders-banners']="slider_banner/index";
$route['backend/slider-banner/add-sliders-banner']="slider_banner/addNewSliderBanner";
$route['backend/slider-banner/delete-sliders-banners']="slider_banner/deleteSlidersBanners";
$route['backend/slider-banner/edit-sliders-banner/(:any)']="slider_banner/editSliderBanner/$1";
$route['backend/slider-banner/edit-sliders-banner']="slider_banner/editSliderBanner";
$route['backend/slider-banner/edit-slider-banner-object/(:any)']="slider_banner/editSliderBannerObject/$1";
$route['backend/slider-banner/edit-sliders-banner-object']="slider_banner/editSliderBannerObject";
$route['backend/slider-banner/change-slider-banner-status']="slider_banner/updateSliderStatus";
$route['backend/slider-banner/change-slider-banner-object-status']="slider_banner/updateSliderBannerObjectStatus";
$route['backend/slider-banner/slider-banner-more-details/(:any)']="slider_banner/sliderBannerMoreDetails/$1";
$route['backend/slider-banner/list-sliders-banner-objects/(:any)']="slider_banner/sliderBannerObject/$1";
$route['backend/slider-banner/add-slider-banner-object/(:any)']="slider_banner/addsliderBannerObject/$1";
$route['backend/slider-banner/duplicate-banner-object-details/(:any)']="slider_banner/duplicateSliderBannerObject/$1";
$route['backend/slider-banner/slider-banner-object-more-details/(:any)']="slider_banner/sliderBannerObjectMoreDetails/$1";
$route['backend/slider-banner/delete-slider-banner-object']="slider_banner/deleteSlidersBannersObjects";


/*  Manage slider banner routes end */
 

/* FrontEnd Routes Start */

$route['default_controller'] = "admin/index";

/* User login and registration section start */
$route['signup'] = "register/userRegistration";
$route['fb-signup'] = "register/fbUserRegistration";
$route['chk-email-duplicate'] = "register/chkEmailDuplicate";
$route['chk-email-exist'] = "register/chkEmailExist";
$route['generate-captcha/(:any)'] = "register/generateCaptcha/$1";
$route['check-captcha'] = "register/checkCaptcha";
$route['chk-username-duplicate'] = "register/chkUserDuplicate";
$route['user-activation/(:any)'] = "register/userActivation/$1";
$route['signin']="register/signin";
$route['password-recovery'] = "register/passwordRecovery";
$route['reset-password/(:any)']="register/resetPassword/$1";
$route['reset-password']="register/resetPassword";
/*
 *  User login and registration section end 
 */

/*
 *  User account section start 
 */
$route['profile']="user_account/profile";
$route['profile/edit']="user_account/editProfile";
$route['chk-edit-email-duplicate'] = "user_account/chkEditEmailDuplicate";
$route['chk-edit-username-duplicate'] = "user_account/chkEditUsernameDuplicate";
$route['profile/account-setting']="user_account/accountSetting";
$route['edit-user-password-chk']="user_account/editUserPasswordChk";
$route['profile/change-profile-picture']="user_account/changeProfilePicture";
$route['logout']="user_account/logout";

/*
 *  User account section end
 */

/** Manage Blogs at fron **/
$route['blog/add-comment'] = "blog/add_comment";
$route['blog/(:any)'] = "blog/index/$1";
$route['blog'] = "blog/index";
$route['blog/add-post-front'] = "blog/add_post_data";
$route['blogs/author-details/(:any)'] = "blog/author_details/$1";
$route['blogs/year-details/(:any)/(:any)'] = "blog/year_details/$1/$2";
/* Revision 2 routes end here */

$route['backend/inquiries/list'] = "product/inquiryList";
$route['backend/inquiry/view/(:any)'] = "product/inquiryView/$1";


/** Advertise front route start here **/
$route['advertise-image']="advertise/advertiseImage";

$route['cms/(:any)']="cms/cmsPage/$1";

$route['contact-us'] = "contact_us/index";
$route['backend-delete-image'] = "product/deleteImage";

/**Notification Managed frontend Start**/
$route['my-notification'] = "notification/my_notification";
$route['my-notification/(:any)'] = "notification/my_notification/$1";
$route['notification-details/(:any)'] = "notification/notification_details/$1";
$route['delete-notification/(:any)'] = "notification/delete_notification/$1";
/**Notification Manage frontend End**/
/** Advertise front route end here **/
 
/** Testimonial front route start here **/
$route['testimonial']="testimonial/viewTestimonial";
$route['testimonial/(:any)']="testimonial/viewTestimonial/$1";
/** Testimonial front route end here **/

$route['products']="dispute/products";
/** Testimonial front route end here **/
$route['backend/get-all-users'] = "newsletter/gettingAllUsersByStatus"; 

/* manage order */
//$route['backend/order/list'] = "product/listOrder";
//$route['backend/order/view/(:any)'] = "product/viewOrder/$1";
/* manage order end */
/* Backend logictic management start */
$route['backend/orders/list'] = "order/ListOrderBackend";
$route['backend/orders/view-oreder-products/(:any)'] = "order/ListOrderProductBackend/$1";
$route['backend/orders/view-product/(:any)'] = "order/viewOrder/$1";
$route['backend/orders/product-list'] = "product/ListOrderProductsBackend";
$route['backend/logistics/EMS'] = "order/ListOrderBackendEMS";
$route['backend/orders/change-status'] = "order/changeStatusBackend";
$route['backend/view-oreder-tnt/(:any)'] = "order/viewOrderBackendTNT/$1";
$route['backend/view-oreder-ems/(:any)'] = "order/viewOrderBackendEMS/$1";
$route['backend/change-order-status'] = "order/changeProductStatus";
/* Backend logistic managemnt end */

/* manage Carat end */
$route['backend/carat/list'] = "product/listCarat";
$route['backend/carat/edit/(:any)'] = "product/editCarat/$1";
$route['backend/carat/add'] = "product/addCarat";
$route['backend/carat/check-carat-name'] = "product/checkName";
/* manage Carat end */
$route['test1'] = "user_account/test"; 

//Web-service routes starts here
$route['ws-registration'] = "web_services/userRegistration";
$route['ws-login'] = "web_services/userLogin";
$route['ws-change_password'] = "web_services/userChangePassword";
$route['ws-change-email'] = "web_services/userChangeEmail";
$route['ws-forgotpassword'] = "web_services/forgotPassword";
$route['ws-view-userprofile'] = "web_services/userDetails";
$route['ws-edit-userprofile'] = "web_services/editUserDetails";
$route['ws-update-profile-pic'] = "web_services/changeProfilePic";
$route['ws-send-mail-check'] = "web_services/sendMailTest";
$route['ws-main-categories'] = "web_services/getCategories";
$route['ws-sub-categories'] = "web_services/getSubCategories";
$route['ws-get-all-product'] = "web_services/wsGetAllProduct";
$route['ws-get-all-product-by-main-category'] = "web_services/wsGetAllProductByMainCategory";
$route['ws-get-all-product-by-sub-category'] = "web_services/wsGetAllProductBySubCategory";
$route['ws-recently-viewed-product'] = "web_services/wsGetAllRecentlyViewedProduct";
$route['ws-add-recently-viewed-product'] = "web_services/wsAddRecentlyViewedProduct";
$route['ws-product-by-id'] = "web_services/wsGetProductById";
//Date:23-10-16 webservice start
$route['ws-add-to-cart'] = "web_services/wsAddToCart";
$route['ws-update-to-cart'] = "web_services/wsUpdateCart";
$route['ws-remove-to-cart'] = "web_services/wsRemoveFromCart";
$route['ws-add-shipping-address']="web_services/addShippingAddress";
$route['ws-update-shipping-address']="web_services/updateShippingAddress";
$route['ws-remove-shipping-address']="web_services/removeShippingAddress";
$route['ws-get-shipping-address']="web_services/getShippingAddress";
$route['ws-offered-products'] = "web_services/wsGetAllOfferedProduct";
$route['ws-add-order-details'] = "web_services/placeOrder";
//Date:23-10-16 webservice end

//Date:27-10-16 webservice start
$route['ws-delete-account'] = "web_services/deleteAccount";
$route['ws-search-product'] = "web_services/wsSearchProduct";
//Date:27-10-16 webservice end
//Date:29-10-16 webservice start
$route['ws-related-products'] = "web_services/relatedProducts";
$route['ws-user-order-list'] = "web_services/wsUserOrdersList";
$route['ws-user-order-details'] = "web_services/wsUserOrdersDetails";
//Date:29-10-16 webservice end
//
//Date:10-11-16 webservice start
$route['ws-my-cart-details'] = "web_services/wsMyCart";
$route['ws-user-order-list'] = "web_services/wsUserOrdersList";
$route['ws-add-review'] = "web_services/addReview";
//Date:10-11-16 webservice end
$route['ws-static-pages'] = "web_services/staticContent";
$route['ws-faq'] = "web_services/faq";
$route['ws-track-order'] = "web_services/trackOrder";
$route['ws-get-notification'] = "web_services/getNotification";
$route['ws-recommended-products'] = "web_services/recommendedProducts";
$route['ws-check-email'] = "web_services/checkEmail";
$route['ws-send-email'] = "web_services/sendEmails";
$route['ws-best-selling-products'] = "web_services/BestProducts";
$route['ws-send-inquiry'] = "web_services/sendInquiry";
$route['ws-carat-details'] = "web_services/getCaratDetails";
$route['ws-inquery-details'] = "web_services/getInqueryDetails";




