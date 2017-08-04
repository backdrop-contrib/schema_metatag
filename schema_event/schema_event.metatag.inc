<?php
/**
 * @file
 * Metatag integration for the schema_event module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_event_metatag_info() {
  $info['groups']['schema_event'] = array(
    'label' => t('Schema.org: Event'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Event')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_event',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_event.@type'] = array(
    'label' => t('@type'),
    'description' => t('The type of event.'),
    'form' => array(
      '#type' => 'select',
      '#options' => _schema_event_type_options(),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the event.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:title]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this event.'),
    'image' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_image]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the event.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_event.url'] = array(
    'label' => t('url'),
    'description' => t('The url of the event.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.doorTime'] = array(
    'label' => t('doorTime'),
    'description' => t('The time when admission will commence.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.startDate'] = array(
    'label' => t('startDate'),
    'description' => t('Date and time when the event starts.'),
    'multiple' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_date:custom:Y-m-d\TH:i:sO]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.endDate'] = array(
    'label' => t('endDate'),
    'description' => t('Date and time when the event ends.'),
    'multiple' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_date:custom:Y-m-d\TH:i:sO]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.location'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('location'),
    'description' => t('The location of the event.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.offers'] = array(
    'class' => 'SchemaOfferBase',
    'label' => t('offers'),
    'description' => t('Offers associated with the event.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.mainEntityOfPage'] = array(
    'label' => t('mainEntityOfPage'),
    'description' => t(''),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.performer'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('performer'),
    'description' => t('The performer on the event.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}

/**
 * List the Article 'type' options.
 */
function _schema_event_type_options() {
  $options = array(
    'Event',
    'BusinessEvent',
    'ChildrensEvent',
    'ComedyEvent',
    'CourseInstance',
    'DanceEvent',
    'DeliveryEvent',
    'EducationEvent',
    'ExhibitionEvent',
    'Festival',
    'FoodEvent',
    'LiteraryEvent',
    'MusicEvent',
    'PublicationEvent',
    'SaleEvent',
    'ScreeningEvent',
    'SocialEvent',
    'SportsEvent',
    'TheaterEvent',
    'VisualArtsEvent',
  );
  return drupal_map_assoc($options);
}
