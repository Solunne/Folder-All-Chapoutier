<div class="inner home-blocks <?php print $classes ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
        <div class="col-xs-12 first">
            <?php print $content['first']; ?>
        </div>
        <div class="col-xs-12 second">
            <div class="row">
                <div class="col-xs-12 col-md-6 left">
                    <?php print $content['left']; ?>
                </div>
                <div class="col-xs-12 col-md-6 right">
                    <?php print $content['right']; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-10 col-md-offset-1 last">
            <div class="row">
                <div class="col-xs-12 col-md-6 one">
                    <?php print $content['one']; ?>
                </div>
                <div class="col-xs-12 col-md-6 two">
                    <?php print $content['two']; ?>
                </div>
                <div class="col-xs-12 col-md-6 three">
                    <?php print $content['three']; ?>
                </div>
                <div class="col-xs-12 col-md-6 four">
                    <?php print $content['four']; ?>
                </div>
                <div class="col-xs-12 col-md-6 five">
                    <?php print $content['five']; ?>
                </div>
            </div>
        </div>
</div>
