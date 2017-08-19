@entity @case @edit
Feature: Edit cases
  In order to edit cases
  As an admin identity
  I should be able to send api requests related to cases

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Edit a case
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210" with body:
    """
    {
      "ownerUuid": "a735bf83-6d9c-4b29-af2b-c372231ed74f",
      "title": {
        "en": "Pothole - 123 Street - Urgent - edit",
        "fr": "Nid-de-poule - 123 rue - urgent - edit"
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
    And the JSON node "ownerUuid" should be equal to the string "a735bf83-6d9c-4b29-af2b-c372231ed74f"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"

  Scenario: Confirm the edited case
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "a735bf83-6d9c-4b29-af2b-c372231ed74f"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"

  Scenario: Edit a case's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210" with body:
    """
    {
      "id": 9999,
      "uuid": "023ef9b1-64e5-48cb-b367-6a4d09ad3161",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "c61f05ce-468f-4b21-ad38-512ea549e210"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited case
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "c61f05ce-468f-4b21-ad38-512ea549e210"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a case with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210" with body:
    """
    {
      "identityUuid": "d83ec028-0805-454f-b1bc-d0f658d1c41f",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
