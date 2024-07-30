<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index');

 //Login routes defined here
 $routes->POST('/login/check', 'Home::loginAuth');

// logout 
$routes->get('logout', 'Home::logout');

// forgot password routes defined here
$routes->get('forgot_password', 'SendMail::forgot_password');
// send mail
$routes->post('send_email', 'SendMail::send_email_link');

// Reset Password form show
$routes->get('reset_password/(:num)', 'ResetPassword::reset_password/$1');

// Update password functionality route
$routes->post('update_password', 'ResetPassword::update_password');

// dashboard
$routes->get('dashboard', 'Dashboard::dashboard');



// Equipments
$routes->get('/equipments', 'Equipment::equipments');
$routes->post('/equipments/add_equipments', 'Equipment::add_equipments');
$routes->get('/view_equipments/(:num)', 'Equipment::view_equipments/$1');
// $routes->get('/view_all_equipments', 'Equipment::view_all_equipments');
$routes->match(['get', 'post'], '/view_all_equipments', 'Equipment::view_all_equipments');
$routes->get('/equipments/delete_equipments/(:num)', 'Equipment::delete_equipments/$1');
$routes->get('/update_equipments/(:num)', 'Equipment::update_equipments/$1');
$routes->post('/equipments/edit_equipments/(:num)', 'Equipment::edit_equipments/$1');
$routes->post('/equipments/delete_equipment_image', 'Equipment::delete_equipment_image');


// Properties
$routes->get('/property', 'Property::property');
$routes->POST('/property/add_property', 'Property::add_property');
$routes->POST('cities', 'Property::cities');
// $routes->get('/view_all_property', 'Property::view_all_property');
$routes->match(['get', 'post'], '/view_all_property', 'Property::view_all_property');
$routes->get('/view_property/(:num)', 'Property::view_property/$1');
$routes->get('/property/delete_property/(:num)', 'Property::delete_property/$1');
$routes->get('/update_property/(:num)', 'Property::update_property/$1');
$routes->post('/property/edit_property/(:num)', 'Property::edit_property/$1');
$routes->post('/property/delete_property_image', 'Property::delete_property_image');

//profile
// $routes->get('/profile', 'Profile::profile');
$routes->get('/profile', 'Profile::profile_show');
$routes->post('/update_profile', 'Profile::update_profile');


// API to get equipments
$routes->get('/equipments/view', 'EquipmentAPI_Cotroller::equipment_api'); // http://localhost/mediresaledash/equipments/view

// API to get Property 
$routes->get('/property/view', 'PropertyAPI_Cotroller::AllPropertyItems_API'); //http://localhost/mediresaledash/property/view

$routes->get('/property_by_price_range/view', 'PropertyAPI_Cotroller::GetPropertiesByPriceRange_API'); //http://localhost/mediresaledash/property_price_range/view

$routes->get('/property_by_built_year/view', 'PropertyAPI_Cotroller::getPropertiesByBuiltYear_API'); //http://localhost/mediresaledash/property_built_year/view

$routes->get('/property_by_property_type/view', 'PropertyAPI_Cotroller::getPropertiesByPropertyType_API'); //http://localhost/mediresaledash/property_by_property_type/view

$routes->get('/property_by_transaction_type/view', 'PropertyAPI_Cotroller::getPropertiesByTransactionType_API'); //http://localhost/mediresaledash/property_by_transaction_type/view

$routes->get('/property_by_city_or_zipcode/view', 'PropertyAPI_Cotroller::getPropertiesByCityOrZipcode'); //http://localhost/mediresaledash/property_by_city_or_zipcode/view

$routes->get('/property_by_amenities/view', 'PropertyAPI_Cotroller::getPropertiesByAmenities'); //http://localhost/mediresaledash/property_by_amenities/view

$routes->get('/property_by_age_of_property/view', 'PropertyAPI_Cotroller::getEquipmentByAgeOfProperty_API'); //http://localhost/mediresaledash/property_by_age_of_property/view

$routes->get('/property_by_monthly_rent/view', 'PropertyAPI_Cotroller::getEquipmentByMonthlyRent_API'); //http://localhost/mediresaledash/property_monthly_rent/view

$routes->get('/property_by_possesion/view', 'PropertyAPI_Cotroller::getPropertiesByPossesion_API'); //http://localhost/mediresaledash/property_by_possesion/view