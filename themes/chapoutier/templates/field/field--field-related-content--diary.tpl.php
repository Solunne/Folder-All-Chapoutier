<div class="row">
    <?php foreach ($items as $delta => $item): ?>
        <div class="col-md-4 related-content-article <?php print $delta % 2 ? 'odd' : 'even'; ?>">
            <?php print render($item); ?>
        </div>
    <?php endforeach; ?>
</div>