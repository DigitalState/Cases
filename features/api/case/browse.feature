@api @case @browse
Feature: Browse cases
  In order to browse cases
  As a system identity
  I should be able to send api requests related to cases

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Browse all cases
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse paginated cases
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?uuid=c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?uuid[0]=c61f05ce-468f-4b21-ad38-512ea549e210"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?ownerUuid=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?ownerUuid[0]=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?title=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?title=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse cases ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  Scenario: Browse cases ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse cases ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/cases?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 2 items

#  Scenario: Browse cases ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/cases?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse cases ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/cases?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response should be a collection
#    And the response collection should count 2 items
