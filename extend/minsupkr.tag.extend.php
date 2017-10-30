<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;

include_once(G5_PLUGIN_PATH.'/minsupkr/shop-tag/tag.lib.php');

$g5['g5_shop_item_tag_table'] = G5_SHOP_TABLE_PREFIX.'item_tag'; // 쇼핑몰설정 테이블
?>