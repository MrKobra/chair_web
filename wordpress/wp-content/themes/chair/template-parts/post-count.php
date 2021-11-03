<?php
$post_count = [3, 6, 9, 12, 24, 36, 48];
$current = 12;
if(isset($_GET['count'])) {
    $current = $_GET['count'];
}
?>
<div class="catalog-items-count">
    <span>Показывать по: </span>
    <select name="items-count" id="items-count">
        <?php foreach($post_count as $count) { ?>
            <option <?php if($current == $count) { echo 'selected="selected"'; } ?> value="<?php echo $count; ?>"><?php echo $count; ?></option>
        <?php } ?>
    </select>
</div>