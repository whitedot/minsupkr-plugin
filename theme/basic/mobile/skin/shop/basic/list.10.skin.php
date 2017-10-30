<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);

$pstr = '';
if ($_GET['ca_id']) $pstr .= 'ca_id='.$_GET['ca_id'];
if ($_GET['tag']) $pstr .= 'tag='.$_GET['tag'];
$pstr .= '&amp;sort='.$sort.'&amp;sortodr='.$sortodr;
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<!-- 상품진열 10 시작 { -->

<div class="sct-tofrom">
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr; ?>" class="a a-all"><span>전체상품</span></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr.'&amp;costf=0&amp;costt=100000'; ?>" class="a"><span>0~10만원</span></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr.'&amp;costf=100001&amp;costt=200000'; ?>" class="a"><span>10~20만원</span></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr.'&amp;costf=200001&amp;costt=300000'; ?>" class="a"><span>20~30만원</span></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr.'&amp;costf=300001&amp;costt=400000'; ?>" class="a"><span>30~40만원</span></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr.'&amp;costf=400001&amp;costt=500000'; ?>" class="a"><span>40~50만원</span></a>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?'.$pstr.'&amp;costf=500001'; ?>" class="a"><span>50만원 이상</span></a>
</div>

<?php
$li_width = intval(100 / $this->list_mod);
$li_width_style = ' style="width:'.$li_width.'%;"';

for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i == 0) {
        if ($this->css) {
            echo "<ul id=\"sct_wrap\" class=\"{$this->css}\">\n";
        } else {
            echo "<ul id=\"sct_wrap\" class=\"sct sct_10\">\n";
        }
    }

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"sct_li{$li_clear}\"$li_width_style>\n";

    if ($this->href) {
        echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }


    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_price) {
        echo "<div class=\"sct_cost\">\n";
        echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        echo "</div>\n";
    }

    echo "</li>\n";
}

if ($i > 0) echo "</ul>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->
