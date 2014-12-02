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
 * @ingroup themeable
 */
?>

<div class="wrap">

  <header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
    <div class="container">
      <div class="navbar-header">
        <a href="/"><i class="pull-left fa fa-html5 fa-4x"></i></a>
      </div>
      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <div class="navbar-collapse collapse">
          <nav role="navigation">
            <?php if (!empty($primary_nav)): ?>
              <?php print render($primary_nav); ?>
            <?php endif; ?>
          </nav>
        </div>
        <?php print render($search); ?>
      <?php endif; ?>
    </div>
  </header>

  <div class="main-container container">
    <div class="row">
      <!-- Content -->
      <section<?php print $content_column_class; ?>>
        <?php print render($page['content']); ?>
      </section>
      <!-- CTAs -->
      <div class="cta-section container round">
        <div class="row">
          <div class="col-sm-3 round white">
            <h3>Modules</h3>

            <p>Modules I've open sourced.</p>

            <div class="cta-icon"><i class="fa fa-tasks fa-8x"></i></div>
          </div>
          <div class="col-sm-3 round white">
            <h3>Projects</h3>

            <p>Projects that I've worked on.</p>

            <div class="cta-icon"><i class="fa fa-folder-open-o fa-8x"></i>
            </div>
          </div>
          <div class="col-sm-3 round white">
            <h3>Tutorials</h3>

            <p>How to's and step-by-step's.</p>

            <div class="cta-icon"><i class="fa fa-file-code-o fa-8x"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="slideout">
    <h3 class="vertical-text">Connect</h3>
    <div id="slideout_inner">
      <ul>
        <li><a href="#"><i class="fa fa-github fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-stack-overflow fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-drupal fa-2x"></i></a></li>
        <li><a href="#"><i class="fa fa-youtube fa-2x"></i></a></li>
      </ul>
    </div>
  </div>

  <div class="bottom-content container">
    <div class="row">
      <div class="col-sm-6">
        <?php echo $categories; ?>
      </div>
      <div class="col-sm-6">
        <h2>Recent Posts</h2>
        <?php echo $recent_posts; ?>
      </div>
    </div>
  </div>

</div>

<footer id="footer">
  <div class="container footercontainer">
    <p class="text-muted credit"><i class="fa fa-copyright"></i> Brandon Tate</p>
    <div class="connect">
      <i class="fa fa-github fa-2x"></i>
      <i class="fa fa-twitter fa-2x"></i>
      <i class="fa fa-stack-overflow fa-2x"></i>
      <i class="fa fa-linkedin-square fa-2x"></i>
      <i class="fa fa-drupal fa-2x"></i>
      <i class="fa fa-youtube fa-2x"></i>
    </div>
  </div>
</footer>