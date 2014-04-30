<?

$lang['admin_menu_setting'] = 'Настройки';
$lang['admin_menu_contractors'] = 'Подрядчики';
$lang['admin_menu_items'] = 'Товары';
$lang['admin_menu_codes'] = 'Коды SAP';
$lang['admin_menu_report'] = 'Отчеты';
$lang['admin_menu_limit'] = 'Лимиты';


$lang['admin_shortcuts_add_contractor'] = 'Добавить поставщика';
$lang['admin_shortcuts_add_item'] = 'Добавить еденицу';


// controller: admin.php, view: index.php
$lang['page:admin:title:main'] = 'Основные настройки';
$lang['page:admin:label:max_amount'] = 'Максимальная сумма заказа';
$lang['page:admin:label:default_contractor'] = 'Поставщик по умолчанию';

// controller: admin_contractor.php, view: contractor.php
$lang['page:admin:title:contractors'] = 'Поставщики';
$lang['page:admin:table:name'] = 'Имя';
$lang['page:admin:table:phone'] = 'Телефон';
$lang['page:admin:table:address'] = 'Адрес';
$lang['page:admin:table:mail'] = 'Почта';
$lang['page:admin:table:active'] = 'Включен';
$lang['page:admin:table:comment'] = 'Комментарий';
$lang['page:admin:table:manage'] = 'Управление';
$lang['page:admin:message:no_contractors'] = 'Нет поставщиков пока';

// controller: admin_contractor.php, view: contractor_form.php
$lang['page:admin_contractor:contractor_form:title'] = 'Изменить данные поставщика';
$lang['page:admin_contractor:contractor_form:label:name'] = 'Имя';
$lang['page:admin_contractor:contractor_form:label:phone'] = 'Номер телефона';
$lang['page:admin_contractor:contractor_form:label:address'] = 'Адрес';
$lang['page:admin_contractor:contractor_form:label:mail'] = 'Эл.почта';
$lang['page:admin_contractor:contractor_form:label:active'] = 'Включен';
$lang['page:admin_contractor:contractor_form:label:comment'] = 'Комментарий';

// controller: admin_items.php, view: items.php
$lang['page:admin_items:items:title'] = 'Все товары';
$lang['page:admin_items:items:table:name'] = 'Имя';
$lang['page:admin_items:items:table:quote'] = 'Квота';
$lang['page:admin_items:items:table:price'] = 'Цена';
$lang['page:admin_items:items:table:ed'] = 'Еденица измерения';
$lang['page:admin_items:items:table:contractor'] = 'Поставщик';
$lang['page:admin_items:items:table:period'] = 'Период заказа';
$lang['page:admin_items:items:table:kod1'] = 'Код1';
$lang['page:admin_items:items:table:kod2'] = 'Код2';
$lang['page:admin_items:items:table:manage'] = 'Управление';
$lang['page:admin_items:items:messages:no_items'] = 'Товаров нет';

// controller: admin_items.php, view: item_form.php
$lang['page:admin_items:item_form:title'] = 'Изменить товар';

// controller: admin_report.php, view: report.php
$lang['page:admin_report:report:title'] = 'Отчеты';
$lang['page:admin_report:report:messages:select_for_user'] = 'Выберите пользователя';
$lang['page:admin_report:report:messages:close_period'] = 'Выгрузить отчет и закрыть период';
$lang['page:admin_report:report:messages:report_period'] = 'Выгрузить отчет за период';

// controller: admin_users.php, view: users.php
$lang['page:admin_users:users:title'] = 'Управление кодами пользователей';
$lang['page:admin_users:users:table:login'] = 'Логин';
$lang['page:admin_users:users:table:name'] = 'Имя';
$lang['page:admin_users:users:table:code'] = 'Код';
$lang['page:admin_users:users:table:manage'] = 'Управление';
$lang['page:admin_users:users:messages:no_users'] = 'Пока пользователей нет';

// controller: admin_users.php, view: users_form.php
$lang['page:admin_users:users_form:title'] = 'Добавить код';
$lang['page:admin_users:users_form:label:add_code'] = 'Код';

$lang['page:admin_limit:limit:title'] = 'Установка лимита пользователю';
$lang['page:admin_limit:limit:table:limit'] = 'Лимит';


// messages
$lang['empty_id'] = 'ID пустой';
$lang['message_updated_succesfully'] = 'Успешно обновлено';
$lang['message_saved_succesfully'] = 'Успешно сохранено';
$lang['message_added_succesfully'] = 'Успешно добавлено';
$lang['message_deleted_succesfully'] = 'Успешно удалено'; //Was an error
$lang['message_error'] = 'Произошла ошибка';

//email
$lang['email:subject'] = 'Служба заказа канцелярии';
$lang['email:text'] = 'Вы успешно сделали заказ. Если у вас есть вопросы, вы можете обратиться к менеджеру.';


// buttons
$lang['buttons:dropdown'] = 'Выберите';
$lang['buttons:save'] = 'Сохранить';
$lang['buttons:cancel'] = 'Отменить';

 /*****************************
 *
 *
 *         Frontend
 *
 *
 *****************************/

$lang['page:chancellery:messages:no_code'] = 'У вас не установлен код SAP. Пожалуйста, обратитесь к менеджеру';
$lang['page:chancellery:messages:max_limit'] = 'Вы заказали более, чем на $max_sum рублей ($allprice). обратитесь к менеджеру';
$lang['page:chancellery:messages:no_limit'] = 'У вас не установлен лимит на заказ канцелярии. обратитесь к менеджеру';

$lang['page:chancellery:index:title'] = 'Создать заказ';
$lang['page:chancellery:index:message'] = 'Вы можете сделать заказ канцелярии на этой странице';
$lang['page:chancellery:index:table:name'] = 'Имя';
$lang['page:chancellery:index:table:count'] = 'Количество';
$lang['page:chancellery:index:table:ed'] = 'Еденица';
$lang['page:chancellery:index:table:quote'] = 'Квота';
$lang['page:chancellery:index:table:price'] = 'Цена';

$lang['page:chancellery:ordered:title'] = 'Ваш заказ';
$lang['page:chancellery:ordered:no_order'] = 'Не заказано';
$lang['page:chancellery:ordered:no_order_in_month'] = 'Вы не сделали заказ в этом месяце, вы можете сделать это <a href="/chancellery/form">сейчас</a>'; //


?>