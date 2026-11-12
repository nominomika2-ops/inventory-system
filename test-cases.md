

\# Inventory System - Test Cases



\## Test Case Results



| ID | Test | Steps | Expected result | Actual result | Pass/Fail |

|---|---|---|---|---|---|

| T1 | Login with the right email and password | Open `/login`. Enter the correct email and password. Click Login. | User should be logged in and redirected to the Dashboard. | Dashboard opened successfully after login. | Pass |

| T2 | Login with a wrong password | Open `/login`. Enter a valid email and an incorrect password. Click Login. | Login should be rejected and an error message should be displayed. | Login was rejected and an error message was displayed. | Pass |

| T3 | Open `/products` when logged out | Logout. Enter `/products` in the browser. | User should be redirected to the Login page. | User was redirected to the Login page. | Pass |

| T4 | Staff opens `/products/create` | Login as Staff. Open `/products/create`. | Access should be denied with a 403 Forbidden error. | Staff access was denied with a 403 Forbidden error. | Pass |

| T5 | Admin adds a product with correct data | Login as Admin. Open Add Product. Enter valid product name, category, price and stock. Submit. | Product should be saved successfully and displayed in the Products list. | Product was saved and displayed in the Products list. | Pass |

| T6 | Admin adds a product with an empty name | Login as Admin. Open Add Product. Leave the product name empty and submit. | Validation error should be displayed. Product should not be saved. | Validation error was displayed and product was not saved. | Pass |

| T7 | Search for a product by name | Open Products. Enter an existing product name in the search box. Submit the search. | Only matching products should be displayed. | Matching products were displayed. | Pass |

| T8 | Filter products by category, then go to page 2 | Open Products. Select a category containing more than 10 products. Apply the filter. Click page 2. | Page 2 should display products from the selected category. | Page 2 displayed products from the selected category. | Pass |

| T9 | Stock out more than the stock available | Open a product with limited stock. Try to stock out a quantity greater than its available stock. | Stock out should be rejected. Stock should not become negative. | Stock out was rejected and stock did not become negative. | Pass |

| T10 | Stock in 10 and check the new stock | Open a product. Record its current stock. Stock in 10 units. Check the updated stock. | Product stock should increase by 10. | Product stock increased by 10. | Pass |

| T11 | Delete a category that has products | Login as Admin. Open Categories. Try to delete a category that contains products. | Deletion should be blocked and the category should remain. | Category deletion was blocked and the category remained. | Pass |

| T12 | The total on the stock value report matches the database | Open Stock Value Report. Note the total. Run `SELECT SUM(stock \* price) FROM products;` in the database. Compare the totals without applying a category filter. | Report total should match the database total. | Report total matched the database total. | Pass |

| T13 | Check the Top 5 Products report | Open Reports and select Top 5 Products. Check the displayed products and their stock values. | Exactly 5 products should be displayed, ordered from highest to lowest stock value (or fewer if fewer than 5 products exist). | Top 5 products were displayed in descending stock value order. | Pass |

| T14 | Check the Stock Movements report | Open Stock Movements Report. Check the movement summary and movement details. | Recent stock movements should display the correct type, quantity, product and user. | Stock movement details were displayed correctly. | Pass |

| T15 | Check the Print Report button | Open Stock Value Report. Click Print Report. | The browser print window should open. | Browser print window opened successfully. | Pass |

| T16 | Staff tries to open an admin-only page | Login as Staff. Open an admin-only page such as `/users/create`. | Access should be denied with a 403 Forbidden error. | Staff access was denied with a 403 Forbidden error. | Pass |

| T17 | Check products without a category in Stock Value Report | Find a product whose `category\_id` is NULL. Open the Stock Value Report without a category filter. Check whether that product is displayed. | Product should be included in the report, with its category shown as No Category. | Product was included with No Category displayed. | Pass |

| T18 | Upload an invalid product image | Login as Admin. Open Add Product. Upload an invalid file such as a PDF. Submit. | Validation error should be displayed. Product should not be saved with an invalid image. | Validation error was displayed and invalid image was rejected. | Pass |

| T19 | Access Dashboard without login | Logout. Open `/dashboard` directly. | User should be redirected to Login. | User was redirected to the Login page. | Pass |

| T20 | Staff performs Stock In | Login as Staff. Open Stock In. Add 5 units to a product. | Stock should increase by 5. | Stock increased by 5 units. | Pass |



\## Bugs Fixed



1\. Fixed product validation errors.

2\. Fixed stock quantity validation.

3\. Fixed unauthorized staff access.



\## Testing Summary



\- Total Test Cases: 20

\- Passed: 20

\- Failed: 0



\## Testing Method



Manual testing was performed using the browser.

Admin and Staff access permissions were checked.

Product management, stock management, search, pagination and reports were tested.



