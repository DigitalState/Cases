@app @entity @case @read
Feature: Read cases
  In order to read cases
  As a system identity
  I should be able to send api requests related to cases

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "c61f05ce-468f-4b21-ad38-512ea549e210"
    And the JSON node "customId" should exist
    And the JSON node "customId" should be equal to the string "GOV-c61f05ce"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    And the JSON node "identity" should exist
    And the JSON node "identity" should be equal to the string "Individual"
    And the JSON node "identityUuid" should exist
    And the JSON node "identityUuid" should be equal to the string "605289e0-9371-42d4-b9fe-5308c348a6a4"
    And the JSON node "title" should exist
#    And the JSON node "title" should be equal to "todo"
    And the JSON node "data" should exist
#    And the JSON node "data" should be equal to "todo"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
