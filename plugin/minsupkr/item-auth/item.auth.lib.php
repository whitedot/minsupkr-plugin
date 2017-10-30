<?php
// 구입권한 검사
function get_item_auth($mb_id, $auth) {

    $is_order = 0;
    $authex = explode(',', $auth);
    if (in_array($mb_id, $authex)) $is_order = 1;

    return $is_order;

}
?>