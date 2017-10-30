<?php
include_once('./_common.php');

if (!$is_admin) alert('관리자만 실행 가능', G5_SHOP_URL);

// 상품 회원지정필드 추가
sql_query("
    ALTER TABLE {$g5['g5_shop_item_table']}
        ADD it_auth text NOT NULL
", true);

echo '<p>상품테이블 필드 추가완료</p>';

// 장바구니 권한필드 추가
sql_query("
    ALTER TABLE {$g5['g5_shop_cart_table']}
        ADD `it_auth` text NOT NULL
", true);

echo '<p>장바구니 필드 추가완료</p>';
?>