<?php
require_once(file_location('inc_path','connection.inc.php'));
@$conn = dbconnect('admin','PDO');
//CREATE ADMIN TABLE AND INSERT ADMIN
$sql = "CREATE TABLE IF NOT EXISTS admin_table(
    ad_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ad_email VARCHAR(50) NOT NULL,
    ad_username VARCHAR(50) NOT NULL,
    ad_password VARCHAR(100) NOT NULL,
    ad_fullname VARCHAR(50) NOT NULL,
    ad_level ENUM('1','2','3'),
    ad_status ENUM('suspended','active') DEFAULT 'active',
    ad_registered_by INT(100) NOT NULL,
    
    UNIQUE(ad_id),
    UNIQUE(ad_email),
    UNIQUE(ad_username),
    FULLTEXT KEY (ad_email,ad_username,ad_fullname)
    ) ENGINE=InnoDB";
@$conn->exec($sql);
    
// CREATE ADMIN MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS admin_media_table(
    am_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    am_link_name VARCHAR(100) NOT NULL,
    am_extension VARCHAR(50) NOT NULL,
    ad_id INT(100) NOT NULL,
            
    UNIQUE(am_id),
    UNIQUE(am_link_name),
    UNIQUE(ad_id),
    FOREIGN KEY (ad_id) REFERENCES admin_table(ad_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);
// insert the grand admin
$admin = new admin('admin');
$admin->id = get_xml_data('id');
$admin->new_email = get_xml_data('email');
$admin->new_username = get_xml_data('username');
$admin->new_password = hash_pass(get_xml_data('pass'));
$admin->fullname = get_xml_data('fullname');
$admin->level = get_xml_data('level');
$admin->registered_by = get_xml_data('registered_by');
$admin->auto_insert_update();

//CREATE LOG TABLE
$sql = "CREATE TABLE IF NOT EXISTS log_table(
    l_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    l_brief VARCHAR(100) NOT NULL,
	l_details VARCHAR(200) NOT NULL,
	l_regdatetime DATETIME DEFAULT NOW(),
	l_ip_address VARCHAR(200) NOT NULL,
	ad_username VARCHAR(50) NOT NULL,
    ad_id INT(100) NOT NULL,
    
    UNIQUE(l_id),
	FULLTEXT KEY (l_brief,l_details,l_ip_address,ad_username)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE SOCIAL MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS social_handle_table(
    s_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    s_name VARCHAR(50) NOT NULL,
    s_icon VARCHAR(20) NOT NULL,
    s_link VARCHAR(50) NOT NULL,
    s_color VARCHAR(10),
    s_bgcolor VARCHAR(10),
    
    UNIQUE(s_id),
    UNIQUE(s_name),
    UNIQUE(s_link),
    FULLTEXT KEY (s_name)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE MESSAGE TABLE
$sql = "CREATE TABLE IF NOT EXISTS message_table(
    m_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    m_name VARCHAR(50) NOT NULL,
    m_email VARCHAR(50) NOT NULL,
    m_subject VARCHAR(70) NOT NULL,
    m_message TEXT NOT NULL,
    m_status ENUM('new','seen') DEFAULT 'new',
    m_datetime DATETIME DEFAULT NOW(),
    
    UNIQUE(m_id),
    FULLTEXT KEY (m_name,m_email,m_subject,m_message)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE CATEGORY TABLE
$sql = "CREATE TABLE IF NOT EXISTS category_table(
    c_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    c_category VARCHAR(50) NOT NULL,
	c_icon VARCHAR(50) NOT NULL,
    
	UNIQUE(c_id),
    UNIQUE(c_category),
    FULLTEXT KEY (c_category)
    ) ENGINE=InnoDB";
@$conn->query($sql);
 
// CREATE CATEGORY MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS category_media_table(
    cm_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    cm_link_name VARCHAR(100) NOT NULL,
    cm_extension VARCHAR(50) NOT NULL,
    c_id INT(100) NOT NULL,
            
    UNIQUE(cm_id),
    UNIQUE(cm_link_name),
    FOREIGN KEY (c_id) REFERENCES category_table(c_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE USER TABLE
$sql = "CREATE TABLE IF NOT EXISTS user_table(
    u_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    u_email VARCHAR(70) NOT NULL,
    u_fullname VARCHAR(50) NOT NULL,
    u_gender ENUM('male','female','prefer not to say') DEFAULT 'prefer not to say',
    u_password VARCHAR(100) NOT NULL,
    u_status ENUM('suspended','active') DEFAULT 'active',
    u_pod ENUM('enabled','disabled') DEFAULT 'enabled',
    u_regdatetime DATETIME DEFAULT NOW(),
         
    UNIQUE(u_id),
    UNIQUE(u_email),
    FULLTEXT KEY (u_email,u_fullname)
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE USER CONTACT TABLE
$sql = "CREATE TABLE IF NOT EXISTS user_contact_table(
    uc_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    uc_fullname VARCHAR(50) NOT NULL,
    uc_address VARCHAR(350) NOT NULL,
    uc_region VARCHAR(50) NOT NULL,
    uc_phnumber1 VARCHAR(50) NOT NULL,
    uc_phnumber2 VARCHAR(50),
    uc_status ENUM('none','default') DEFAULT 'none',
    u_id INT(100) NOT NULL,
         
    UNIQUE(uc_id),
    FULLTEXT KEY (uc_address,uc_fullname,uc_phnumber1,uc_phnumber2,uc_region),
    FOREIGN KEY (u_id) REFERENCES user_table(u_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE USER DATA TABLE
$sql = "CREATE TABLE IF NOT EXISTS user_data_table(
    ud_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ud_cancel_counter INT(100) NOT NULL DEFAULT 0,
	ud_delivery_counter INT(100) NOT NULL DEFAULT 0,
    u_id INT(100) NOT NULL,
         
    UNIQUE(ud_id),
    FOREIGN KEY (u_id) REFERENCES user_table(u_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE COOKIE DATA TABLE
$sql ="CREATE TABLE IF NOT EXISTS cookie_data_table(
    cd_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    cd_token VARCHAR(70) NOT NULL,
    cd_ipaddress VARCHAR(70) NOT NULL,
    cd_login_time DATETIME DEFAULT NOW(),
    cd_expiretime VARCHAR(70) NOT NULL,
    u_id INT(100) NOT NULL,
    
    UNIQUE(cd_id),
    FOREIGN KEY (u_id) REFERENCES user_table(u_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE EMAIL CODE TABLE
$sql ="CREATE TABLE IF NOT EXISTS emailcode_table(
    c_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    c_code VARCHAR(8) NOT NULL,
    c_email VARCHAR(50) NOT NULL,
    c_verify ENUM('no','yes') DEFAULT 'no',
    c_regdatetime DATETIME DEFAULT NOW(),
    
    UNIQUE(c_id),
    UNIQUE(c_code),
    UNIQUE(c_email)
    )ENGINE=InnoDB";
@$conn->exec($sql);
    
//CREATE FOOD TABLE
$sql = "CREATE TABLE IF NOT EXISTS food_table(
    f_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    f_name VARCHAR(255) NOT NULL,
    f_category VARCHAR(55) NOT NULL,
    f_max_order INT(5) NOT NULL,
	f_total_available INT(5) NOT NULL,
    f_original_price VARCHAR(55) NOT NULL,
    f_discounted_price VARCHAR(55) NOT NULL,
    f_short_description VARCHAR(120) DEFAULT NULL,
    f_details MEDIUMTEXT DEFAULT NULL,
    f_status ENUM('available','unavailable','deleted') DEFAULT 'available',
	f_weight INT(10) NOT NULL,
    f_added INT(100) NOT NULL,
    f_updated INT(100) NOT NULL,
    
	UNIQUE(f_id),
    UNIQUE(f_name),
    FULLTEXT KEY (f_name,f_category,f_short_description,f_details)
    ) ENGINE=InnoDB";
@$conn->query($sql);
 
// CREATE FOOD MEDIA TABLE
$sql = "CREATE TABLE IF NOT EXISTS food_media_table(
    fm_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    fm_link_name VARCHAR(100) NOT NULL,
    fm_extension VARCHAR(50) NOT NULL,
    f_id INT(100) NOT NULL,
            
    UNIQUE(fm_id),
    UNIQUE(fm_link_name),
    FOREIGN KEY (f_id) REFERENCES food_table(f_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

//CREATE ORDER TABLE
$sql = "CREATE TABLE IF NOT EXISTS order_table(
    or_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    or_quantity INT(5) NOT NULL,
    or_amount VARCHAR(100) NOT NULL,
    or_delivery_fee VARCHAR(100) NOT NULL,
    or_status ENUM('cart','failed','order placed','cancelled','confirmed','packaging','in-transit','ready-for-pickup','delivered','failed delivery','returned') DEFAULT 'cart',
    or_token VARCHAR(255) NOT NULL,
    or_order_id VARCHAR(255) NOT NULL,
    or_delivery_method ENUM('none','pickup','door delivery') DEFAULT 'none',
    or_payment_method ENUM('none','card payment','payment on delivery') DEFAULT 'none',
    or_delivery_note VARCHAR(500),
	or_cancel_reason VARCHAR(100),
    or_refund ENUM('no','yes') DEFAULT 'no',
    or_review ENUM('no','yes') DEFAULT 'no',
	or_payment_received ENUM('no','yes') DEFAULT 'no',
    or_regdatetime DATETIME DEFAULT NOW() ON UPDATE NOW(),
	or_pmt_regdatetime DATETIME,
	or_pmt_date DATE,
	or_pmt_month VARCHAR(8),
	or_pmt_year YEAR,
    f_id INT(100) NOT NULL,
	user_id INT(100),
    
	UNIQUE(or_id),
    UNIQUE(or_order_id),
    FULLTEXT KEY (or_order_id,or_token)
    ) ENGINE=InnoDB";
@$conn->query($sql);

//CREATE ORDERER TABLE
$sql = "CREATE TABLE IF NOT EXISTS orderer_table(
    o_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    or_token VARCHAR(255) NOT NULL,
    u_id INT(100),
    uc_id INT(100),
    
	UNIQUE(o_id),
    UNIQUE(or_token)
    ) ENGINE=InnoDB";
@$conn->query($sql);

//CREATE ORDER HISTORY TABLE
$sql = "CREATE TABLE IF NOT EXISTS order_history_table(
    oh_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    oh_status ENUM('cart','failed','order placed','cancelled','confirmed','packaging','in-transit','ready-for-pickup','delivered','failed delivery','returned'),
    oh_regdatetime DATETIME DEFAULT NOW(),
    or_id INT(100) NOT NULL,
    
	UNIQUE(oh_id),
    FOREIGN KEY (or_id) REFERENCES order_table(or_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->query($sql);

//CREATE REFUND TABLE
$sql = "CREATE TABLE IF NOT EXISTS refund_table(
    r_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    r_amount VARCHAR(100) NOT NULL,
	r_regdatetime DATETIME DEFAULT NOW(),
	r_date DATE DEFAULT NOW(),
	r_month VARCHAR(8) NOT NULL,
	r_year YEAR DEFAULT NOW(),
	or_order_id VARCHAR(255) NOT NULL,
	user_id INT(100),
    
	UNIQUE(r_id),
    UNIQUE(or_order_id),
    FULLTEXT KEY (or_order_id)
    ) ENGINE=InnoDB";
@$conn->query($sql);

//CREATE NOTIFICATION TABLE
$sql = "CREATE TABLE IF NOT EXISTS notification_table(
    n_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    n_title VARCHAR(250) NOT NULL,
    n_message TEXT NOT NULL,
    n_status ENUM('sent','seen','read') DEFAULT 'sent',
    n_regdatetime DATETIME DEFAULT NOW(),
    or_id INT(100) NOT NULL,
    u_id INT(100) NOT NULL,
    
	UNIQUE(n_id),
    FOREIGN KEY (or_id) REFERENCES order_table(or_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (u_id) REFERENCES user_table(u_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->query($sql);

//CREATE REVIEW TABLE
$sql = "CREATE TABLE IF NOT EXISTS review_table(
    r_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    r_rating ENUM('1','2','3','4','5'),
    r_name VARCHAR(30) NOT NULL,
    r_title VARCHAR(50) NOT NULL,
    r_feedback VARCHAR(250) NOT NULL,
    r_regdatetime DATETIME DEFAULT NOW(),
    or_id INT(100) NOT NULL,
    f_id INT(100) NOT NULL,
    u_id INT(100) NOT NULL,
    
	UNIQUE(r_id),
    FOREIGN KEY (or_id) REFERENCES order_table(or_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (f_id) REFERENCES food_table(f_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (u_id) REFERENCES user_table(u_id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB";
@$conn->query($sql);

// CREATE TRANSACTION TABLE
$sql = "CREATE TABLE IF NOT EXISTS transaction_table(
    t_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    t_status ENUM('failed','success','pending') NOT NULL,
	t_currency VARCHAR(20) NOT NULL,
    t_amount VARCHAR(20) NOT NULL,
    t_ref_id VARCHAR(100) NOT NULL,
    t_payment_method VARCHAR(55) NOT NULL,
    t_bank VARCHAR(100),
    t_brand VARCHAR(100),
    t_account_name VARCHAR(55),
    t_account_number VARCHAR(15),
    t_ipaddress VARCHAR(30) NOT NULL,
    t_regdatetime DATETIME DEFAULT NOW(),
	t_date DATE DEFAULT NOW(),
	t_month VARCHAR(8) NOT NULL,
	t_year YEAR DEFAULT NOW(),
	or_token VARCHAR(255) NOT NULL,
            
    UNIQUE(t_id),
    UNIQUE(t_ref_id),
    UNIQUE(or_token),
    FULLTEXT KEY (t_amount,t_currency,t_ref_id,t_payment_method,t_bank,t_brand,t_account_name,t_account_number,t_ipaddress,or_token)
    ) ENGINE = InnoDB";
@$conn->exec($sql);

// CREATE WISHLIST TABLE
$sql ="CREATE TABLE IF NOT EXISTS wishlist_table(
    w_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    f_id INT(100) NOT NULL,
    u_id INT(100) NOT NULL,
    
    UNIQUE(w_id),
    FOREIGN KEY (f_id) REFERENCES food_table(f_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (u_id) REFERENCES user_table(u_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);

// CREATE VIEWED TABLE
$sql ="CREATE TABLE IF NOT EXISTS viewed_table(
    v_id INT(100) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    v_token VARCHAR(70) NOT NULL,
    v_regdatetime DATETIME DEFAULT NOW() ON UPDATE NOW(),
    f_id INT(100) NOT NULL,
    
    UNIQUE(v_id),
    FOREIGN KEY (f_id) REFERENCES food_table(f_id) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB";
@$conn->exec($sql);
    
//CREATE PAGE VISIT TABLE
//$sql ="CREATE TABLE IF NOT EXISTS page_visit_table(
//    pg_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
//    pg_ipaddress VARCHAR(150) NOT NULL,
//    pg_location VARCHAR(150) NOT NULL DEFAULT 'unknown',
//    pg_page VARCHAR(150) NOT NULL,
//    pg_datetime DATETIME DEFAULT NOW(),
//    pg_date DATE DEFAULT NOW(),
//    pg_month VARCHAR(8) NOT NULL,
//    pg_year YEAR DEFAULT YEAR(NOW()),
//    
//    UNIQUE(pg_id),
//    FULLTEXT KEY (pg_ipaddress,pg_page,pg_location)
//    ) ENGINE=InnoDB";
//@$conn->exec($sql);
?>