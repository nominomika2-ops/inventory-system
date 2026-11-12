\# Inventory System - Test Cases



| ID | Test | Steps | Expected result | Actual result | Pass/Fail |

|---|---|---|---|---|---|

| T1 | Login with the right email and password | Open `/login`. Enter the correct email and password. Click Login. | User should be logged in and redirected to the Dashboard. | | |

| T2 | Login with a wrong password | Open `/login`. Enter a valid email and an incorrect password. Click Login. | Login should be rejected and an error message should be displayed. | | |

| T3 | Open `/products` when logged out | Logout. Enter `/products` in the browser. | User should be redirected to the Login page. | | |

| T4 | Staff opens `/products/create` | Login as Staff. Open `/products/create`. | Access should be denied with a 403 Forbidden error. | | |

| T5 | Admin adds a product with correct data | Login as Admin. Open Add Product. Enter valid product name, category, price and stock. Submit. | Product should be saved successfully and displayed in the Products list. | | |

| T6 | Admin adds a product with an empty name | Login as Admin. Open Add Product. Leave the product name empty and submit. | Validation error should be displayed. Product should not be saved. | | |

| T7 | Search for a product by name | Open Products. Enter an existing product name in the search box. Submit the search. | Only matching products should be displayed. | | |

| T8 | Filter products by category, then go to page 2 | Open Products. Select a category containing more than 10 products. Apply the filter. Click page 2. | Page 2 should display products from the selected category. | | |

| T9 | Stock out more than the stock available | Open a product with limited stock. Try to stock out a quantity greater than its available stock. | Stock out should be rejected. Stock should not become negative. | | |

| T10 | Stock in 10 and check the new stock | Open a product. Record its current stock. Stock in 10 units. Check the updated stock. | Product stock should increase by 10. | | |

| T11 | Delete a category that has products | Login as Admin. Open Categories. Try to delete a category that contains products. | Deletion should be blocked and the category should remain. | | |

| T12 | The total on the stock value report matches the database | Open Stock Value Report. Note the total. Run `SELECT SUM(stock \* price) FROM products;` in the database. Compare the totals without applying a category filter. | Report total should match the database total. | | |

| T13 | Check the Top 5 Products report | Open Reports and select Top 5 Products. Check the displayed products and their stock values. | Exactly 5 products should be displayed, ordered from highest to lowest stock value (or fewer if fewer than 5 products exist). | | |

| T14 | Check the Stock Movements report | Open Stock Movements Report. Check the movement summary and movement details. | Recent stock movements should display the correct type, quantity, product and user. | | |

| T15 | Check the Print Report button | Open Stock Value Report. Click Print Report. | The browser print window should open. | | |

| T16 | Staff tries to open an admin-only page | Login as Staff. Open an admin-only page such as `/users/create`. | Access should be denied with a 403 Forbidden error. | | |

| T17 | Check products without a category in Stock Value Report | Find a product whose `category\_id` is NULL. Open the Stock Value Report without a category filter. Check whether that product is displayed. | Product should be included in the report, with its category shown as No Category. | | |





