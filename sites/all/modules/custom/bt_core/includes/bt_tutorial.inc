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
      $blogs[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $blogs[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
    }
    else {
      $blogs[$row->nid] = (array) $row;
      $blogs[$row->nid]['image_style'] = image_style_url('blog_thumbnail_image', $row->uri);
      $blogs[$row->nid]['tags'] = array();
      $blogs[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $blogs[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
      $blogs[$row->nid]['url'] = drupal_get_path_alias('node/' . $row->nid);
      $blogs[$row->nid]['display_date'] = date('M d Y', $row->created);
    }
  }

  $output = theme('bt_blog_list', array('blogs' => $blogs));
  cache_set('blog_listing', $output);
  return $output;
}