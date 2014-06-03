Feature: Checkout
  szukaj bla bla

 # @javascript
 # Scenario: dodanie produktu do koszyka
 #   Given jestem na stronie "russische-spezialitaten/koffeinhaltiges-erfrischungsgetrank-mit-50-molkenerzeugnis-russian-power-pfandfrei-250-ml.html"

  #  When wciskam "In den Warenkorb"
  #  Then przekierowanie do "checkout/cart/"

  @javascript
  Scenario: kasa dla nie zalogowanego , dwa osobne adresy
    Given jestem na stronie "russische-spezialitaten/koffeinhaltiges-erfrischungsgetrank-mit-50-molkenerzeugnis-russian-power-pfandfrei-250-ml.html"

    When wciskam "In den Warenkorb"
    And wciskam "zur Kasse gehen"

    And zaznaczam "billing:use_for_shipping_no"
    And czekam "10000"
    And uzupelniem formularz billing w kasie

    And uzupelniem formularz shipping w kasie
    And wciskam "In den Warenkorb"
    Then przekierowanie do "checkout/onepage/success/"
