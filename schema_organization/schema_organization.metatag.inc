<?php
/**
 * @file
 * Metatag integration for the schema_organization module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_organization_metatag_info() {
  $info['groups']['schema_organization'] = array(
    'label' => t('Schema.org: Organization'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Organization')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_organization',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_organization.@type'] = array(
    'label' => t('@type'),
    'description' => t('The type of organization.'),
    'form' => array(
      '#type' => 'select',
      '#options' => _schema_organization_type_options(),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the organization.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:title]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.telephone'] = array(
    'label' => t('telephone'),
    'description' => t('The telephone of the web site.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.url'] = array(
    'label' => t('url'),
    'description' => t('The url of the organization.'),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[site:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.sameAs'] = array(
    'label' => t('sameAs'),
    'description' => t('Url linked to the web site, such as wikipedia page or social profiles.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[site:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => t('The address of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.geo'] = array(
    'class' => 'SchemaGeoBase',
    'label' => t('geo'),
    'description' => t('The geographic coordinates of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.mainEntityOfPage'] = array(
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

  return $info;
}

/**
 * List the Article 'type' options.
 */
function _schema_organization_type_options() {
  $options = array(
    'Organization',
    'Airline',
    'Corporation',
    'EducationalOrganization',
    'CollegeOrUniversity',
    'ElementarySchool',
    'HighSchool',
    'MiddleSchool',
    'Preschool',
    'School',
    'GovernmentOrganization',
    'LocalBusiness',
    'AnimalShelter',
    'AutomotiveBusiness',
    'AutoBodyShop',
    'AutoDealer',
    'AutoPartsStore',
    'AutoRental',
    'AutoRepair',
    'AutoWash',
    'GasStation',
    'MotorcycleDealer',
    'MotorcycleRepair',
    'ChildCare',
    'Dentist',
    'DryCleaningOrLaundry',
    'EmergencyService',
    'FireStation',
    'Hospital',
    'PoliceStation',
    'EmploymentAgency',
    'EntertainmentBusiness',
    'AdultEntertainment',
    'AmusementPark',
    'ArtGallery',
    'Casino',
    'ComedyClub',
    'MovieTheater',
    'NightClub',
    'FinancialService',
    'AccountingService',
    'AutomatedTeller',
    'BankOrCreditUnion',
    'InsuranceAgency',
    'FoodEstablishment',
    'Bakery',
    'BarOrPub',
    'Brewery',
    'CafeOrCoffeeShop',
    'FastFoodRestaurant',
    'IceCreamShop',
    'Restaurant',
    'Winery',
    'GovernmentOffice',
    'PostOffice',
    'HealthAndBeautyBusiness',
    'BeautySalon',
    'DaySpa',
    'HairSalon',
    'HealthClub',
    'NailSalon',
    'TattooParlor',
    'HomeAndConstructionBusiness',
    'Electrician',
    'GeneralContractor',
    'HVACBusiness',
    'HousePainter',
    'Locksmith',
    'MovingCompany',
    'Plumber',
    'RoofingContractor',
    'InternetCafe',
    'LegalService',
    'Attorney',
    'Notary',
    'Library',
    'LodgingBusiness',
    'BedAndBreakfast',
    'Campground',
    'Hostel',
    'Hotel',
    'Motel',
    'Resort',
    'ProfessionalService',
    'RadioStation',
    'RealEstateAgent',
    'RecyclingCenter',
    'SelfStorage',
    'ShoppingCenter',
    'SportsActivityLocation',
    'BowlingAlley',
    'ExerciseGym',
    'GolfCourse',
    'HealthClub',
    'PublicSwimmingPool',
    'SkiResort',
    'SportsClub',
    'StadiumOrArena',
    'TennisComplex',
    'Store',
    'AutoPartsStore',
    'BikeStore',
    'BookStore',
    'ClothingStore',
    'ComputerStore',
    'ConvenienceStore',
    'DepartmentStore',
    'ElectronicsStore',
    'Florist',
    'FurnitureStore',
    'GardenStore',
    'GroceryStore',
    'HardwareStore',
    'HobbyShop',
    'HomeGoodsStore',
    'JewelryStore',
    'LiquorStore',
    'MensClothingStore',
    'MobilePhoneStore',
    'MovieRentalStore',
    'MusicStore',
    'OfficeEquipmentStore',
    'OutletStore',
    'PawnShop',
    'PetStore',
    'ShoeStore',
    'SportingGoodsStore',
    'TireShop',
    'ToyStore',
    'WholesaleStore',
    'TelevisionStation',
    'TouristInformationCenter',
    'TravelAgency',
    'MedicalOrganization',
    'Dentist',
    'Hospital',
    'Pharmacy',
    'Physician',
    'NGO',
    'PerformingGroup',
    'DanceGroup',
    'MusicGroup',
    'TheaterGroup',
    'SportsOrganization',
    'SportsTeam',
  );
  return drupal_map_assoc($options);
}
