@app @entity @case_status @browse
Feature: Browse case statuses
  In order to browse case statuses
  As a system identity
  I should be able to send api requests related to case statuses

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures
  Scenario: Browse all case statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 6 items

  Scenario: Browse paginated case statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?uuid=300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?uuid[0]=300a5225-641e-4cda-b8de-b8515e568cda"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?ownerUuid=14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?ownerUuid[0]=14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?title=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?title=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse case statuses ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse case statuses ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse case statuses ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/case-statuses?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse case statuses ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/case-statuses?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 6 items

#  Scenario: Browse case statuses ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/case-statuses?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 6 items
