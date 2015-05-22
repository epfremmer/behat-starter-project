<?php
/**
 * FeatureContext.php
 *
 * @package    Tests
 * @subpackage Behat
 */

namespace AppBundle\Tests\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Url;
use PHPUnit_Framework_Assert;

/**
 * Defines contexts to test API responses
 *
 * Basic API test context to be used as a base when creating functional API tests for Behat. This is
 * used as a starting point for writing individual application tests.
 *
 * The test context class uses Guzzle to make API requests to your application and then test the
 * response for the desired state/content. Add the API base url to the behat.yml file found in the
 * project root to start testing.
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    // request methods
    const GET     = 'GET';
    const PUT     = 'PUT';
    const POST    = 'POST';
    const PATCH   = 'PATCH';
    const HEAD    = 'HEAD';
    const OPTIONS = 'OPTIONS';

    /**
     * Guzzle Client
     * @var Client
     */
    protected $client;

    /**
     * Request Payload
     * @var array
     */
    protected $payload;

    /**
     * Guzzle Request
     * @var RequestInterface
     */
    protected $request;

    /**
     * Guzzle Response
     * @var Response
     */
    protected $response;

    /**
     * Guzzle History
     * @var History
     */
    protected $history;

    /**
     * Initialize the scenario test context
     *
     * Every scenario gets its own context instance. You can also pass arbitrary
     * arguments to the context constructor through behat.yml.
     *
     * @param array $guzzle
     */
    public function __construct($guzzle = [])
    {
        $this->client = new Client($guzzle);
    }

    /**
     * Store payload body to be used for scenario requests
     *
     * Format:
     * | key | value |
     *
     * @Given I have the request payload:
     * @param TableNode $payload
     */
    public function iHaveThePayload(TableNode $payload)
    {
        $this->payload = $payload->getRowsHash();
    }

    /**
     * Make a new guzzle request and store the response & history to be accessed
     * during future test assertions in the current scenario
     *
     * @When I request :path
     * @When I request :path with method :method
     *
     * @param string $path
     * @param string $method
     */
    public function iRequestWithMethod($path, $method = self::GET)
    {
        $history = new History();
        $client  = $this->client;
        $config  = [
            'body' => $this->payload,
        ];

        $client->getEmitter()->attach($history);

        $url = Url::fromString($path);

        $this->request  = $client->createRequest($method, $url, $config);
        $this->response = $client->send($this->request);
        $this->history  = $history;

        $client->getEmitter()->detach($history);
    }

    /**
     * @Then the response status code should be :statusCode
     */
    public function theResponseStatusCodeShouldBe($statusCode)
    {
        PHPUnit_Framework_Assert::assertEquals($statusCode, $this->response->getStatusCode());
    }

    /**
     * @Then the response status code should not be :statusCode
     */
    public function theResponseStatusCodeShouldNotBe($statusCode)
    {
        PHPUnit_Framework_Assert::assertNotEquals($statusCode, $this->response->getStatusCode());
    }

    /**
     * @Then the response should be json
     */
    public function theResponseShouldBeJson()
    {
        PHPUnit_Framework_Assert::assertJson((string)$this->response->getBody());
    }

    /**
     * @Then the response json should contain :key
     */
    public function theResponseJsonShouldContain($key)
    {
        $data = $this->response->json() ?: [];

        PHPUnit_Framework_Assert::assertArrayHasKey($key, $data);
    }

    /**
     * @Then the response json key :key should equal :value
     */
    public function theResponseJsonKeyShouldEqual($key, $value)
    {
        $data = $this->response->json() ?: [];

        PHPUnit_Framework_Assert::assertEquals($value, $data[$key]);
    }

}