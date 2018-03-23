<?php

/**
 * @file
 * Metatag integration for the schema_movie module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_movie_metatag_info() {
  $info['groups']['schema_movie'] = array(
    'label' => t('Schema.org: Movie'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, <a href="!url2">!url2</a>, <a href="!url3">!url3</a>, <a href="!url4">!url4</a>, and Google\'s recommendations at <a href="!google_url">!google_url</a>.', [
      '!url' => 'http://schema.org/Movie',
      '!url2' => 'http://schema.org/TVSeries',
      '!url3' => 'http://schema.org/TVSeason',
      '!url4' => 'http://schema.org/TVEpisode',
      '!google_url' => 'https://developers.google.com/search/docs/data-types/tv-movie',
    ]),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_movie',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_movie.@type'] = array(
    'class' => 'SchemaMovieType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of movie.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. Name of the movie.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.@id'] = array(
    'label' => t('@id'),
    'description' => t('REQUIRED BY GOOGLE. Universally unique id of the item, usually a url.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('REQUIRED BY GOOGLE. The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.potentialAction'] = array(
    'class' => 'SchemaMoviePotentialAction',
    'label' => t('potentialAction'),
    'description' => t('RECOMMENDED BY GOOGLE. Actions associated with the movie.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => t('RECOMMENDED BY GOOGLE. Aggregate rating of the movie.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.hasPart'] = array(
    'class' => 'SchemaMovieHasPart',
    'label' => t('hasPart'),
    'description' => t(''),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('review'),
    'description' => t('Url of the movie.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.sameAs'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('sameAs'),
    'description' => t('Social links and other Urls.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.duration'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('duration'),
    'description' => t('Duration of the movie.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.duration'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('duration'),
    'description' => t('Duration of the movie.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.dateCreated'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('dateCreated'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.seasonNumber'] = array(
    'label' => t('seasonNumber'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.episodeNumber'] = array(
    'label' => t('episodeNumber'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.partOfSeries'] = array(
    'class' => 'SchemaCreativeWorkBase',
    'label' => t('partOfSeries'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.partOfSeason'] = array(
    'class' => 'SchemaCreativeWorkBase',
    'label' => t('partOfSeason'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.releasedEvent'] = array(
    'class' => 'SchemaEventBase',
    'label' => t('releasedEvent'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.actor'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('actor'),
    'description' => t(''),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.director'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('director'),
    'description' => t(''),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.musicBy'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('musicBy'),
    'description' => t(''),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.producer'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('producer'),
    'description' => t(''),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_movie.productionCompany'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('productionCompany'),
    'description' => t(''),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
