<?php

/**
 * Handles all the tutorial related functionality
 */

/**
 * Lists all tutorials with pager.
 */
function bt_tutorial_list() {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/tutorial/bt_tutorial.css');
//  if ($cached = cache_get('tutorial_listing')) {
//    return $cached->data;
//  }

  $sql  = <<<SQL
    SELECT n.nid, n.title, n.created,
      b.body_value as body,
      ttd.tid as tid,
      ttd.name as tags,
      i.field_tutorial_image_fid as image,
      dl.field_difficulty_level_value as difficulty,
      fm.uri as uri
    FROM {node} n
      JOIN {field_data_body} b ON n.nid = b.entity_id AND b.bundle = 'tutorial'
      JOIN {field_data_field_tutorial_image} i ON n.nid = i.entity_id AND i.bundle = 'tutorial'
      JOIN {field_data_field_difficulty_level} dl ON n.nid = dl.entity_id AND dl.bundle = 'tutorial'
      JOIN {file_managed} fm ON i.field_tutorial_image_fid = fm.fid
      JOIN {taxonomy_index} ti ON n.nid = ti.nid
      JOIN {taxonomy_term_data} ttd ON ti.tid = ttd.tid
    WHERE
      n.type = 'tutorial'
    ORDER BY n.created
SQL;

  $tutorials = array();
  $result = db_query($sql);
  foreach ($result as $row) {
    if (isset($tutorials[$row->nid])) {
      $tutorials[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $tutorials[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
    }
    else {
      $tutorials[$row->nid] = (array) $row;
      $tutorials[$row->nid]['image_style'] = image_style_url('tutorial_thumbnail_image', $row->uri);
      $tutorials[$row->nid]['tags'] = array();
      $tutorials[$row->nid]['tags'][$row->tid]['name'] = $row->tags;
      $tutorials[$row->nid]['tags'][$row->tid]['url'] = drupal_get_path_alias('taxonomy/term/' . $row->tid);
      $tutorials[$row->nid]['url'] = drupal_get_path_alias('node/' . $row->nid);
      $tutorials[$row->nid]['display_date'] = date('M d Y', $row->created);
      $tutorials[$row->nid]['difficulty'] = $row->difficulty;
    }
  }

  $output = theme('bt_tutorial_list', array('tutorials' => $tutorials));
//  cache_set('tutorial_listing', $output);
  return $output;
}