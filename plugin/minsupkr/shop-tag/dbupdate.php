<?php
include_once('./_common.php');

if (!$is_admin) alert('관리자만 실행 가능');

sql_query(" ALTER TABLE {$g5['g5_shop_default_table']}
                ADD de_tag_pc varchar(255) NOT NULL,
                ADD de_tag_mobile varchar(255) NOT NULL,
                ADD de_tag_skin varchar(255) NOT NULL DEFAULT 'list.10.skin.php',
                ADD de_tag_mobile_skin varchar(255) NOT NULL DEFAULT 'list.10.skin.php',
                ADD de_tag_width int NOT NULL DEFAULT 230,
                ADD de_tag_height int NOT NULL DEFAULT 230,
                ADD de_tag_mod int NOT NULL DEFAULT 3,
                ADD de_tag_row int NOT NULL DEFAULT 5,
                ADD de_tag_mobile_width int NOT NULL DEFAULT 230,
                ADD de_tag_mobile_height int NOT NULL DEFAULT 230,
                ADD de_tag_mobile_mod int NOT NULL DEFAULT 3,
                ADD de_tag_mobile_row int NOT NULL DEFAULT 5
                ", true
);

echo '<p>g5_shop_default 설정완료</p>';

sql_query(" ALTER TABLE {$g5['g5_shop_item_table']}
                ADD it_tag varchar(255) NOT NULL
                ", true
);

echo '<p>g5_shop_item 설정완료</p>';

sql_query(" ALTER TABLE {$g5['g5_shop_category_table']}
                ADD ca_tag varchar(255) NOT NULL
                ", true
);

echo '<p>g5_shop_category 설정완료</p>';

sql_query(" CREATE TABLE  `".G5_SHOP_TABLE_PREFIX."item_tag` (
                `tag_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `tag_name` VARCHAR( 255 ) NOT NULL ,
                `tag_cnt` INT NOT NULL
                ) ENGINE = MYISAM DEFAULT CHARSET=utf8;
                ", true
);

echo '<p>g5_shop_item_tag 설정완료</p>';

echo '<p><a href="'.G5_SHOP_URL.'/">쇼핑몰로 돌아가기</a></p>';
?>