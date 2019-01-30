@api @case_status @edit
Feature: Edit case statuses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a case status
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda" with body:
    """
    {
      "identityUuid": "683153c6-9d82-43f3-a9f3-6f49890a0500",
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
      },
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "identityUuid" should be equal to "683153c6-9d82-43f3-a9f3-6f49890a0500"
    And the JSON node "title.en" should be equal to "Request submitted - edit"
    And the JSON node "title.fr" should be equal to "Demande soumise - edit"
    And the JSON node "description.en" should be equal to "Description - edit"
    And the JSON node "description.fr" should be equal to "Description - edit"
    And the JSON node "data.en.test" should be equal to "Test - edit"
    And the JSON node "data.fr.test" should be equal to "Test - edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "identityUuid" should be equal to "683153c6-9d82-43f3-a9f3-6f49890a0500"
    And the JSON node "title.en" should be equal to "Request submitted - edit"
    And the JSON node "title.fr" should be equal to "Demande soumise - edit"
    And the JSON node "description.en" should be equal to "Description - edit"
    And the JSON node "description.fr" should be equal to "Description - edit"
    And the JSON node "data.en.test" should be equal to "Test - edit"
    And the JSON node "data.fr.test" should be equal to "Test - edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit a case status's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda" with body:
    """
    {
      "id": 9999,
      "uuid": "ce0bc895-8d99-4133-9223-a5d24cadf273",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00",
      "tenant": "3f773232-65ca-4eaf-abdd-513a8eb2ef71"
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
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "300a5225-641e-4cda-b8de-b8515e568cda"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a case status with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case_statuses/300a5225-641e-4cda-b8de-b8515e568cda" with body:
    """
    {
      "identityUuid": "d83ec028-0805-454f-b1bc-d0f658d1c41f",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
