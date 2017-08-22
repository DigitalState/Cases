@app @entity @case_status @delete
Feature: Delete case statuses
  In order to delete case statuses
  As an admin identity
  I should be able to send api requests related to case statuses

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete a category
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 204
    And the response should be empty
