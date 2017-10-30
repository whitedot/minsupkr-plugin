<?php
include_once('./_common.php');

include_once(G5_MSHOP_PATH.'/_head.php');

// 스킨경로
$skin_dir = G5_MSHOP_SKIN_PATH;

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));
?>

<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>

<div id="sct">
    <?php
    // 상품 출력순서가 있다면
    if ($sort != "")
        $order_by = $sort.' '.$sortodr.' , it_order, it_id desc';
    else
        $order_by = 'it_order, it_id desc';

    $error = '<p class="sct_noitem">등록된 상품이 없습니다.</p>';

    // 리스트 스킨
    $skin_file = $skin_dir.'/'.$default['de_tag_mobile_skin'];

    if (file_exists($skin_file)) {
        $sort_skin = $skin_dir.'/list.sort.skin.php';
        if(!is_file($sort_skin))
            $sort_skin = G5_MSHOP_SKIN_PATH.'/list.sort.skin.php';
        include $sort_skin;

        // 총몇개
        $items = $default['de_tag_mobile_mod'] * $default['de_tag_mobile_row'];
        // 페이지가 없으면 첫 페이지 (1 페이지)
        if ($page < 1) $page = 1;
        // 시작 레코드 구함
        $from_record = ($page - 1) * $items;

        $list = new item_list($skin_file, $default['de_tag_mobile_mod'], $default['de_tag_mobile_row'], $default['de_tag_mobile_width'], $default['de_tag_mobile_height']);
        $list->set_tag($tag);
        $list->set_is_page(true);
        $list->set_mobile(true);
        $list->set_order_by($order_by);
        $list->set_from_record($from_record);
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_basic', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('sns', true);
        echo $list->run();

        // where 된 전체 상품수
        $total_count = $list->total_count;
    }
    else
    {
        echo '<div class="sct_nofile">'.str_replace(G5_PATH.'/', '', $skin_file).' 파일을 찾을 수 없습니다.<br>관리자에게 알려주시면 감사하겠습니다.</div>';
    }
    ?>

    <?php
    if($i > 0 && $total_count > $items) {
        $qstr1 .= 'tag='.$tag;
        $qstr1 .='&sort='.$sort.'&sortodr='.$sortodr;
        $ajax_url = G5_SHOP_URL.'/ajax.tag.list.php?'.$qstr1;
    ?>
    <div class="li_more">
        <p id="item_load_msg"><img src="<?php echo G5_SHOP_CSS_URL; ?>/img/loading.gif" alt="로딩이미지" ><br>잠시만 기다려주세요.</p>
        <div class="li_more_btn">
            <button type="button" id="btn_more_item" data-url="<?php echo $ajax_url; ?>" data-page="<?php echo $page; ?>">MORE ITEM /button>
        </div>
    </div>
    <?php } ?>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>