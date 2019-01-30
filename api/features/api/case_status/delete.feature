@api @case_status @delete
Feature: Delete case statuses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a case status
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
