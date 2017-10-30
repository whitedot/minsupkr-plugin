<?php
include_once('./_common.php');

if (!$is_admin) alert('관리자만 실행 가능', G5_SHOP_URL);

// 상품 무게필드 추가
sql_query("
    alter table {$g5['g5_shop_item_table']}
        add `it_weit` int not null default 0
", true);

echo '<p>상품테이블 필드 추가완료</p>';

// 쇼핑몰환경설정 무게별배송비 필드 추가
sql_query("
    alter table {$g5['g5_shop_default_table']}
        add `de_weit_g` int not null default 0,
        add `de_weit_cost` int not null default 0,
        add `de_weit_cost_add` int not null default 0
", true);

echo '<p>쇼핑몰환경설정 필드 추가완료</p>';

// 장바구니 무게필드 추가
sql_query("
    alter table {$g5['g5_shop_cart_table']}
        add `it_weit` int not null default 0,
        add `de_weit_g` int not null default 0,
        add `de_weit_cost` int not null default 0,
        add `de_weit_cost_add` int not null default 0
", true);

echo '<p>장바구니 필드 추가완료</p>';

// 주문서 무게필드, 무게별배송비 필드 추가
sql_query("
    alter table {$g5['g5_shop_order_table']}
        add `od_weit` int not null default 0,
        add `od_weit_cost` int not null default 0,
        add `de_weit_g` int not null default 0,
        add `de_weit_cost` int not null default 0,
        add `de_weit_cost_add` int not null default 0
", true);

echo '<p>주문서 필드 추가완료</p>';

echo '<p><a href="'.G5_SHOP_URL.'/">쇼핑몰로 돌아가기</a></p>';
?>