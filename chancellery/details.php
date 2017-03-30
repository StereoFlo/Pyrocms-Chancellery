<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Chancellery extends Module
{

    public $version = '1.0';

    public function info()
    {
        return [
            'name'        => [
                'en' => 'Chancellery order',
                'ru' => 'Заказ канцелярии',
            ],
            'description' => [
                'en' => 'You can to order a chancellery items from this module',
                'ru' => 'Вы можете заказывать канцелярию, используя этот модуль',
            ],
            'frontend'    => true,
            'backend'     => true,
            'menu'        => 'utilities',
//
            'sections'    => [
                'setting'     => [
                    'name' => 'admin_menu_setting',
                    'uri'  => 'admin/chancellery',
                ],
                'contractors' => [
                    'name'      => 'admin_menu_contractors',
                    'uri'       => 'admin/chancellery/contractors',
                    'shortcuts' => [
                        [
                            'name'  => 'admin_shortcuts_add_contractor',
                            'uri'   => 'admin/chancellery/contractors/add',
                            'class' => 'add',
                        ],
                    ],
                ],
                'items'       => [
                    'name'      => 'admin_menu_items',
                    'uri'       => 'admin/chancellery/items',
                    'shortcuts' => [
                        [
                            'name'  => 'admin_shortcuts_add_item',
                            'uri'   => 'admin/chancellery/items/add',
                            'class' => 'add',
                        ],
                    ],
                ],
                'users'       => [
                    'name' => 'admin_menu_codes',
                    'uri'  => 'admin/chancellery/users',
                ],
                'limit'       => [
                    'name' => 'admin_menu_limit',
                    'uri'  => 'admin/chancellery/limit/',
                ],
                'report'      => [
                    'name' => 'admin_menu_report',
                    'uri'  => 'admin/chancellery/report',
                ],
            ],
        ];
    }

    public function install()
    {
        $this->dbforge->drop_table('chancellery_settings');
        $this->dbforge->drop_table('chancellery_orders');
        $this->dbforge->drop_table('chancellery_contractors');
        $this->dbforge->drop_table('chancellery_list');
        $this->dbforge->drop_table('chancellery_codes');
        $this->dbforge->drop_table('chancellery_limit');

        $chancellery_settings = "
			CREATE TABLE " . $this->db->dbprefix('chancellery_settings') . " (
				  id int(11) NOT NULL AUTO_INCREMENT,
				  default_contractor int(10) DEFAULT NULL,
				  sap_codes int(11) DEFAULT NULL,
				  email varchar(255) DEFAULT NULL,
				  PRIMARY KEY (id)
			) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = 'Таблица настроек модуля';
		";
        $chancellery_orders = "
			CREATE TABLE " . $this->db->dbprefix('chancellery_orders') . " (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  user int(11) NOT NULL DEFAULT 0,
			  kanz_id int(11) NOT NULL DEFAULT 0,
			  kolvo int(11) NOT NULL DEFAULT 0,
			  contractor int(11) DEFAULT NULL,
			  date date DEFAULT NULL,
			  active varchar(1) DEFAULT NULL,
			  PRIMARY KEY (id)
			)
			ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
        $chancellery_contractors = "
			CREATE TABLE " . $this->db->dbprefix('chancellery_contractors') . " (
			`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`name` VARCHAR(255) NULL ,
			`phone` VARCHAR(255) NULL ,
			`mail` VARCHAR(255) NULL ,
			`address` VARCHAR(255) NULL ,
			`active` VARCHAR(255) NULL ,
			`comment` VARCHAR(255) NULL ,
			`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = 'Таблица подрядчиков';
		";
        $chancellery_list = "
			CREATE TABLE " . $this->db->dbprefix('chancellery_list') . " (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  name char(40) DEFAULT NULL,
			  quote int(11) DEFAULT 0,
			  price int(11) DEFAULT 0,
			  ed char(5) DEFAULT NULL,
			  contractor int(11) DEFAULT NULL,
			  period int(11) NOT NULL DEFAULT 0,
			  kod1 varchar(12) DEFAULT NULL,
			  kod2 varchar(12) DEFAULT NULL,
			  PRIMARY KEY (id)
			)
			ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = 'Таблица заказов';
		";
        $chancellery_user_code = "
			CREATE TABLE " . $this->db->dbprefix('chancellery_codes') . " (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  user varchar(255) DEFAULT NULL,
			  code varchar(255) DEFAULT NULL,
			  PRIMARY KEY (id)
			)
			ENGINE = MYISAM
			CHARACTER SET utf8
			COLLATE utf8_general_ci
			COMMENT = 'Дополнительные коды';
		";
        $chancellery_user_limit = "
			CREATE TABLE " . $this->db->dbprefix('chancellery_limit') . " (
			id int(11) NOT NULL AUTO_INCREMENT,
			user varchar(255) DEFAULT NULL,
			`limit` varchar(255) DEFAULT NULL,
			PRIMARY KEY (id)
			)
			ENGINE = MYISAM
			CHARACTER SET utf8
			COLLATE utf8_general_ci;
		";

        if ($this->db->query($chancellery_settings)
            and $this->db->query($chancellery_orders)
            and $this->db->query($chancellery_contractors)
            and $this->db->query($chancellery_list)
            and $this->db->query($chancellery_user_code)
            and $this->db->query($chancellery_user_limit)
        ) {
            return true;
        }
    }

    public function uninstall()
    {
        $this->dbforge->drop_table('chancellery_settings');
        $this->dbforge->drop_table('chancellery_orders');
        $this->dbforge->drop_table('chancellery_contractors');
        $this->dbforge->drop_table('chancellery_list');
        $this->dbforge->drop_table('chancellery_codes');
        $this->dbforge->drop_table('chancellery_limit');

        return true;
    }


    public function upgrade($old_version)
    {
        return true;
    }

    public function help()
    {
        return "Нет документации.";
    }
}
