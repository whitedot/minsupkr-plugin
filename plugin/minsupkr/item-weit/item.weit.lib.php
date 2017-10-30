<?php

// 무게 표시 g to kg
function get_weit($weit) {
     $weit = ceil($weit);

    if ($weit >= 1000) $val = round($weit / 1000, 2).' kg';
    else $val = $weit.' g';

    return $val;
}

// 무게별 배송비 (무게, 기준무게, 기준금액, 초과금액)
function get_weit_cost($weit, $g, $cost, $cost_add) {
    $val = $weit / $g;
    $val = ceil($val);

    if ($val > 1) $price = $cost + $cost_add * ($val - 1);
    else $price = $cost * $val;

    return $price;
}

// (취소, 품절, 반품) 무게별 배송비 (주문총무게, 취소무게, 기준무게, 기준금액, 초과금액)
function get_weit_cancel_cost($save, $cancel, $g, $cost, $cost_add) {
    if ($save <= $g) $val = 0;
    else {
        $diff_weit = $save - $cancel;
        $save_cost = get_weit_cost($save, $g, $cost, $cost_add);
        $cancel_cost = get_weit_cost($diff_weit, $g, $cost, $cost_add);
        $val = $save_cost - $cancel_cost;
    }

    return $val;
}

// 배송비 구함
function get_weit_cost_cart($cart_id, $selected=1)
{
    global $default, $g5;

    $weit_cost = 0;
    $tot_weit = 0;
    $weit_g = $default['de_weit_g'];
    $weit_cost = $default['de_weit_cost'];
    $weit_cost_add = $default['de_weit_cost_add'];


    $sql = " select distinct it_id
                from {$g5['g5_shop_cart_table']}
                where od_id = '$cart_id'
                  and ct_status IN ( '쇼핑', '주문', '입금', '준비', '배송', '완료' )
                  and ct_select = '$selected' ";

    $result = sql_query($sql);
    for($i=0; $sc=sql_fetch_array($result); $i++) {
        // 합계
        $sql = " select SUM(it_weit * ct_qty) as itweit
                    from {$g5['g5_shop_cart_table']}
                    where it_id = '{$sc['it_id']}'
                        and od_id = '$cart_id'
                        and ct_status IN ( '쇼핑', '주문', '입금', '준비', '배송', '완료' )
                        and ct_select = '$selected'";
        $sum = sql_fetch($sql);

        $weit = $sum['itweit'];

        if ($weit > 0) 
            $tot_weit += $weit;
    }

    $weit_cost = get_weit_cost($tot_weit, $weit_g, $weit_cost, $weit_cost_add);

    return $weit_cost;
}

// 장바구니에 담긴 상품의 무게배송비 정보가 쇼핑몰설정과 같은지 검사
function chk_weit_default($name, $g, $cost, $cost_add) {
    global $default;

    $chk_weit = 0;

    if ($g != $default['de_weit_g']) $chk_weit++;
    if ($cost != $default['de_weit_cost']) $chk_weit++;
    if ($cost_add != $default['de_weit_cost_add']) $chk_weit++;

    if ($chk_weit) {
        // 두 가지 방법이 있음
        // 알림 메세지 후 카트로 이동하는 방법 (현재 방법)
        // 카트 정보를 현재 쇼핑몰설정으로 업데이트하는 방법
        $msg = $name.' 상품의 무게배송비 정보가 변경되었습니다. 삭제하신 후 다시 장바구니에 담아주십시오.';
        $href = G5_SHOP_URL.'/cart.php';

        alert($msg, $href);
    } else {
        return false;
    }
}
?>