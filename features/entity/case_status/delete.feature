@app @entity @case_status @delete
Feature: Delete case statuses
  In order to delete case statuses
  As a system identity
  I should be able to send api requests related to case statuses

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Delete a case status
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @dropSchema
  Scenario: Delete a deleted case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
