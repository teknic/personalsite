<?php

/**
 * @file
 *  Handles the module listing page
 */

function bt_module_list() {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/modules/bt_modules.css');
//  if ($cached = cache_get('module_listing')) {
//    return $cached->data;
//  }

  $sql  = <<<SQL
    SELECT n.nid, n.title, n.created,
      b.body_value as body,
      i.field_module_image_fid as image,
      ttd.tid as tid,
      ttd.name as tags,
      fm.uri as uri
    FROM {node} n
      JOIN {field_data_body} b ON n.nid = b.entity_id AND b.bundle = 'module'
      JOIN {field_data_field_module_image} i ON n.nid = i.entity_id AND i.bundle = 'module'
      JOIN {file_managed} fm ON i.field_module_image_fid = fm.fid
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
      $modules[$row->nid]['image_style'] = image_style_url('module_thumbnail_image', $row->uri);
      $modules[$row->nid]['tags'] = array();
      $modules[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $modules[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
      $modules[$row->nid]['url'] = drupal_get_path_alias('node/' . $row->nid);
      $modules[$row->nid]['display_date'] = date('M d Y', $row->created);
    }
  }

  $output = theme('bt_module_list', array('modules' => $modules));
  // cache_set('module_listing', $output);
  return $output;
}