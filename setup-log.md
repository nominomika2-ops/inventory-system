# Setup Log

## Project Setup – 19 November 2026

### Step 1: Clone the Project

**Command:**
bash
git clone https://github.com/nominomika2-ops/inventory-system.git


**Result:** Project cloned successfully into a new practice-project folder.

**Errors:** No errors occurred.

### Step 2: Check Project Files

**Command:**
powershell
Get-ChildItem


**Result:** Project folders and files were listed successfully.

### Step 3: Check Git Branch

**Command:**
bash
git branch


**Result:** The main branch was verified successfully.

**Errors:** No errors occurred.

### Step 4: Create Setup Log

**Command:**`powershell
New-Item setup-log.md -ItemType File

**Result:** The setup-log.md file was created successfully.
### Step 5: Install Composer Dependencies

**Command:**
bash
composer install


**Result:** 112 packages were successfully installed. Laravel package discovery was completed.

**Errors:** No errors occurred.
### Step 8: Run Database Migrations

**Command:**
powershell
php artisan migrate


**Result:** All 16 database migrations were completed successfully. The required database tables were created.

**Errors:** No errors occurred.
### Step 6: Configure Environment

**Commands:**
```powershell
Copy-Item .env.example .env
php artisan key:generate
```

**Result:** The environment file was created and the application key was generated successfully.

### Step 7: Configure Practice Database

**Database:** `inventory_system_practice`

**Command:**
```powershell
php artisan config:clear
```

**Result:** A separate practice database was created and the MySQL configuration was updated successfully.

### Step 9: Seed Database

**Command:**
```powershell
php artisan db:seed
```

**Result:** Category, Supplier, Product and User sample data were inserted successfully.

### Step 10: Verify User Accounts

**Command:**
```powershell
php artisan tinker
```

**Result:** Admin and Staff user accounts were verified in the database.

### Step 11: Test Application

**Command:**
```powershell
php artisan serve
```

**URL:** `http://127.0.0.1:8000`

**Result:** The Laravel application was opened successfully in the browser. Admin login was tested successfully.

### Step 12: Login Troubleshooting

**Issue:** The login page initially displayed "Wrong email or password."

**Checks Performed:**
- Verified the Admin user in the database.
- Verified the password using `Hash::check()`.
- Tested `Auth::validate()`.
- Checked login routes and AuthController.
- Checked session configuration and database session table.

**Result:** Login was tested again and successfully completed.

**Errors:** The initial login issue was investigated and resolved. The exact cause was not confirmed.
## Project Modules

| Module | What it does | Main files |
|---|---|---|
| Authentication | Handles user login and logout. | AuthController.php, User.php, auth/ |
| Dashboard | Displays inventory summary information. | DashboardController.php, dashboard view |
| Products | Manages product details and product information. | ProductController.php, Product.php, products/ |
| Categories | Manages product categories. | CategoryController.php, Category.php, categories/ |
| Suppliers | Manages supplier information. | SuppliersController.php, Supplier.php, suppliers/ |
| Users | Manages system user accounts and roles. | UserController.php, User.php, users/ |
| Stock Management | Handles stock movements and stock updates. | StockController.php, StockMovement.php, stock/ |
| Reports | Generates inventory reports. | ReportController.php, reports/ |
| Profile | Displays and manages user profile information. | ProfileController.php, User.php, profile/ |
## Git Workflow – 6 Steps

1. **Create a Feature Branch:** A separate branch is created from the main branch for each new feature.

2. **Make Changes:** Required code changes are implemented and tested locally.

3. **Commit Changes:** Changes are committed with clear messages such as `Add product CRUD` or `Complete category CRUD`.

4. **Push Branch:** The feature branch is pushed to the remote GitHub repository.

5. **Create Pull Request:** A Pull Request is opened to request merging the feature branch into main.

6. **Review and Merge:** The Pull Request is reviewed and approved before it is merged into main.

**Additional Notes:**
- Branch example found: `week8-final`.
- Commit message style: `Add ...`, `Complete ...`.
- A merged Pull Request was found in Git history: PR #1.
- The specific reviewer and person responsible for merging were not identified in README.md or the inspected Git history. These details should be confirmed with the team lead.