<?php
include_once('./_common.php');

$g5['title'] = '전체태그';

include_once(G5_SHOP_PATH.'/_head.php');

$sql = " select * from {$g5['g5_shop_item_tag_table']} ";
$result = sql_query($sql);
?>

<div id="tagall" class="co-tag">

    <?php for($i=0;$row=sql_fetch_array($result);$i++) { ?>
        <a href="<?php echo G5_SHOP_URL; ?>/tag_list.php?tag=<?php echo $row['tag_name']; ?>" class="a">#<?php echo $row['tag_name']; ?>(<?php echo $row['tag_cnt']; ?>)</a>
    <?php } ?>

    <?php if (!$i) { ?><div class="empty">등록된 태그가 없습니다.</div><?php } ?>

</div>

<?php
include_once(G5_SHOP_PATH.'/_tail.php');
?>