@sorting
Feature: Sort products note
  In order to sort products in the store
  As an Administrator
  I want to be able to drag and drop the product on the sorting products page

  Background:
	  Given the store operates on a single channel in "United States"
	  And the store has "mens_jeans" taxonomy
	  And the store has a "Slim fit classic" configurable product
	  And this product is in "mens_jeans" taxon at 1st position
	  And this product has been disabled
	  And I am logged in as an administrator

  @ui
  Scenario: Being able to sort products
    When I open the "mens_jeans" taxon page
    Then I should see "Slim fit classic" disabled

