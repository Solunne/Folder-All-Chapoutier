<div class="row">
    <?php foreach ($items as $delta => $item): ?>
        <div class="col-md-4 vert-offset-top-1 vert-offset-bottom-1 secondary-picture <?php print $delta % 2 ? 'odd' : 'even'; ?>"><?php print render($item); ?></div>
    <?php endforeach; ?>
</div>