# API Behat Starter

## Purpose

The purpose of this project is to give developers an initial starting point for 
Behat functional testing of their API application

## Structure (src)

├── Tests (project's tests directory)
|   ├── Contexts
|   |   ├── FeatureContext.php (php code that runs the tests)
|   ├── Features
|   |   ├── default.feature (gherkin syntax tests)
├── behat.yml.dist (will use dist file by default - rename to behat.yml for local changes only)

## Setup

1. Move the "Tests" directory/contents into your project
1. Move the behat.yml.dist file to your project root
1. Add the composer require libraries located in `composer.json` to your projects composer file
1. Update project vendor files `composer update`
1. Change the base_url Guzzle config value to your API's base url
1. Run Behat tests `bin/behat`

### How it works

Behat is split into two main components feature files & context classes. 

Feature Files [.feature]: contain test cases called scenarios in gherkin (human readable) syntax
Context Classes [php class]: contain the PHP methods that are called for each test/assertion in the feature file

## Adding Tests

Adding tests is as simple as adding new scenarios to your test feature files using the same 
gherkin syntax found in the sample default.feature file

Next when you run `bin/behat` even if that particular test does not exist in the FeatureContext behat will 
output a sample of what the method you will need to add should look like

## Behat Information

Visit the documentation for more information [http://docs.behat.org/en/latest/](http://docs.behat.org/en/latest/)

### Scenarios

Each test "scenario" tests a specific use case of your application. For example:
  
```
Scenario: Description of use case scenario here
  When I request "/"
  Then the response status code should be 200
  And the response should be json
```

Would make a request to "/" and the validate that the response status code 
was 200 and contained JSON as the response body

### Tags

Tags can be added before both features & scenarios to filter which tests you want to run

Tag format: @tag_name
Usage:      bin/behat --tags @tag_name