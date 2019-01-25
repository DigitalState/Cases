@api @security @firewall @metadata @deny
Feature: Deny access to non-authenticated users to metadata endpoints

  Scenario: Browse metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/7d737f2c-253a-4e47-a419-183978af573a"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a metadata
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/metadata" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a metadata
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/metadata/7d737f2c-253a-4e47-a419-183978af573a" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a metadata
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/metadata/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON