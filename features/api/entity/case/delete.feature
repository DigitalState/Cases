@app @api @entity @case @delete
Feature: Delete cases
  In order to delete cases
  As a system identity
  I should be able to send api requests related to cases

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Delete a case
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted case
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @dropSchema
  Scenario: Delete a deleted case
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
