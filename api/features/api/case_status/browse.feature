@api @case_status @browse
Feature: Browse case statuses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse all case statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6,
      "items": {
        "type": "object",
        "properties": {
          "id": {
            "type": "integer"
          },
          "uuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "createdAt": {
            "type": "string"
          },
          "updatedAt": {
            "type": "string"
          },
          "deletedAt": {
            "type": ["string", "null"]
          },
          "owner": {
            "type": "string"
          },
          "ownerUuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "identity": {
            "type": "string"
          },
          "identityUuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "title": {
            "type": "object"
          },
          "data": {
            "type": "object"
          },
          "state": {
            "type": "integer"
          },
          "priority": {
            "type": "integer"
          },
          "statuses": {
            "type": "array"
          },
          "version": {
            "type": "integer"
          },
          "tenant": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          }
        }
      },
      "required": [
        "id",
        "uuid",
        "createdAt",
        "updatedAt",
        "deletedAt",
        "owner",
        "ownerUuid",
        "identity",
        "identityUuid",
        "title",
        "data",
        "state",
        "priority",
        "statuses",
        "version",
        "tenant"
      ]
    }
    """

  Scenario: Browse paginated case statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?_page=1&_limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse case statuses with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse case statuses with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse case statuses with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?uuid=300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse case statuses with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?uuid[0]=300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse case statuses with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?ownerUuid=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?ownerUuid[0]=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 0,
      "maxItems": 0
    }
    """

  Scenario: Browse case statuses with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 0,
      "maxItems": 0
    }
    """

  Scenario: Browse case statuses that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?title=Request"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?title=request"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

  Scenario: Browse case statuses ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 6,
      "maxItems": 6
    }
    """

#  Scenario: Browse case statuses ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/case_statuses?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 6 items

#  Scenario: Browse case statuses ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/case_statuses?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 6 items
