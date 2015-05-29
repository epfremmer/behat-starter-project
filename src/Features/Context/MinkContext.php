<?php
/**
 * MinkContext.php
 *
 * @package    Tests
 * @subpackage Behat
 */
namespace Features\Context;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext as BaseMinkContext;
use PHPUnit_Framework_Assert;

/**
 * Defines context to test Web pages
 *
 * These test cases use the Behat Mink extension and browser driver
 * to preform automated functional/acceptance testing.
 *
 * Read the documentation below and review the base Mink Context capabilities
 * for additional information on creating specific scenarios & test cases
 *
 * @see http://mink.behat.org/en/latest/
 * @see https://github.com/Behat/MinkExtension
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
class MinkContext extends BaseMinkContext implements SnippetAcceptingContext
{

    /**
     * @Then /^I wait for the suggestion box to appear$/
     */
    public function iWaitForTheSuggestionBoxToAppear()
    {
        $this->getSession()->wait(5000, "$('.suggestions-results').children().length > 0");
    }

}