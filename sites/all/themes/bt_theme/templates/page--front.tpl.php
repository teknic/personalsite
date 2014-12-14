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

  <div class="main-container container-fluid">
    <div class="row">
      <div class="container">
        <div class="row">
          <!-- Content -->
          <section class="col-sm-12 homepage-section">
            <?php echo $homepage_carousel; ?>
          </section>
        </div>
      </div>
    </div>

    <hr class="hr-style" />

    <div class="row">
      <!-- CTAs -->
      <div class="cta-section container">
        <div class="row">
          <div class="col-sm-4 round">
            <a href="/open-source"><h3>Open Source</h3></a>

            <p>Contributed code to the community</p>
            <a href="/open-source">
              <div class="cta-icon"><i class="fa fa-tasks fa-8x"></i></div>
            </a>
          </div>
          <div class="col-sm-4 top-to-bottom">
            <a href="/blog"><h3>Blog</h3></a>

            <p>Experiences in web development</p>
            <a href="/blog">
              <div class="cta-icon"><i class="fa fa-database fa-8x"></i>
              </div>
            </a>
          </div>
          <div class="col-sm-4">
            <a href="/tutorials"><h3>Tutorials</h3></a>

            <p>How-to's and step-by-step's.</p>
            <a href="/modules">
              <div class="cta-icon"><i class="fa fa-file-code-o fa-8x"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row pre-footer">
      <div class="container">
        <div class="row">
          <div class="recent-posts-container col-sm-6">
            <h2 class="recent-posts-title">Recent Posts</h2>
            <?php echo $recent_posts; ?>
          </div>
          <div class="category-container col-sm-6">
            <?php echo $categories; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="sticky-container">
    <ul class="sticky">
      <li><a href="//www.drupal.org/u/teknic" target="_blank"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/dp1.png" /><p>Drupal</p></a></li>
      <li><a href="//twitter.com/btate-teknic" target="_blank"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/tw1.png" /><p>Twitter</p></a></li>
      <li><a href="//github.com/teknic" target="_blank"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/gb1.png" /><p>Github</p></a></li>
      <li><a href="//ca.linkedin.com/in/tatebrandon" target="_blank"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/li1.png" /><p>Linkedin</p></a></li>
      <li><a href="#" target="_blank"><img width="32" height="32" title="" alt="" src="/sites/all/themes/bt_theme/images/yt1.png" /><p>Youtube</p></a></li>
    </ul>
  </div>

  </div>

  <footer id="footer">
    <div class="container footercontainer">
      <img class="hosted-on" src="/sites/all/themes/bt_theme/images/linode.png">
      <p class="text-muted credit"><i class="fa fa-copyright"></i> Brandon Tate
      </p>
    </div>
  </footer>