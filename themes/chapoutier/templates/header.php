<header id="navbar" role="banner" class="<?php print $navbar_classes; ?> <?php print $container_class; ?>">
    <div class="row">
        <div class="menu-toggle col-xs-1">
            <button href="#menu-toggle" id="menu-toggle" type="button" class="navbar-toggle pull-left">
                <span class="sr-only"><?php print t('Menu'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="branding col-xs-6 col-md-3 col-lg-3">
            <?php if ($logo): ?>
                <a class="site-title logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="/sites/all/themes/chapoutier/img/logo_chapoutier_desktop.svg"/><span><?php print $site_name; ?></span></a>
            <?php endif; ?>
        </div>
        <div class="navbar-header">
            <div class="navbar-collapse collapse">
                <nav role="navigation">
                    <?php if (!empty($primary_nav)): ?>
                        <?php print render($primary_nav); ?>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        <div class="mega_menu">
            <?php $block = module_invoke('panels_mini', 'block_view', 'mega_menu_shop'); print $block['content']; ?>
        </div>
        <!-- <div class="other col-xs-4 col-md-3 col-lg-3 pull-right text-right">
            <div class="row">
                <div class="shipping-country-form col-md-4">
                    <?php
                        // $form = drupal_get_form('wassa_chapoutier_form');
                        // print drupal_render($form);
                    ?>
                </div>
                <div class="cart col-xs-5 col-md-offset-8 col-md-2">
                    <?php // print render($page['cart']); ?>
                </div>
               <div class="user col-md-2">
                    <a href="/<?php // print $langue; ?>/user/login"><?php // print t('My account'); ?></span></a>
                </div>
                 <div class="language col-md-4">
                    <div class="dropdown">
                        <a id="choice-language" class="language-current <?php // print $langue; ?>" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php // print t('Language'); ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="choice-language">
                            <?php // $block = module_invoke('locale', 'block_view', 'language'); print $block['content']; ?>
                        </ul>
                    </div>
                </div>
                <div class="search col-xs-5 col-md-3 col-md-offset-9">
                    <a href="javascript:void(0);"><?php // print t('Search'); ?></a>
                </div>
            </div>
        </div> -->
        <div class="other col-xs-4 col-md-3 col-lg-3 pull-right text-right">
            <div class="row">
                <div class="shipping-country-form">
                    <?php
                        $form = drupal_get_form('wassa_chapoutier_form');
                        print drupal_render($form);
                    ?>
                </div>
                <div class="language">
                    <div class="form-item form-item-language-selection form-type-select form-group">
                        <label class="control-label" for="edit-language-selection"><?php print t('Language'); ?> : </label>
                        <select class="form-control form-select language-selection" id="edit-language-selection">
                            <?php
                                global $language;
                                $linkLocale = $language->language;
                                //$linkLocale = ($language->language == 'fr') ? 'en' : 'fr' : 'de' : 'zh-hans';
                                //$selectedFr = ($language->language == 'fr') ? "selected" : "";
                                //$selectedEn = ($language->language == 'en') ? "selected" : "";
                                //$selectedDe = ($language->language == 'de') ? "selected" : "";
                                //$selectedZh = ($language->language == 'zh-hans') ? "selected" : "";

                                switch ($linkLocale) {
                                    case 'fr':
                                        $selectedFr = ($language->language == 'fr') ? "selected" : "";
                                        break;
                                    case 'en':
                                        $selectedEn = ($language->language == 'en') ? "selected" : "";
                                        break;
                                    case 'de':
                                        $selectedDe = ($language->language == 'de') ? "selected" : "";
                                        break;
                                    case 'zh-hans':
                                        $selectedZh = ($language->language == 'zh-hans') ? "selected" : "";
                                        break;
                                }

                            ?>
                            <?php print '<option value="/fr/' . drupal_get_path_alias(current_path(), 'fr') . '" ' . $selectedFr . '>FR</option>'; ?>
                            <?php print '<option value="/en/' . drupal_get_path_alias(current_path(), 'en') . '" ' . $selectedEn . '>EN</option>'; ?>
                            <?php print '<option value="/de/' . drupal_get_path_alias(current_path(), 'en') . '" ' . $selectedDe . '>DE</option>'; ?>
                            <?php print '<option value="/zh-hans/' . drupal_get_path_alias(current_path(), 'en') . '" ' . $selectedZh . '>中国</option>'; ?>
                        </select>
                    </div>
                </div>
                <div class="cart"><?php print render($page['cart']); ?></div>
                <div class="user">
                    <a href="/<?php print $langue; ?>/user/login"><?php print t('My account'); ?></span></a>
                </div>
            </div>
            <div class="row"></div>
            <div class="row">
                <div class="search">
                    <a href="javascript:void(0);"><?php print t('Search'); ?></a>
                </div>
            </div>
        </div>
    </div>
</header>