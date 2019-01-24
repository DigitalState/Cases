@api @security @firewall @case @deny
Feature: Deny access to non-authenticated users to case endpoints

  Scenario: Browse cases
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a case
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a case
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/cases" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a case
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a case
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/cases/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON