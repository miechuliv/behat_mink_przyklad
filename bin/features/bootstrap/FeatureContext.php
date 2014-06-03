<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use    Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{

    private $_baseUrl = 'http://demo.stronazen.pl/ruwelt/';
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
    /**
     * @Given /^jestem na stronie "([^"]*)"$/
     */
    public function jestemNaStronie($page)
    {
        $this->getSession()->visit($this->locatePath($this->_baseUrl.$page));
    }

    /**
     * @Then /^przekierowanie do "([^"]*)"$/
     */
    public function przekierowanieDo($page)
    {

        $this->assertSession()->addressEquals($this->_baseUrl.$page);
    }

    /**
     * @When /^wpisuje w pole wartosc "([^"]*)" "([^"]*)"$/
     */
    public function wpisujeWPoleWartosc($field,$value)
    {
        $field = $this->fixStepArgument($field);
        $value = $this->fixStepArgument($value);
        $this->getSession()->getPage()->fillField($field, $value);
    }


    /**
     * @When /^wciskam "([^"]*)"$/
     */
    public function wciskam($button)
    {
        $button = $this->fixStepArgument($button);
        $this->getSession()->getPage()->pressButton($button);
    }

    /**
     * @When /^zaznaczam "([^"]*)"$/
     */
    public function zaznaczam($field)
    {
        $field = $this->fixStepArgument($field);
        $this->getSession()->getPage()->checkField($field);
        $field = $this->getSession()->getPage()->findField($field);
        $field->click();
        $this->getSession()->executeScript('jQuery(\'input[name="shipping[same_as_billing]"]\').prop(\'checked\',false)');
        $this->getSession()->executeScript('shipping.setSameAsBilling(false);');

    }

    /**
     * @When /^czekam "([^"]*)"$/
     */
    public function czekam($duration)
    {
        $this->getSession()->wait((int)$duration );
        // asserts below
    }



    /**
     * @When /^uzywam button o klasie "([^"]*)"$/
     */
    public function uzywamButtonOKlasie($class)
    {
        $elementsByCss = $this->getSession()->getPage()->findAll('css', $class);
        $elementsByCss->click();
    }

    /**
     * @When /^uzupelniem formularz billing w kasie$/
     */
    public function uzupelniemFormularzBillingWKasie()
    {
        $this->getSession()->getPage()->fillField('billing[firstname]', 'hans');
        $this->getSession()->getPage()->fillField('billing[lastname]', 'gruber');
        $this->getSession()->getPage()->fillField('billing[email]', 'miechuliv@tlen.pl');
        $this->getSession()->getPage()->fillField('billing[street][]', 'jakas');
        $this->getSession()->getPage()->fillField('billing[postcode]', '90-900');
        $this->getSession()->getPage()->fillField('billing[city]', 'berlin');

        $region = $this->getSession()->getPage()->findField('billing[region_id]');
        $region->selectOption('Bremen');

        $city = $this->getSession()->getPage()->findField('billing[country_id]');
        $city->selectOption('Deutschland');

        $this->getSession()->getPage()->fillField('billing[telephone]', '345345345');
    }

    /**
     * @When /^uzupelniem formularz shipping w kasie$/
     */
    public function uzupelniemFormularzShippingWKasie()
    {
        $this->getSession()->getPage()->fillField('shipping[firstname]', 'hans2');
        $this->getSession()->getPage()->fillField('shipping[lastname]', 'gruber2');
       // $this->getSession()->getPage()->fillField('shipping[email]', 'miechuliv@tlen.pl');
        $this->getSession()->getPage()->fillField('shipping[street][]', 'jakas2');
        $this->getSession()->getPage()->fillField('shipping[postcode]', '90-900');
        $this->getSession()->getPage()->fillField('shipping[city]', 'berlin2');

        $region = $this->getSession()->getPage()->findField('shipping[region_id]');
        $region->selectOption('Bremen');

        $city = $this->getSession()->getPage()->findField('shipping[country_id]');
        $city->selectOption('Deutschland');

        $this->getSession()->getPage()->fillField('shipping[telephone]', '345345345');
    }

    /**
     * @Then /^powinienem zobaczyc "([^"]*)"$/
     */
    public function powinienemZobaczyc($result)
    {
        $this->assertSession()->pageTextContains($this->fixStepArgument($result));
    }
}
