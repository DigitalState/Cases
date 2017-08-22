@app @entity @case_status @add
Feature: Add case statuses
  In order to add case statuses
  As an admin identity
  I should be able to send api requests related to case statuses

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Add a case status
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/case-statuses" with body:
    """
    {
      "case": "/cases/c61f05ce-468f-4b21-ad38-512ea549e210",
      "owner": "BusinessUnit",
      "ownerUuid": "14da4a8c-aee1-43b3-bbac-e3e81a853e0e",
      "identity": "Individual",
      "identityUuid": "605289e0-9371-42d4-b9fe-5308c348a6a4",
      "title": {
        "en": "Title - add",
        "fr": "Titre - add"
      },
      "description": {
        "en": "Description - add",
        "fr": "Description - add"
      },
      "data": {
        "en": {
          "test": "Test - add"
        },
        "fr": {
          "test": "Test - add"
        }
      },
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 7
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    And the JSON node "title" should exist
#    And the JSON node "title" should be equal to "todo"
    And the JSON node "description" should exist
#    And the JSON node "description" should be equal to "todo"
    And the JSON node "data" should exist
#    And the JSON node "data" should be equal to "todo"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
