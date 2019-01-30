@api @security @tenant @case_status
Feature: Deny access to case statuses belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse case statuses from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "items": {
        "type": "object",
        "properties": {
          "tenant": {
            "type": "string",
            "pattern": "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
          }
        }
      },
      "required": [
        "tenant"
      ]
    }
    """

  Scenario: Read a case status from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses/88e41de6-c5a3-43c9-921d-d5d821ff04c4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a case status from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case_statuses/88e41de6-c5a3-43c9-921d-d5d821ff04c4" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a case status from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/case_statuses/88e41de6-c5a3-43c9-921d-d5d821ff04c4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
