@api @security @firewall @case_status
Feature: Deny access to non-authenticated users to case status endpoints

  Scenario: Browse case statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a case status
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case_statuses/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a case status
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/case_statuses" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a case status
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/case_statuses/c61f05ce-468f-4b21-ad38-512ea549e210" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a case status
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/case_statuses/c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON