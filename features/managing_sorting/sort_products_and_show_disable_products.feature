@sorting
Feature: Sort products and show disabled products
	In order to sort products in category
	As an Administrator
	I want to be able to sort product and to see disabled products on the taxon sorting page

	Background:
		Given the store operates on a single channel in "United States"
		And the store has "mens_jeans" taxonomy
		And the store has a "Slim fit classic" configurable product
		And this product is in "mens_jeans" taxon at 1st position
		And this product has been disabled
		And the store has a "Slim fit elegant" configurable product
		And this product is in "mens_jeans" taxon at 2nd position
		And I am logged in as an administrator

	@ui
	Scenario: Being able to sort products
		Given I open the "mens_jeans" taxon sorting page
		And "Slim fit classic" product is in 1st position
		When I save position
		Then I should be notified that the products has been sorted
		And I should see the "Slim fit classic" in 1st position

	@ui
	Scenario: Being able to see disable products
		Given I open the "mens_jeans" taxon sorting page
		Then I should see "Slim fit classic" disabled
