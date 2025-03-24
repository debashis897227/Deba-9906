CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    mobile_number VARCHAR(20) UNIQUE,
    address TEXT,
    pincode VARCHAR(10),
    dob DATE,
    gender ENUM('Male', 'Female', 'Other'),
    is_active BOOLEAN DEFAULT TRUE,
    role ENUM('Admin', 'Doctor', 'Patient')
);


CREATE TABLE patients (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE,
    disease VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE doctors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE,
    qualification VARCHAR(255),
    availability VARCHAR(255),
    visit_fee DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE appointments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT,
    doctor_id INT,
    schedule DATETIME,
    status ENUM('Scheduled', 'Completed', 'Cancelled'),
    payment_method VARCHAR(50),
    payment_status ENUM('Pending', 'Completed', 'Failed'),
    visit_fee DECIMAL(10,2),
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    brand VARCHAR(255),
    type VARCHAR(100),
    description TEXT,
    stock_available INT,
    area_available TEXT,
    original_price DECIMAL(10,2),
    selling_price DECIMAL(10,2)
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT,
    product_id INT,
    status ENUM('Pending', 'Shipped', 'Delivered', 'Cancelled'),
    payment_method VARCHAR(50),
    payment_status ENUM('Pending', 'Completed', 'Failed'),
    price DECIMAL(10,2),
    shipping_address TEXT,
    expected_delivery_date DATE,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Insert sample users
INSERT INTO users (name, email, password, mobile_number, address, pincode, dob, gender, is_active, role) 
VALUES 
('John Doe', 'john@example.com', 'hashed_password', '1234567890', '123 Street, NY', '10001', '1990-05-15', 'Male', TRUE, 'Patient'),
('Jane Smith', 'jane@example.com', 'hashed_password', '0987654321', '456 Avenue, LA', '90001', '1995-10-22', 'Female', TRUE, 'Doctor'),
('Admin User', 'admin@example.com', 'hashed_password', '1112223333', '789 Blvd, TX', '75001', '1985-07-10', 'Male', TRUE, 'Admin');

-- Insert into patients (only for users with role 'Patient')
INSERT INTO patients (user_id, disease) 
VALUES 
((SELECT id FROM users WHERE email = 'john@example.com'), 'Hypertension');

-- Insert into doctors (only for users with role 'Doctor')
INSERT INTO doctors (user_id, qualification, availability, visit_fee) 
VALUES 
((SELECT id FROM users WHERE email = 'jane@example.com'), 'MBBS, MD', 'Mon-Fri 9 AM - 5 PM', 500.00);

-- Insert appointments
INSERT INTO appointments (patient_id, doctor_id, schedule, status, payment_method, payment_status, visit_fee) 
VALUES 
((SELECT id FROM patients WHERE user_id = (SELECT id FROM users WHERE email = 'john@example.com')),
 (SELECT id FROM doctors WHERE user_id = (SELECT id FROM users WHERE email = 'jane@example.com')),
 '2025-03-15 10:00:00', 'Scheduled', 'Credit Card', 'Pending', 500.00);

-- Insert products
INSERT INTO products (name, brand, type, description, stock_available, area_available, original_price, selling_price) 
VALUES 
('Pain Reliever', 'MediPharm', 'Medicine', 'Effective pain relief', 100, 'Pharmacy Section', 50.00, 45.00),
('Cough Syrup', 'HerbalCare', 'Medicine', 'Soothes cough and sore throat', 80, 'Pharmacy Section', 30.00, 28.00);

-- Insert orders
INSERT INTO orders (patient_id, product_id, status, payment_method, payment_status, price, shipping_address, expected_delivery_date) 
VALUES 
((SELECT id FROM patients WHERE user_id = (SELECT id FROM users WHERE email = 'john@example.com')),
 (SELECT id FROM products WHERE name = 'Pain Reliever'),
 'Pending', 'Cash on Delivery', 'Pending', 45.00, '123 Street, NY', '2025-03-20');
