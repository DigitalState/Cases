@app @entity @case_status @edit
Feature: Edit case statuses
  In order to edit case statuses
  As an admin identity
  I should be able to send api requests related to case statuses

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Edit a case status
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda" with body:
    """
    {
      "ownerUuid": "56b4b860-d85c-4e1d-b9d4-513168f0c35e",
      "title": {
        "en": "Request submitted - edit",
        "fr": "Demande soumise - edit"
      },
      "description": {
        "en": "Description - edit",
        "fr": "Description - edit"
      },
      "data": {
        "en": {
          "test": "Test - edit"
        },
        "fr": {
          "test": "Test - edit"
        }
      }
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "56b4b860-d85c-4e1d-b9d4-513168f0c35e"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "description" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"

  Scenario: Confirm the edited case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "56b4b860-d85c-4e1d-b9d4-513168f0c35e"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "description" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"

  Scenario: Edit a case status's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda" with body:
    """
    {
      "id": 9999,
      "uuid": "ce0bc895-8d99-4133-9223-a5d24cadf273",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "300a5225-641e-4cda-b8de-b8515e568cda"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "300a5225-641e-4cda-b8de-b8515e568cda"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a case status with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case-statuses/300a5225-641e-4cda-b8de-b8515e568cda" with body:
    """
    {
      "identityUuid": "37a58567-a48c-4aa9-a955-81459da95fe2",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
