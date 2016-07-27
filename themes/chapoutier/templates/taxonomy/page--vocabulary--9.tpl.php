<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
global $language;
$langue = $language->language;

$primary_nav_smartphone = $primary_nav;
?>

<div id="wrapper">

  <div id="sidebar-wrapper">
    <div class="row">
      <div class="user col-xs-12">
        <a href="/<?php print $langue; ?>/user"><?php print t('User'); ?></span></a>
      </div>
      <div class="language col-xs-12">
        <?php $block = module_invoke('locale', 'block_view', 'language'); print $block['content']; ?>
      </div>
      <div class="menu col-xs-12">
        <?php if (!empty($primary_nav_smartphone)): ?>
          <?php print render($primary_nav_smartphone); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div id="page-content-wrapper">

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
            <a class="site-title logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
              <img src="/sites/all/themes/chapoutier/img/logo_chapoutier_desktop.svg"/>
              <span><?php print $site_name; ?></span>
            </a>
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
                  $linkLocale = ($language->language == 'fr') ? 'en' : 'fr';
                  $selectedFr = ($language->language == 'fr') ? "selected" : "";
                  $selectedEn = ($language->language == 'en') ? "selected" : "";
                  ?>
                  <?php print '<option value="/fr/' . drupal_get_path_alias(current_path(), 'fr') . '" ' . $selectedFr . '>FR</option>'; ?>
                  <?php print '<option value="/en/' . drupal_get_path_alias(current_path(), 'en') . '" ' . $selectedEn . '>EN</option>'; ?>
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
    <div class="main-container <?php print $container_class; ?>">

      <div class="row">

        <?php if (!empty($page['sidebar_first'])): ?>
          <aside class="col-sm-3" role="complementary">
            <?php print render($page['sidebar_first']); ?>
          </aside>  <!-- /#sidebar-first -->
        <?php endif; ?>

        <section<?php print $content_column_class; ?>>
          <?php if (!empty($page['highlighted'])): ?>
            <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
          <?php endif; ?>
          <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
          <a id="main-content"></a>
          <?php print render($title_prefix); ?>

          <?php if (!empty($title)): ?>
            <h1 class="page-header hidden"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php print $messages; ?>
          <?php
            $blockObject = block_load('views', 'diary-filter');
            $block = _block_get_renderable_array(_block_render_blocks(array($blockObject)));
            $output = drupal_render($block);
            print $output;
          ?>


        </section>

        <?php if (!empty($page['sidebar_second'])): ?>
          <aside class="col-sm-3" role="complementary">
            <?php print render($page['sidebar_second']); ?>
          </aside>  <!-- /#sidebar-second -->
        <?php endif; ?>

      </div>
    </div>

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

  </div>
  <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->