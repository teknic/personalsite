<?php

/**
 * Returns the contact form.
 *
 * @return array|mixed
 */
function bt_contact_page() {
  $form = drupal_get_form('bt_contact_form');
  return $form;
}

/**
 * The contact form.
 *
 * @param $form
 * @param $form_state
 * @return mixed
 */
function bt_contact_form($form, &$form_state) {
  $form['#attached']['css'] = array(drupal_get_path('module', 'bt_core') . '/css/contact/bt_contact.css');

  $form['#attributes']['class'] = array('contact-form');

  $form['your_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Your name'),
    '#required' => TRUE,
  );

  $form['your_email'] = array(
    '#type' => 'textfield',
    '#title' => t('Your email address'),
    '#required' => TRUE,
  );

  $form['subject'] = array(
    '#type' => 'textfield',
    '#title' => t('Subject'),
    '#required' => TRUE,
  );

  $form['message'] = array(
    '#type' => 'textarea',
    '#rows' => 10,
    '#title' => t('Message'),
    '#required' => TRUE,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Send Message'),
  );

  return $form;
}

/**
 * On submit, save a record and send an email to myself.
 *
 * @param $form
 * @param $form_state
 */
function bt_contact_form_submit($form, &$form_state) {
  // Send email to myself.
  $module = 'bt_core';
  $key = 'bt_contact_page';
  $to = variable_get('site_mail', 'btate340@gmail.com');
  $from = $form_state['values']['your_email'];
  $language = language_default();
  $send = TRUE;
  $params['your_name'] = $form_state['values']['your_name'];
  $params['subject'] = $form_state['values']['subject'];
  $params['message'] = "From: " . $form_state['values']['your_name'] . "\r\n";
  $params['message'] .= "Email: " .  $form_state['values']['your_email'] . "\r\n";
  $params['message'] .= "Message: " . $form_state['values']['message'];
  drupal_mail($module, $key, $to, $language, $params, $from, $send);

  // Save the message
  $record = array(
    'your_name' => $form_state['values']['your_name'],
    'your_email' => $form_state['values']['your_email'],
    'subject' => $form_state['values']['subject'],
    'message' => $form_state['values']['message']
  );
  drupal_write_record('bt_core_contact_page', $record);
}