INSERT INTO properties (
    property_number, description, serial_number, engine_number, elc_number, office, date_purchase, accountable_person, acquisition_cost, user, status, inventory_remarks, created_at, updated_at
) VALUES
('PROP001', 'Office Chair', 'SN12345', NULL, 'ELC001', 'Main Office', '2023-01-01', 'John Doe', 1200.50, 'Jane Smith', 'In Use', 'In good condition', NOW(), NOW()),
('PROP002', 'Laptop', 'SN54321', NULL, 'ELC002', 'IT Department', '2022-12-15', 'Alice Brown', 45000.75, 'Bob White', 'Assigned', 'Needs maintenance', NOW(), NOW()),
('PROP003', 'Printer', 'SN67890', NULL, 'ELC003', 'HR Department', '2021-06-10', 'Charlie Green', 3000.00, 'Diana Black', 'In Use', 'Working perfectly', NOW(), NOW()),
('PROP004', 'Desk', 'SN98765', NULL, NULL, 'Main Office', '2023-03-05', 'Emily White', 2500.00, 'Frank Brown', 'In Use', 'Slightly scratched', NOW(), NOW()),
('PROP005', 'Monitor', 'SN11223', NULL, 'ELC004', 'IT Department', '2023-05-22', 'George Smith', 5000.00, 'Hannah Grey', 'Assigned', 'In good condition', NOW(), NOW()),
('PROP006', 'Projector', 'SN44556', NULL, 'ELC005', 'Meeting Room', '2020-11-15', 'Isla Blue', 12000.00, 'Jack Black', 'In Use', 'Needs cleaning', NOW(), NOW()),
('PROP007', 'Server', 'SN77889', NULL, 'ELC006', 'Server Room', '2019-08-10', 'Kevin Pink', 80000.00, 'Laura Green', 'In Use', 'Under maintenance', NOW(), NOW()),
('PROP008', 'Air Conditioner', 'SN99001', NULL, NULL, 'Main Office', '2022-09-25', 'Mia Brown', 15000.00, 'Nathan Black', 'In Use', 'Cooling efficiently', NOW(), NOW()),
('PROP009', 'Cabinet', 'SN22334', NULL, NULL, 'Storage Room', '2021-12-20', 'Olivia Grey', 3000.00, 'Paul White', 'In Use', 'No issues', NOW(), NOW()),
('PROP010', 'Router', 'SN55677', NULL, 'ELC007', 'IT Department', '2023-04-18', 'Quincy Blue', 7000.00, 'Rita Pink', 'Assigned', 'In good condition', NOW(), NOW());
INSERT INTO categories (category_name, created_at, updated_at) VALUES
('Furniture', NOW(), NOW()),
('Electronics', NOW(), NOW()),
('Appliances', NOW(), NOW()),
('Office Supplies', NOW(), NOW());
INSERT INTO offices (office_name, created_at, updated_at) VALUES
('Main Office', NOW(), NOW()),
('IT Department', NOW(), NOW()),
('HR Department', NOW(), NOW()),
('Meeting Room', NOW(), NOW()),
('Storage Room', NOW(), NOW());
INSERT INTO statuses (status_name, created_at, updated_at) VALUES
('In Use', NOW(), NOW()),
('Assigned', NOW(), NOW()),
('Needs Repair', NOW(), NOW());
INSERT INTO employees (employee_name, created_at, updated_at) VALUES
('John Cena', NOW(), NOW()),
('Jane Tomboy', NOW(), NOW()),
('Alice Gou', NOW(), NOW()),
('Bob Mars', NOW(), NOW()),
('Charlie Putin', NOW(), NOW());
