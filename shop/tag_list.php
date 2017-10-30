<?php
include_once('./_common.php');

$g5['title'] = '#'.$_GET['tag'];

$tag = $_GET['tag'];

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/tag_list.php');
    return;
}

include_once(G5_SHOP_PATH.'/_head.php');

// 스킨경로
$skin_dir = G5_SHOP_SKIN_PATH;

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));
?>

<script>
var itemlist_ca_id = "<?php echo $ca_id; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.list.js"></script>

<!-- 상품 목록 시작 { -->
<div id="sct">

    <?php
    // 상품 출력순서가 있다면
    if ($sort != "")
        $order_by = $sort.' '.$sortodr.' , it_order, it_id desc';
    else
        $order_by = 'it_order, it_id desc';

    $error = '<p class="empty">등록된 상품이 없습니다.</p>';

    // 리스트 스킨
    $skin_file = $skin_dir.'/'.$default['de_tag_skin'];

    if (file_exists($skin_file)) {

        echo '<div id="sct_sortlst">';
            $sort_skin = $skin_dir.'/list.sort.skin.php';
            if(!is_file($sort_skin))
                $sort_skin = G5_SHOP_SKIN_PATH.'/list.sort.skin.php';
            include $sort_skin;

            // 상품 보기 타입 변경 버튼
            $sub_skin = $skin_dir.'/list.sub.skin.php';
            if(!is_file($sub_skin))
                $sub_skin = G5_SHOP_SKIN_PATH.'/list.sub.skin.php';
            include $sub_skin;
        echo '</div>';

        // 총몇개 = 한줄에 몇개 * 몇줄
        $items = $default['de_tag_mod'] * $default['de_tag_row'];
        // 페이지가 없으면 첫 페이지 (1 페이지)
        if ($page < 1) $page = 1;
        // 시작 레코드 구함
        $from_record = ($page - 1) * $items;

        $costf = isset($_GET['costf']) ? preg_replace('/[^0-9]/', '', trim($_GET['costf'])) : ''; // 검색 하한가
        $costt = isset($_GET['costt']) ? preg_replace('/[^0-9]/', '', trim($_GET['costt'])) : ''; // 검색 상한가

        $list = new item_list($skin_file, $default['de_tag_mod'], $default['de_tag_row'], $default['de_tag_width'], $default['de_tag_height']);
        $list->set_tag($tag);
        $list->set_is_page(true);
        $list->set_order_by($order_by);
        $list->set_from_record($from_record);
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', false);
        $list->set_view('sns', true);
        if ($costf) $list->set_costf($costf); // 검색 하한가
        if ($costt) $list->set_costt($costt); // 검색 상한가
        echo $list->run();

        // where 된 전체 상품수
        $total_count = $list->total_count;
        // 전체 페이지 계산
        $total_page  = ceil($total_count / $items);
    }
    else
    {
        echo '<div class="sct_nofile">'.str_replace(G5_PATH.'/', '', $skin_file).' 파일을 찾을 수 없습니다.<br>관리자에게 알려주시면 감사하겠습니다.</div>';
    }
    ?>

    <?php
    $qstr1 .= 'tag='.$tag;
    $qstr1 .='&amp;sort='.$sort.'&amp;sortodr='.$sortodr;
    if ($costf || $costt) $qstr1 .= '&amp;costf='.$costf.'&amp;costt='.$costt; // 검색 하한가, 상한가 _GET
    echo get_paging($config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr1.'&amp;page=');
    ?>
</div>
<!-- } 상품 목록 끝 -->

<?php
include_once(G5_SHOP_PATH.'/_tail.php');
?>