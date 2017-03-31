<?php

$lang['admin_menu_setting'] = 'Settings';
$lang['admin_menu_contractors'] = 'Contractors';
$lang['admin_menu_items'] = 'Items';
$lang['admin_menu_codes'] = 'SAP codes';
$lang['admin_menu_report'] = 'Reports';
$lang['admin_menu_limit'] = 'Limits';


$lang['admin_shortcuts_add_contractor'] = 'Add a contractor';
$lang['admin_shortcuts_add_item'] = 'Add item';


// controller: admin.php, view: index.php
$lang['page:admin:title:main'] = 'Main settings';
$lang['page:admin:label:max_amount'] = 'Max. amount of order';
$lang['page:admin:label:default_contractor'] = 'Default contractor';

// controller: admin_contractor.php, view: contractor.php
$lang['page:admin:title:contractors'] = 'Contractors';
$lang['page:admin:table:name'] = 'Name';
$lang['page:admin:table:phone'] = 'Phone';
$lang['page:admin:table:address'] = 'Address';
$lang['page:admin:table:mail'] = 'Email';
$lang['page:admin:table:active'] = 'Enable';
$lang['page:admin:table:comment'] = 'Comment';
$lang['page:admin:table:manage'] = 'Manage';
$lang['page:admin:message:no_contractors'] = 'No contractors yet';

// controller: admin_contractor.php, view: contractor_form.php
$lang['page:admin_contractor:contractor_form:title'] = 'Edit a contractor';
$lang['page:admin_contractor:contractor_form:label:name'] = 'Name';
$lang['page:admin_contractor:contractor_form:label:phone'] = 'Phone';
$lang['page:admin_contractor:contractor_form:label:address'] = 'Address';
$lang['page:admin_contractor:contractor_form:label:mail'] = 'Email';
$lang['page:admin_contractor:contractor_form:label:active'] = 'Enable';
$lang['page:admin_contractor:contractor_form:label:comment'] = 'Comment';

// controller: admin_items.php, view: items.php
$lang['page:admin_items:items:title'] = 'All items';
$lang['page:admin_items:items:table:name'] = 'Name';
$lang['page:admin_items:items:table:quote'] = 'Quote';
$lang['page:admin_items:items:table:price'] = 'Price';
$lang['page:admin_items:items:table:ed'] = 'Unit';
$lang['page:admin_items:items:table:contractor'] = 'Contractor';
$lang['page:admin_items:items:table:period'] = 'Period of order';
$lang['page:admin_items:items:table:kod1'] = 'Code1';
$lang['page:admin_items:items:table:kod2'] = 'Code2';
$lang['page:admin_items:items:table:manage'] = 'Manage';
$lang['page:admin_items:items:messages:no_items'] = 'No items yet';

// controller: admin_items.php, view: item_form.php
$lang['page:admin_items:item_form:title'] = 'Edit a item';

// controller: admin_report.php, view: report.php
$lang['page:admin_report:report:title'] = 'Reports';
$lang['page:admin_report:report:messages:select_for_user'] = 'Select user';
$lang['page:admin_report:report:messages:close_period'] = 'Get the report and close the period';
$lang['page:admin_report:report:messages:report_period'] = 'Get the report for the period';

// controller: admin_users.php, view: users.php
$lang['page:admin_users:users:title'] = 'Manage a user codes';
$lang['page:admin_users:users:table:login'] = 'Login';
$lang['page:admin_users:users:table:name'] = 'Name';
$lang['page:admin_users:users:table:code'] = 'Code';
$lang['page:admin_users:users:table:manage'] = 'Manage';
$lang['page:admin_users:users:messages:no_users'] = 'No users yet';

// controller: admin_users.php, view: users_form.php
$lang['page:admin_users:users_form:title'] = 'Add a code';
$lang['page:admin_users:users_form:label:add_code'] = 'Code';

$lang['page:admin_limit:limit:title'] = 'Set a limit for user';
$lang['page:admin_limit:limit:table:limit'] = 'Limit';


// messages
$lang['empty_id'] = 'ID is empty';
$lang['message_updated_succesfully'] = 'Updated successfully';
$lang['message_saved_succesfully'] = 'Saved successfully';
$lang['message_added_succesfully'] = 'Added successfully';
$lang['message_deleted_succesfully'] = 'Deleted successfully'; //Was an error
$lang['message_error'] = 'Was an error';

//email
$lang['email:subject'] = 'Chancellery order service';
$lang['email:text'] = 'You have successfully make a order. If you have a question, please write to a manager';


// buttons
$lang['buttons:dropdown'] = 'Select one';
$lang['buttons:save'] = 'Save';
$lang['buttons:cancel'] = 'Cancel';

/*****************************
 *
 *
 *         Frontend
 *
 *
 *****************************/

$lang['page:chancellery:messages:no_code'] = 'You have no the SAP code. Please, contact with a manager';
$lang['page:chancellery:messages:max_limit'] = 'You have ordered more than $max_sum rub ($allprice). Please, contact with a manager';
$lang['page:chancellery:messages:no_limit'] = 'You have no the limit. Please, contact with a manager';

$lang['page:chancellery:index:title'] = 'Make a order';
$lang['page:chancellery:index:message'] = 'You can to make a order the chancellery on this page';
$lang['page:chancellery:index:table:name'] = 'Name';
$lang['page:chancellery:index:table:count'] = 'Amount';
$lang['page:chancellery:index:table:ed'] = 'Item';
$lang['page:chancellery:index:table:quote'] = 'Quote';
$lang['page:chancellery:index:table:price'] = 'Price';

$lang['page:chancellery:ordered:title'] = 'You order';
$lang['page:chancellery:ordered:no_order'] = 'Not ordered';
$lang['page:chancellery:ordered:no_order_in_month'] = 'You have no the order in this month, you can to do it <a href="/chancellery/form">now</a>';