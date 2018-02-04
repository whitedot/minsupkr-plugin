<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/json.lib.php');

$data = array();

// 스킨경로
$skin_dir = G5_MSHOP_SKIN_PATH;
$skin_file = $skin_dir.'/'.$default['de_tag_mobile_skin'];

// 총몇개
$items = $default['de_tag_mobile_mod'] * $default['de_tag_mobile_row'];
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page < 1) $page = 1;

$page++;

// 시작 레코드 구함
$from_record = ($page - 1) * $items;

ob_start();

$list = new item_list($skin_file, $default['de_tag_mobile_mod'], $default['de_tag_mobile_row'], $default['de_tag_mobile_width'], $default['de_tag_mobile_height']);
$list->set_tag($tag);
$list->set_is_page(true);
$list->set_mobile(true);
$list->set_from_record($from_record);
$list->set_view('it_img', true);
$list->set_view('it_id', false);
$list->set_view('it_name', true);
$list->set_view('it_price', true);
echo $list->run();

$content = ob_get_contents();
ob_end_clean();

$data['item']  = $content;
$data['error'] = '';
$data['page']  = $page;

die(json_encode($data));
?>