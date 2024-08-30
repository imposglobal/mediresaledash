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
$routes->get('dashboard', 'DashBoard::dashboard');



// Equipments
$routes->get('/equipments', 'Equipment::equipments');
$routes->post('/equipments/add_equipments', 'Equipment::add_equipments');
$routes->get('/view_equipments/(:num)', 'Equipment::view_equipments/$1');
$routes->match(['get', 'post'], '/view_all_equipments', 'Equipment::view_all_equipments');
$routes->get('/equipments/delete_equipments/(:num)', 'Equipment::delete_equipments/$1');
$routes->get('/update_equipments/(:num)', 'Equipment::update_equipments/$1');
$routes->post('/equipments/edit_equipments/(:num)', 'Equipment::edit_equipments/$1');
// $routes->post('/equipments/delete_equipment_image', 'Equipment::delete_equipment_image');
$routes->post('/equipments/delete_equipment_image', 'Equipment::deleteEquipmentImage');


// Properties
$routes->get('/property', 'Property::property');
$routes->POST('/property/add_property', 'Property::add_property');
$routes->POST('cities', 'Property::cities');
$routes->match(['get', 'post'], '/view_all_property', 'Property::view_all_property');
$routes->get('/view_property/(:num)', 'Property::view_property/$1');
$routes->get('/property/delete_property/(:num)', 'Property::delete_property/$1');
$routes->get('/update_property/(:num)', 'Property::update_property/$1');
$routes->post('/property/edit_property/(:num)', 'Property::edit_property/$1');
$routes->post('/property/delete_property_image', 'Property::deletePropertyImage');

//profile
// $routes->get('/profile', 'Profile::profile');
$routes->get('/profile', 'Profile::profile_show');
$routes->post('/update_profile', 'Profile::update_profile');


/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ All Equiupment related API's routes defined below @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/


// API to get equipments
$routes->get('/equipments/view', 'EquipmentAPI_Cotroller::equipment_api'); // http://localhost/mediresaledash/equipments/view
$routes->get('/equipments/title_image_equipment_api/view', 'EquipmentAPI_Cotroller::get_Title_Image_Equipment_Api'); // http://localhost/mediresaledash/equipments/view
$routes->get('/equipments/equipments_type/view', 'EquipmentAPI_Cotroller::getEquipmentByEquipmentType_API'); // http://localhost/mediresaledash/equipments/title_image_equipment_api/view
$routes->get('/equipments/brand/view', 'EquipmentAPI_Cotroller::getEquipmentByBrand_API'); // http://localhost/mediresaledash/equipments/brand/view
$routes->get('/equipments/condition/view', 'EquipmentAPI_Cotroller::getEquipmentByCondition_API'); // http://localhost/mediresaledash/equipments/condition/view
$routes->get('/equipments/warranty/view', 'EquipmentAPI_Cotroller::getEquipmentByWarranty_API'); // http://localhost/mediresaledash/equipments/warranty/view
$routes->get('/equipments/availability/view', 'EquipmentAPI_Cotroller::getEquipmentByAvailability_API'); // http://localhost/mediresaledash/equipments/availability/view
$routes->get('/equipments/year/view', 'EquipmentAPI_Cotroller::getEquipmentByAge_API'); // http://localhost/mediresaledash/equipments/year/view
$routes->get('/equipments/price/view', 'EquipmentAPI_Cotroller::getEquipmentByPrice_API'); // http://localhost/mediresaledash/equipments/price/view
$routes->get('/equipments/city-zipcode/view', 'EquipmentAPI_Cotroller::getEquipmentByCityOrZipcode'); // http://localhost/mediresaledash/equipments/city-zipcode/view

//Api to get cit , equipment type and transsaction type on wordpress homepage
$routes->get('/equipments/city_equipment_transaction/view', 'EquipmentAPI_Cotroller::getEquipmentByFiltersHome'); // http://localhost/mediresaledash/equipments/city_equipment_transaction/view


//Api function to get equipment type, condition , price only
$routes->get('/equipments/getEquipments_types_Condition_Price_API/view', 'EquipmentAPI_Cotroller::getEquipment_types_and_Condition_Price_API'); // http://localhost/mediresaledash/equipments/getEquipments_types_Condition_Price_API/view


// combine API for equipment listing page-  multiple filter

$routes->get('getEquipmentsByFilter/view', 'EquipmentAPI_Cotroller::getEquipmentsByFilter');

// http://localhost/mediresaledash/equipments/getfilter/view

// Equipment Detail Page 
$routes->get('/getequipmentdetails/view', 'LeadsAPI_Controller::getEquipmentDetails');

//Equipment Detail Page API
$routes->post('/submitEquipmentlead/add', 'LeadsAPI_Controller::addEquipmentLead');  //http://localhost/mediresaledash/submit-lead/add



/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ All Property related API's routes defined below @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/


// API to get Property 
$routes->get('/property/view', 'PropertyAPI_Cotroller::AllPropertyItems_API'); //http://localhost/mediresaledash/property/view

$routes->get('/property/get_TitleImage_Property_Api/view', 'PropertyAPI_Cotroller::get_Title_Image_Property_Api'); //http://localhost/mediresaledash/get_TitleImage_Property_Api/view

$routes->get('/property_by_price_range/view', 'PropertyAPI_Cotroller::GetPropertiesByPriceRange_API'); //http://localhost/mediresaledash/property_price_range/view

$routes->get('/property_by_built_year/view', 'PropertyAPI_Cotroller::getPropertiesByBuiltYear_API'); //http://localhost/mediresaledash/property_built_year/view

$routes->get('/property_by_property_type/view', 'PropertyAPI_Cotroller::getPropertiesByPropertyType_API'); //http://localhost/mediresaledash/property_by_property_type/view

$routes->get('/property_by_transaction_type/view', 'PropertyAPI_Cotroller::getPropertiesByTransactionType_API'); //http://localhost/mediresaledash/property_by_transaction_type/view

$routes->get('/property_by_city_or_zipcode/view', 'PropertyAPI_Cotroller::getPropertiesByCityOrZipcode'); //http://localhost/mediresaledash/property_by_city_or_zipcode/view

$routes->get('/property_by_amenities/view', 'PropertyAPI_Cotroller::getPropertiesByAmenities'); //http://localhost/mediresaledash/property_by_amenities/view

$routes->get('/property_by_age_of_property/view', 'PropertyAPI_Cotroller::getEquipmentByAgeOfProperty_API'); //http://localhost/mediresaledash/property_by_age_of_property/view

$routes->get('/property_by_monthly_rent/view', 'PropertyAPI_Cotroller::getEquipmentByMonthlyRent_API'); //http://localhost/mediresaledash/property_monthly_rent/view

$routes->get('/property_by_monthly_buy/view', 'PropertyAPI_Cotroller::getEquipmentByMonthlyBuy_API'); //http://localhost/mediresaledash/property_by_monthly_buy/view

$routes->get('/property_by_possesion/view', 'PropertyAPI_Cotroller::getPropertiesByPossesion_API'); //http://localhost/mediresaledash/property_by_possesion/view

// combine API for property listing page-- multiple filter

$routes->get('/getpropertybyFilter/view', 'PropertyAPI_Cotroller::getpropertybyFilter');

//Api function to get property_type and adress ,price , image only
$routes->get('/property/getProperty_types_and_Adress/view', 'PropertyAPI_Cotroller::getProperty_types_and_Adress_API'); // http://localhost/mediresaledash/property/getProperty_types_and_Adress/view


//Api to get address, property type and price on wordpress homepage
$routes->get('/property/city_property_transaction/view', 'PropertyAPI_Cotroller::getPropertyByFiltersHome'); // http://localhost/mediresaledash/property/city_property_transaction/view



// Product Detail Page
$routes->get('/getdetails/view', 'LeadsAPI_Controller::getDetails');
$routes->post('/submit-lead/add', 'LeadsAPI_Controller::addLead');  //http://localhost/mediresaledash/submit-lead/add

// Leads

$routes->get('/leads', 'LeadsAPI_Controller::view_all_leads');
$routes->get('/leads/delete_lead/(:num)', 'LeadsAPI_Controller::delete_leads/$1');
$routes->get('/leads/view_leads/(:num)', 'LeadsAPI_Controller::view_all_leads_by_id/$1');

// get in touch form API route
$routes->post('/get_in_touch/add', 'GetInTouch_API_Controller::GetInTouchFormAPI');  //http://localhost/mediresaledash/get_in_touch/add


// news letter API route
$routes->post('/news_letter/add', 'NewsLetter_API_Controller::NewsLetterAPI');  //http://localhost/mediresaledash/news_letter/add
