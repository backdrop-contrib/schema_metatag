<?php

/**
 * @file
 * Metatag integration for the schema_recipe module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_recipe_metatag_info() {
  $info['groups']['schema_recipe'] = array(
    'label' => t('Schema.org: Recipe'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Recipe')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_recipe',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_recipe.@type'] = array(
    'class' => 'SchemaRecipeType',
    'label' => t('@type'),
    'description' => t('The type of product (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => t('Author of the recipe.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.cookTime'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('cookTime'),
    'description' => t('Cook Time (The time it takes to actually cook the dish, in ISO 8601 duration format.)'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.prepTime'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('prepTime'),
    'description' => t("Cook Time (Prep Time (the name of the recipe, which isn’t necessarily the name of the node)."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.totalTime'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('totalTime'),
    'description' => t("Total Time (The total time required to perform instructions or a direction (including time to prepare the supplies), in ISO 8601 duration format."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.datePublished'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('datePublished'),
    'description' => t('Date the recipe was published.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.category'] = array(
    'label' => t('category'),
    'description' => t('The category of the recipe—for example, appetizer, entree, etc.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.recipeIngredient'] = array(
    'label' => t('recipeIngredient'),
    'description' => t('A list of single ingredients used in the recipe, e.g. sugar, flour or garlic.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.recipeInstructions'] = array(
    'label' => t('recipeInstructions'),
    'description' => t('Steps in making the recipe, in the form of a single item (document, video, etc.) or an ordered list with HowToStep and/or HowToSection items.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.recipeYield'] = array(
    'label' => t('recipeYield'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.rating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('rating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_recipe.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
