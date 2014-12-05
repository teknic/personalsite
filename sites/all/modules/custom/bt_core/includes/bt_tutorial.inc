<?php

/**
 * Handles all the tutorial related functionality
 */

/**
 * Lists all tutorials with pager.
 */
function bt_tutorial_list() {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/tutorial/bt_tutorial.css');
  $per_page = BT_CORE_TUTORIAL_PER_PAGE;
  $total = variable_get('tutorial_total_count', 0);
  $current_page = pager_default_initialize($total, $per_page);
  // Check cache, return if you got it.
  if ($cached = cache_get('tutorial_listing_page_' . $current_page)) {
    return $cached->data;
  }

  $sql  = <<<SQL
    SELECT n.nid, n.title, n.created,
      b.field_body_value as body,
      ttd.tid as tid,
      ttd.name as tags,
      i.field_tutorial_image_fid as image,
      dl.field_difficulty_level_value as difficulty,
      fm.uri as uri
    FROM {node} n
      JOIN {field_data_field_body} b ON n.nid = b.entity_id AND b.bundle = 'tutorial'
      JOIN {field_data_field_tutorial_image} i ON n.nid = i.entity_id AND i.bundle = 'tutorial'
      JOIN {field_data_field_difficulty_level} dl ON n.nid = dl.entity_id AND dl.bundle = 'tutorial'
      JOIN {file_managed} fm ON i.field_tutorial_image_fid = fm.fid
      JOIN {taxonomy_index} ti ON n.nid = ti.nid
      JOIN {taxonomy_term_data} ttd ON ti.tid = ttd.tid
    WHERE
      n.type = 'tutorial'
    ORDER BY n.created DESC
SQL;

  $tutorials = array();
  $result = db_query($sql);
  ($current_page == 0 ? $start = 0 : $start = $current_page * $per_page);
  $row_count = 0; $last_row_created = 0;
  foreach ($result as $row) {
    if ($start == 0 || $row_count >= $start) {
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
        $tutorials[$row->nid]['difficulty'] = ucfirst($row->difficulty);
      }
    }

    // Only count unique items.
    if ($row->created != $last_row_created) {
      $last_row_created = $row->created;
      $row_count++;
    }

    // Stop if the count is equal to the pager.
    if (count($tutorials) == $per_page) {
      break;
    }
  }

  $output = theme('bt_tutorial_list', array('tutorials' => $tutorials));
  // Magic happens here. A pager appears.
  $output .= theme('pager', array('quantity', $total));
  cache_set('tutorial_listing_page_' . $current_page, $output);
  return $output;
}

/**
 * Preprocess the content type for correct display.
 *
 * @param $variables
 */
function bt_tutorial_preprocess_tutorial_type(&$variables) {
  drupal_add_css(drupal_get_path('module', 'bt_core') . '/css/tutorial/bt_tutorial.css');
  $image = render($variables['content']['field_tutorial_image']);
  $body = render($variables['content']['field_body']);
  $created_date = date('F j, Y', $variables['created']);
  $sub_heading = render($variables['content']['field_sub_heading']);
  $tags = array();
  foreach ($variables['field_tags'] as $tag) {
    $tags[$tag['tid']]['name'] = $tag['taxonomy_term']->name;
    $tags[$tag['tid']]['url'] = 'taxonomy/term/' . $tag['tid'];
  }

  $variables['tutorial_content']['image'] = $image;
  $variables['tutorial_content']['body'] = $body;
  $variables['tutorial_content']['sub_heading'] = $sub_heading;
  $variables['tutorial_content']['created_date'] = $created_date;
  $variables['tutorial_content']['tags'] = $tags;
  $variables['tutorial_content']['author'] = 'Brandon Tate';


  /**
   *
   * Print image with title over top
   * Possibly have a subtitle as well
   * Have Posted Date, Tags at top. Could use icons here. Could also include your name here
   * for example: Published by Brandon Tate (href link back to about page)
   * Could have a view code button somehwere to link to github examples
   * Content itself would be WYSIWYG
   * Bottom of content can have related tutorials view (scotch.io) example
   */
}
