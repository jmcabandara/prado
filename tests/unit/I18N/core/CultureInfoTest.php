<?php


use Prado\I18N\core\CultureInfo;


/**
 * @package System.I18N.core
 */
class CultureInfoTest extends PHPUnit_Framework_TestCase {
  protected $culture;

  function setUp() {
    $this->culture = CultureInfo::getInvariantCulture();
  }

  function testCultureName() {
    $name = 'en';

    $this->assertEquals($name, $this->culture->Name);

    //the default/invariant culture should be neutral
    $this->assertTrue($this->culture->IsNeutralCulture);
  }

  function testCultureList() {
    $allCultures = CultureInfo::getCultures();
    $neutralCultures = CultureInfo::getCultures(CultureInfo::NEUTRAL);
    $specificCultures = CultureInfo::getCultures(CultureInfo::SPECIFIC);

    $this->assertGreaterThanOrEqual(600, count($allCultures));
    $this->assertGreaterThanOrEqual(100, count($neutralCultures));
    $this->assertGreaterThanOrEqual(500, count($specificCultures));
  }

  function testCountryNames() {
    $culture = new CultureInfo('fr_FR');
    $this->assertEquals($culture->Countries['AE'], 'Émirats arabes unis');
  }

  function testCurrencies() {
    $culture = new CultureInfo('en_AU');
    $au = array('$', 'Australian Dollar');
    $this->assertEquals($au, $culture->Currencies['AUD']);
  }

  function testLanguages() {
    $culture = new CultureInfo('fr');
    $this->assertEquals($culture->Languages['fr'], 'français');
  }

  function testScripts() {
    $culture = new CultureInfo('fr');
    $this->assertEquals($culture->Scripts['Armn'], 'arménien');
  }

  function testTimeZones() {
    $culture = new CultureInfo('it');

    $this->assertGreaterThanOrEqual(100, count($culture->TimeZones));
  }

  function test_missing_english_names_returns_culture_code()
  {
    $culture = new CultureInfo('iw');
    $this->assertEquals($culture->getEnglishName(), 'iw');
  }
}
