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
 * - $sidebar_second_menu (array): An array containing the Secondary menu links for
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
 * @ingroup themeable
 */
?>

<div class="wrap">

  <header id="navbar" role="navigation" class="navbar navbar-default navbar-fixed-top navbar-front">
    <div class="container nav-container">
      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <div class="navbar-collapse collapse">
          <nav role="navigation">
            <?php if (!empty($primary_nav)): ?>
              <?php print render($primary_nav); ?>
            <?php endif; ?>
          </nav>
          <h1 class="site-name"><a href="/">Brandon Tate</a></h1>
          <?php print render($search); ?>
        </div>
      <?php endif; ?>
    </div>
  </header>

  <div class="main-container container">

    <div class="row">

      <section<?php print $content_column_class; ?>>
        <a id="main-content"></a>
        <?php print $messages; ?>
        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
        <?php endif; ?>
        <?php if (!empty($page['help'])): ?>
          <?php print render($page['help']); ?>
        <?php endif; ?>
        <?php print render($page['content']); ?>
        <?php if (!empty($page['disqus'])): ?>
          <?php print render($page['disqus']); ?>
        <?php endif; ?>
      </section>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row pre-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h2 class="recent-posts-title">Recent Posts</h2>
            <?php echo $recent_posts; ?>
          </div>
          <div class="col-sm-6">
            <?php echo $categories; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="sticky-container">
    <ul class="sticky">
      <li><a href="//www.drupal.org/u/teknic"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/dp1.png" /><p>Drupal</p></a></li>
      <li><a href="//twitter.com/btate-teknic"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/tw1.png" /><p>Twitter</p></a></li>
      <li><a href="//github.com/teknic"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/gb1.png" /><p>Github</p></a></li>
      <li><a href="//ca.linkedin.com/in/tatebrandon"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/li1.png" /><p>Linkedin</p></a></li>
      <li><a href="#"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/yt1.png" /><p>Youtube</p></a></li>
    </ul>
  </div>

</div>

<footer id="footer">
  <div class="container footercontainer">
    <p class="text-muted credit"><i class="fa fa-copyright"></i> Brandon Tate</p>
    <div class="connect">
      <a href="//github.com/teknic"><i class="fa fa-github fa-2x"></i></a>
      <a href="//twitter.com/btate-teknic"><i class="fa fa-twitter fa-2x"></i></a>
      <a href="//ca.linkedin.com/in/tatebrandon"><i class="fa fa-linkedin-square fa-2x"></i></a>
      <a href="//www.drupal.org/u/teknic"><i class="fa fa-drupal fa-2x"></i></a>
      <a href="#"><i class="fa fa-youtube fa-2x"></i></a>
    </div>
  </div>
</footer>
