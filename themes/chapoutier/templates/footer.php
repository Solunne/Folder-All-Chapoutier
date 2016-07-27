
    <footer class="footer <?php print $container_class; ?>">
            <div id="cookie_assistant_container" class="col-xs-12 cookie_assistant"></div>
            <?php print render($page['footer']); ?>
            <div class="col-xs-12 newsletter-social">
                <div class="row">
                    <div class="col-xs-12 col-md-4 col-md-offset-2 text-center newsletter">
                        <h3 class="title text-center"><?php print t('Inscription newsletter'); ?></h3>
                        <?php
                            $block = module_invoke('webform', 'block_view', 'client-block-81');
                            print render($block['content']);
                        ?>
                    </div>
                    <div class="col-xs-12 col-md-4 col-md-offset-0 text-center social">
                        <h3 class="title text-center"><?php print t('Follow us'); ?></h3>
                        <?php $search_menu_name = "menu-social";
                        print theme('links', array('links' => menu_navigation_links($search_menu_name), 'attributes' => array('id' => $search_menu_name, 'class'=> array('links', 'inline')))); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-center menu-footer address">
                <?php
                    $search_menu_name = "menu-menu-footer";
                    print theme('links', array('links' => menu_navigation_links($search_menu_name), 'attributes' => array('id' => $search_menu_name, 'class'=> array('links', 'inline'))));
                ?>
                <p class="address"><?php print t('M.Chapoutier 18, av Dr Paul Durand - B.P.38 26601 Tain Cedex - France | Tel. : 0 475 082 865 | Fax : 0 475 089 636') ?></p>

            </div>
            <div class="col-xs-12 text-center alcool">
                <p class="text-center"><?php print t('Excessive drinking is dangerous for the health'); ?></p>
            </div>
    </footer>