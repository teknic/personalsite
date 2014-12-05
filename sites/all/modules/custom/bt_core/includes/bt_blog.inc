<?php

/**
 * Handles all the blog related functionality
 */

/**
 * Lists all blogs with pager.
 */
function bt_blog_list() {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/blog/bt_blog.css');
  if ($cached = cache_get('blog_listing')) {
    return $cached->data;
  }

  $sql  = <<<SQL
    SELECT n.nid, n.title, n.created,
      b.body_value as body,
      ttd.tid as tid,
      ttd.name as tags,
      i.field_blog_image_fid as image,
      fm.uri as uri
    FROM {node} n
      JOIN {field_data_body} b ON n.nid = b.entity_id AND b.bundle = 'blog'
      JOIN {field_data_field_blog_image} i ON n.nid = i.entity_id AND i.bundle = 'blog'
      JOIN {file_managed} fm ON i.field_blog_image_fid = fm.fid
      JOIN {taxonomy_index} ti ON n.nid = ti.nid
      JOIN {taxonomy_term_data} ttd ON ti.tid = ttd.tid
    WHERE
      n.type = 'blog'
    ORDER BY n.created
SQL;

  $blogs = array();
  $result = db_query($sql);
  foreach ($result as $row) {
    if (isset($blogs[$row->nid])) {
      $blogs[$row->created]['tags'][$row->tid]['name'] = $row->tags;
      $blogs[$row->created]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
    }
    else {
      $blogs[$row->created] = (array) $row;
      $blogs[$row->created]['image_style'] = image_style_url('blog_thumbnail_image', $row->uri);
      $blogs[$row->created]['tags'] = array();
      $blogs[$row->created]['tags'][$row->tid]['name'] = $row->tags;
      $blogs[$row->created]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
      $blogs[$row->created]['url'] = drupal_get_path_alias('node/' . $row->nid);
      $blogs[$row->created]['display_date'] = date('M d Y', $row->created);
    }
  }

  krsort($blogs);

  $output = theme('bt_blog_list', array('blogs' => $blogs));
  cache_set('blog_listing', $output);
  return $output;
}

/**
 * Preprocess the content type for correct display.
 *
 * @param $variables
 */
function bt_blog_preprocess_blog_type(&$variables) {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/blog/bt_blog.css');
  $image = render($variables['content']['field_blog_image']);
  $body = render($variables['content']['body']);
  $created_date = date('F j, Y', $variables['created']);
  $sub_heading = render($variables['content']['field_sub_heading']);
  $tags = array();
  foreach ($variables['field_tags'] as $tag) {
    $tags[$tag['tid']]['name'] = $tag['taxonomy_term']->name;
    $tags[$tag['tid']]['url'] = 'taxonomy/term/' . $tag['tid'];
  }

  $variables['blog_content']['image'] = $image;
  $variables['blog_content']['body'] = $body;
  $variables['blog_content']['sub_heading'] = $sub_heading;
  $variables['blog_content']['created_date'] = $created_date;
  $variables['blog_content']['tags'] = $tags;
  $variables['blog_content']['author'] = 'Brandon Tate';


  /**
   *
   * Print image with title over top
   * Possibly have a subtitle as well
   * Have Posted Date, Tags at top. Could use icons here. Could also include your name here
   * for example: Published by Brandon Tate (href link back to about page)
   * Could have a view code button somehwere to link to github examples
   * Content itself would be WYSIWYG
   * Bottom of content can have related blogs view (scotch.io) example
   */
}