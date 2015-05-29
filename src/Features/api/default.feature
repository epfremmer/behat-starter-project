@prod
Feature: Default application feature file description goes here

  @homepage
  Scenario: Test default
    When I request "/"
    Then the response status code should be 200
    And the response should be json