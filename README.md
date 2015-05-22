# API Behat Starter

## Purpose

The purpose of this project is to give developers an initial starting point for 
Behat functional testing of their API application

## Structure (src)

    ├── Tests (project's tests directory)
    |   ├── Features
    |   |   ├── Context
    |   |   |   ├── FeatureContext.php (php code that runs the tests)
    |   |   ├── default.feature (gherkin syntax tests)
    ├── behat.yml.dist (will use dist file by default - rename to behat.yml for local changes only)

## Setup

1. Move the "Tests" directory/contents into your project
1. Move the behat.yml.dist file to your project root
1. Add the composer require libraries located in `composer.json` to your projects composer file
1. Update project vendor files `composer update`
1. Change the base_url Guzzle config value to your API's base url
1. Run Behat tests `bin/behat`

note: you may need to update the behat config & feature context namespaces 
      to work with your existing project namespace

### How it works

Behat is split into two main components feature files & context classes. 

Feature Files [.feature]: contain test cases called scenarios in gherkin (human readable) syntax
Context Classes [php class]: contain the PHP methods that are called for each test/assertion in the feature file

## Adding Tests

Adding tests is as simple as adding new scenarios to your test feature files using the same 
gherkin syntax found in the sample default.feature file

Next when you run `bin/behat` even if that particular test does not exist in the FeatureContext behat will 
output a sample of what the method you will need to add should look like

## Behat Docs

Visit the documentation for more information [http://docs.behat.org/en/latest/](http://docs.behat.org/en/latest/)

### Jetbrains Plugins

* [Behat](https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0CB4QFjAA&url=https%3A%2F%2Fplugins.jetbrains.com%2Fplugin%2F7300%3Fpr%3D&ei=-5hfVbzfLca2ogSHsIKoDw&usg=AFQjCNFIzPaANIXfYu9vMeNL5LjVYJiotQ)
* [Behat Support](https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=2&cad=rja&uact=8&ved=0CCUQFjAB&url=https%3A%2F%2Fplugins.jetbrains.com%2Fplugin%2F7512%3Fpr%3DphpStorm&ei=-5hfVbzfLca2ogSHsIKoDw&usg=AFQjCNFAkiXAhRzik2E8W-riAJ_FrpUWVw)

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