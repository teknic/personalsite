<?php

/**
 * @file
 *  Handles the module listing page
 */

function bt_module_list() {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/module/bt_module.css');
  if ($cached = cache_get('module_listing')) {
    return $cached->data;
  }

  $sql  = <<<SQL
    SELECT n.nid, n.title, n.created,
      b.body_value as body,
      i.field_module_icon_value as icon,
      ttd.tid as tid,
      ttd.name as tags
    FROM {node} n
      JOIN {field_data_body} b ON n.nid = b.entity_id AND b.bundle = 'module'
      JOIN {field_data_field_module_icon} i ON n.nid = i.entity_id AND i.bundle = 'module'
      JOIN {taxonomy_index} ti ON n.nid = ti.nid
      JOIN {taxonomy_term_data} ttd ON ti.tid = ttd.tid
    WHERE
      n.type = 'module'
    ORDER BY n.created
SQL;

  $modules = array();
  $result = db_query($sql);
  foreach ($result as $row) {
    if (isset($modules[$row->nid])) {
      $modules[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $modules[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
    }
    else {
      $modules[$row->nid] = (array) $row;
      $modules[$row->nid]['tags'] = array();
      $modules[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $modules[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
      $modules[$row->nid]['url'] = drupal_get_path_alias('node/' . $row->nid);
      $modules[$row->nid]['display_date'] = date('M d Y', $row->created);
    }

    if (strpos($row->tags, 'Drupal') !== FALSE) {
      $modules[$row->nid]['card_icon'] = '<i class="fa fa-drupal fa-3x"></i>';
    }
  }

  $output = theme('bt_module_list', array('modules' => $modules));
  cache_set('module_listing', $output);
  return $output;
}

/**
 * Preprocess the content type for correct display.
 *
 * @param $variables
 */
function bt_module_preprocess_module_type(&$variables) {
  if ($variables['view_mode'] == 'full') {
    drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/module/bt_module.css');
    $image = render($variables['content']['field_module_image']);
    $body = render($variables['content']['body']);
    $created_date = date('F j, Y', $variables['created']);
    $sub_heading = render($variables['content']['field_sub_heading']);
    $tags = array();
    foreach ($variables['field_tags'] as $tag) {
      $tags[$tag['tid']]['name'] = $tag['taxonomy_term']->name;
      $tags[$tag['tid']]['url'] = 'taxonomy/term/' . $tag['tid'];
    }

    $variables['module_content']['image'] = $image;
    $variables['module_content']['body'] = $body;
    $variables['module_content']['sub_heading'] = $sub_heading;
    $variables['module_content']['created_date'] = $created_date;
    $variables['module_content']['tags'] = $tags;
    $variables['module_content']['author'] = 'Brandon Tate';
  }

  if ($variables['view_mode'] == 'teaser') {
    $body = render($variables['content']['body']);
    $created_date = date('F j, Y', $variables['created']);
    $variables['module_content']['body'] = $body;
    $variables['module_content']['created_date'] = $created_date;
    $variables['module_content']['author'] = 'Brandon Tate';
  }
}
