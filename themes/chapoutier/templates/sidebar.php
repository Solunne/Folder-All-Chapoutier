<?php
global $language;
$langue= $language->language;
?>
<div class="header-menu" style="width: 100%; background: #cecece;">
    <h3 class="title-menu text-center"><?php print t('Menu'); ?></h3><button class="close-menu"></button>
</div>
<div class="content-menu" style="width: 85%;background: #ebebeb;padding-bottom: 500px;">
    <div class="" style="margin-bottom: 5%">
        <div class="menu">
            <?php if (!empty($primary_nav_smartphone)): ?>
                <?php print render($primary_nav_smartphone); ?>
            <?php endif; ?>
        </div>
        <div class="menu">
            <?php if($langue = 'fr'){ ?>
                <a class="shop mobile" href="/<?php print $langue; ?>/boutique/nos-vins"><?php print t('Shop'); ?></a>
            <?php }elseif($langue = 'en'){ ?>
                <a class="shop mobile" href="/<?php print $langue; ?>/shop/wines"><?php print t('Shop'); ?></a>
            <?php } ?>
        </div>
    </div>
    <div class="">
        <div class="user">
            <a href="/<?php print $langue; ?>/user"><?php print t('My account'); ?></span></a>
        </div>
        <div class="logout">
            <a href="/<?php print $langue; ?>/user/logout"><?php print t('Disconnect'); ?></span></a>
        </div>
        <div class="language">
            <div class="form-item form-item-language-selection form-type-select form-group">
                <label class="control-label" for="edit-language-selection"><?php print t('Language'); ?> : </label>
                <select class="form-control form-select language-selection" id="edit-language-selection-1">
                    <?php
                        global $language;
                        $linkLocale = ($language->language == 'fr') ? 'en' : 'fr';
                        $selectedFr = ($language->language == 'fr') ? "selected" : "";
                        $selectedEn = ($language->language == 'en') ? "selected" : "";
                    ?>
                    <?php print '<option value="/fr/' . drupal_get_path_alias(current_path(), 'fr') . '" ' . $selectedFr . '>FR</option>'; ?>
                    <?php print '<option value="/en/' . drupal_get_path_alias(current_path(), 'en') . '" ' . $selectedEn . '>EN</option>'; ?>
                </select>
            </div>
        </div>
        <div class="shipping-country-form">
            <?php
                $form = drupal_get_form('wassa_chapoutier_form');
                print drupal_render($form);
            ?>
        </div>
    </div>
</div>