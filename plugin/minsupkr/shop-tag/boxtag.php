<div id="tagbox" class="co-tag tags">
    <?php
    $tag_device = (G5_IS_MOBILE?'de_tag_mobile':'de_tag_pc');
    echo get_tags($default[$tag_device]);
    ?>
</div>
