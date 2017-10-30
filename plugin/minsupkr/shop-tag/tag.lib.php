<?php
// 상품태그입력
function input_tags($tags) {
    $tag_arr = explode(',', $tags);
    $val = '';

    foreach ($tag_arr as $key) {
        $val .= '<li>';
        $val .= $key;
        $val .= '</li>';
    }

    if ($val) return $val;
    else return false;
}

// 태그 얻기
function get_tags($tags, $wrp=false) {
    $tag_arr = explode(',', $tags);
    $val = '';

    foreach ($tag_arr as $i => $key) {
        if ($wrp && $key) $val .= '<div class="item">';
        if ($key) $val .= '<a href="'.G5_URL.'/shop/tag_list.php?tag='.urlencode($key).'" class="a">#'.$key.'</a>';
        if ($wrp && $key) $val .= '</div>';
    }

    if ($val) return $val;
    else return false;
}

// 태그 추가
function add_tag($tag, $extag) {
    global $g5;

    $sql = " select tag_id from {$g5['g5_shop_item_tag_table']} where tag_name = '{$tag}' ";
    $result = sql_fetch($sql);
    if ($result['tag_id']) {
        if (!in_array($tag, $extag)) {
            $sql = " update {$g5['g5_shop_item_tag_table']} set tag_cnt = tag_cnt + 1 where tag_id = '{$result['tag_id']}' ";
            sql_query($sql);
        }
    } else {
        $sql = " insert into {$g5['g5_shop_item_tag_table']} set tag_name = '{$tag}', tag_cnt = 1 ";
        sql_query($sql);
    }

    return false;
}

// 태그 삭제
function del_tag($tag) {
    global $g5;

    $sql = " select tag_id, tag_cnt from {$g5['g5_shop_item_tag_table']} where tag_name = '{$tag}' ";
    $result = sql_fetch($sql);
    if ($result['tag_cnt'] < 2) {
        $sql = " delete from {$g5['g5_shop_item_tag_table']} where tag_id = '{$result['tag_id']}' ";
        sql_query($sql);
    } else {
        $sql = " update {$g5['g5_shop_item_tag_table']} set tag_cnt = tag_cnt - 1 where tag_id = '{$result['tag_id']}' ";
        sql_query($sql);
    }

    return false;
}

// 분류 태그 얻기
function get_ca_tags($ca_id, $tag) {
    global $g5;

    $len = strlen($ca_id);

    if ($len==2) $val = $tag;
    else {
        $cut = substr($ca_id, 0, 2);
        $sql = " select ca_tag from {$g5['g5_shop_category_table']} where ca_id = '{$cut}' ";
        $result = sql_fetch($sql);
        if ($result['ca_tag']) $val = $result['ca_tag'];
    }

    if ($val) return $val;
    else return false;
}
?>