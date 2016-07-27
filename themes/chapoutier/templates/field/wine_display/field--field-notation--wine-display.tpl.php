<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php foreach ($items as $delta => $item) {?>
        <?php print render($item); ?>
    <?php } ?>
</div>