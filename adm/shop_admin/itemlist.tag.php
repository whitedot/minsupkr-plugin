<?php
$sub_menu = '400330';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '태그목록';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql = " select * from {$g5['g5_shop_item_tag_table']} ";
$result = sql_query($sql);
?>

<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL; ?>/minsupkr/shop-tag/css/tag-admin.css">

<div id="tag_list">

    <?php for($i=0;$row=sql_fetch_array($result);$i++) { ?>

    <div class="item">
        <a href="<?php echo G5_SHOP_URL; ?>/tag_list.php?tag=<?php echo $row['tag_name']; ?>" target="_blank"><?php echo $row['tag_name']; ?> (<?php echo $row['tag_cnt']; ?>)</a>
    </div>

    <?php } ?>

    <?php if (!$i) { ?><div class="empty">등록된 태그가 없습니다.</div><?php } ?>

</div>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?> 