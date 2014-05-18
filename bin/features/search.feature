Feature: Search
  szukaj bla bla


  Scenario: szukamy istniejacej strony
    Given jestem na stronie "http://www.wikipedia.com/wiki/Main_Page"
    When wpisuje w  "search" haslo "Behavior driven development"
    And wciskam "searchButton"
    Then powinienem zobaczyc "agile software development"


  Scenario: szukanie nie istniejącej strony
    Given jestem na stronie "http://www.wikipedia.com/wiki/Main_Page"
    When wpisuje w  "search" haslo "Glory Driven Development"
    And wciskam "searchButton"
    Then powinienem zobaczyc "Search Results"