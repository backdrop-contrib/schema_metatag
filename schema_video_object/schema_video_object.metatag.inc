<?php
/**
 * @file
 * Metatag integration for the schema_video_object module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_video_object_metatag_info() {
  $info['groups']['schema_video_object'] = array(
    'label' => t('Schema.org: VideoObject'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/VideoObject')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_video_object',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_video_object.@type'] = array(
    'label' => t('@type'),
    'description' => t('The type of video file.'),
    'form' => array(
      '#type' => 'select',
      '#options' => _schema_video_object_type_options(),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:description]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the video.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:name]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:description]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.uploadDate'] = array(
    'label' => t('uploadDate'),
    'description' => t('The date the video was first published, in ISO 8601 format.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:created:custom:Y-m-d\TH:i:sO]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.expires'] = array(
    'label' => t('expires'),
    'description' => t("If applicable, the date after which the video will no longer be available, in ISO 8601 format. Don't supply this information if your video does not expire."),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:changed:custom:Y-m-d\TH:i:sO]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.thumbnailUrl'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('thumbnailUrl'),
    'description' => t('The thumbnail URL of the video.'),
    'image' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:field_image]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.contentUrl'] = array(
    'label' => t('contentUrl'),
    'description' => t('A URL pointing to the actual video media file.'),
    'image' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:uri]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.embedUrl'] = array(
    'label' => t('embedUrl'),
    'description' => t('A URL pointing to a player for the specific video. Usually this is the information in the src element of an <embed> tag.'),
    'image' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:uri]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.mainEntityOfPage'] = array(
    'label' => t('mainEntityOfPage'),
    'description' => t(''),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[file:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.duration'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('duration'),
    'description' => t('The video duration in seconds or ISO 8601 format.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.interactionCount'] = array(
    'label' => t('interactionCount'),
    'description' => t('The number of times the video has been viewed.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}

/**
 * List the Article 'type' options.
 */
function _schema_video_object_type_options() {
  $options = array(
    'VideoObject' => t('VideoObject'),
  );
  return drupal_map_assoc($options);
}