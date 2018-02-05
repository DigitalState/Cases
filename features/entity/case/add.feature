@app @entity @case @add
Feature: Add cases
  In order to add cases
  As a system identity
  I should be able to send api requests related to cases

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Add a case
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/cases" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "83bf8f26-7181-4bed-92f3-3ce5e4c286d7",
      "identity": "Individual",
      "identityUuid": "9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42",
      "title": {
        "en": "Title - add",
        "fr": "Titre - add"
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
    And the JSON node "id" should be equal to the number 3
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    And the JSON node "identity" should exist
    And the JSON node "identity" should be equal to the string "Individual"
    And the JSON node "identityUuid" should exist
    And the JSON node "identityUuid" should be equal to the string "9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Title - add"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Titre - add"
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.en.test" should exist
    And the JSON node "data.en.test" should be equal to "Test - add"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.test" should exist
    And the JSON node "data.fr.test" should be equal to "Test - add"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1

  @dropSchema
  Scenario: Read the added case
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?id=3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
