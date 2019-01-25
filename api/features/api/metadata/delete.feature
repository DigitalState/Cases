@api @metadata @delete
Feature: Delete metadata

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a metadata
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/metadata/7d737f2c-253a-4e47-a419-183978af573a"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/7d737f2c-253a-4e47-a419-183978af573a"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/7d737f2c-253a-4e47-a419-183978af573a"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
