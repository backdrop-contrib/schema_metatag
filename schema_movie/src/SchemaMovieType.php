<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaMovieType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Movie',
      'TVSeries',
      'TVSeason',
      'TVEpisode',
    ];
  }

}
