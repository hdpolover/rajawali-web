-- 1. Roles Table
CREATE TABLE roles (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- 2. Menu Items Table
CREATE TABLE menu_items (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parent_id INT(11) UNSIGNED NULL,
    title VARCHAR(100),
    icon VARCHAR(50) NULL,
    url VARCHAR(255),
    order_position INT(11) DEFAULT 0,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (parent_id) REFERENCES menu_items(id) ON DELETE SET NULL
);

-- 3. Role Menu Items Table
CREATE TABLE role_menu_items (
    role_id INT(11) UNSIGNED,
    menu_item_id INT(11) UNSIGNED,
    created_at DATETIME NULL,
    PRIMARY KEY (role_id, menu_item_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

-- 4. Admins Table
CREATE TABLE admins (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role_id INT(11) UNSIGNED,
    active TINYINT(1) DEFAULT 1,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- 5. Customers Table
CREATE TABLE customers (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    phone_number VARCHAR(20),
    email VARCHAR(100) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- 6. Motorcycles Table
CREATE TABLE motorcycles (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(11) UNSIGNED,
    license_plate VARCHAR(20),
    model VARCHAR(100),
    type VARCHAR(50),
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

-- 7. Spare Parts Table
CREATE TABLE spare_parts (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    photo VARCHAR(255) NULL,
    barcode VARCHAR(50),
    active TINYINT(1) DEFAULT 1,  -- Active/Inactive flag
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- 8. Suppliers Table
CREATE TABLE suppliers (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address VARCHAR(255),
    phone_number VARCHAR(20),
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- 9. Spare Part Stock Table (including price history and stock changes)
CREATE TABLE spare_part_stocks (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    spare_part_id INT(11) UNSIGNED,
    supplier_id INT(11) UNSIGNED,
    purchase_price DECIMAL(10,2),
    sale_price DECIMAL(10,2),
    stock INT(11) DEFAULT 0,
    active TINYINT(1) DEFAULT 1,  -- Active/Inactive flag
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (spare_part_id) REFERENCES spare_parts(id) ON DELETE CASCADE,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE CASCADE
);

-- 10. Stock Logs Table (to track stock and price changes)
CREATE TABLE stock_logs (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    spare_part_stock_id INT(11) UNSIGNED,
    stock_change INT(11),
    price_change DECIMAL(10,2),
    change_reason VARCHAR(255),
    changed_by INT(11) UNSIGNED,  -- Admin ID who made the change
    created_at DATETIME NULL,
    FOREIGN KEY (spare_part_stock_id) REFERENCES spare_part_stocks(id) ON DELETE CASCADE,
    FOREIGN KEY (changed_by) REFERENCES admins(id) ON DELETE CASCADE
);

-- 11. Services Table
CREATE TABLE services (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10,2),
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- 12. Mechanics Table
CREATE TABLE mechanics (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    phone_number VARCHAR(20),
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- 13. Service Transactions Table
CREATE TABLE service_transactions (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    service_id INT(11) UNSIGNED,
    mechanic_id INT(11) UNSIGNED,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (mechanic_id) REFERENCES mechanics(id) ON DELETE CASCADE
);

-- 14. Spare Part Transactions Table
CREATE TABLE spare_part_transactions (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    spare_part_id INT(11) UNSIGNED,
    quantity INT(11),
    sub_total DECIMAL(10,2),
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (spare_part_id) REFERENCES spare_parts(id) ON DELETE CASCADE
);

-- 15. Transactions Table
CREATE TABLE transactions (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaction_number VARCHAR(50),
    service_transaction_id INT(11) UNSIGNED,
    spare_part_transaction_id INT(11) UNSIGNED,
    total DECIMAL(10,2),
    payment DECIMAL(10,2),
    payment_status VARCHAR(50),
    transaction_status VARCHAR(50),
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (service_transaction_id) REFERENCES service_transactions(id) ON DELETE SET NULL,
    FOREIGN KEY (spare_part_transaction_id) REFERENCES spare_part_transactions(id) ON DELETE SET NULL
);

-- 16. Daily Salaries Table (based on completed transactions)
CREATE TABLE daily_salaries (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    mechanic_id INT(11) UNSIGNED,
    salary DECIMAL(10,2),
    transaction_count INT(11),
    salary_date DATE,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    FOREIGN KEY (mechanic_id) REFERENCES mechanics(id) ON DELETE CASCADE
);
