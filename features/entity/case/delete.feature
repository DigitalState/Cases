@app @entity @case @delete
Feature: Delete cases
  In order to delete cases
  As an admin identity
  I should be able to send api requests related to cases

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete a category
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 204
    And the response should be empty
