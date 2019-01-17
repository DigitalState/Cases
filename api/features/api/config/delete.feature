@api @config @delete
Feature: Delete configs

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a config
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/configs/be5aea6f-7763-4418-b337-28eff7757fec"
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

