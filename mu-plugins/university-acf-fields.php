<?php

/**
 * Plugin Name: University ACF Fields
 * Description: Registers ACF field groups for the Fictional University project.
 */

function university_acf_fields() {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  // Homepage Slide Fields
  acf_add_local_field_group(array(
    'key' => 'group_university_homepage_slide',
    'title' => 'Slide Details',
    'fields' => array(
      array(
        'key' => 'field_university_slide_title',
        'label' => 'Slide Title',
        'name' => 'slide_title',
        'type' => 'text',
      ),
      array(
        'key' => 'field_slide_subtitle',
        'label' => 'Slide Subtitle',
        'name' => 'slide_subtitle',
        'type' => 'textarea',
        'rows' => 3,
      ),
      array(
        'key' => 'field_slide_button_text',
        'label' => 'Button Text',
        'name' => 'slide_button_text',
        'type' => 'text',
        'default_value' => 'Learn more',
      ),
      array(
        'key' => 'field_slide_button_url',
        'label' => 'Button URL',
        'name' => 'slide_button_url',
        'type' => 'url',
      ),
      array(
        'key' => 'field_slide_background_image',
        'label' => 'Background Image',
        'name' => 'slide_background_image',
        'type' => 'image',
        'return_format' => 'url',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'homepage_slide',
        ),
      ),
    ),
  ));
}

add_action('acf/init', 'university_acf_fields');

