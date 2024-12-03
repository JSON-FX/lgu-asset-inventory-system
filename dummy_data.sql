-- Insert dummy data into categories table
INSERT INTO categories (category_name, created_at, updated_at) VALUES
('Electronics', NOW(), NOW()),
('Furniture', NOW(), NOW()),
('Vehicles', NOW(), NOW()),
('Stationery', NOW(), NOW());

-- Insert dummy data into offices table
INSERT INTO offices (office_name, created_at, updated_at) VALUES
('Head Office', NOW(), NOW()),
('Branch Office 1', NOW(), NOW()),
('Branch Office 2', NOW(), NOW());

-- Insert dummy data into statuses table
INSERT INTO statuses (status_name, created_at, updated_at) VALUES
('Operational', NOW(), NOW()),
('Maintenance', NOW(), NOW()),
('Decommissioned', NOW(), NOW());

-- Insert dummy data into employees table
INSERT INTO employees (employee_name, created_at, updated_at) VALUES
('John Doe', NOW(), NOW()),
('Jane Smith', NOW(), NOW()),
('Mark Johnson', NOW(), NOW()),
('Emily Davis', NOW(), NOW());

-- Insert dummy data into properties table
-- Insert dummy data into properties table
INSERT INTO properties (
    property_number, 
    description, 
    serial_number, 
    office_id, 
    category_id, 
    status_id, 
    employee_id, 
    date_purchase, 
    acquisition_cost, 
    inventory_remarks, 
    created_at, 
    updated_at
) VALUES
('PN-001', 'Dell Laptop', 'SN-12345', 1, 1, 1, 1, '2024-01-01', 50000.00, 'For IT department use', NOW(), NOW()),
('PN-002', 'Office Chair', NULL, 2, 2, 1, 2, '2023-12-01', 3000.00, 'Ergonomic chair', NOW(), NOW()),
('PN-003', 'Toyota Corolla', 'SN-56789', 3, 3, 2, 3, '2022-06-15', 800000.00, 'Company car for sales', NOW(), NOW()),
('PN-004', 'Printer', 'SN-11223', 1, 1, 2, 4, '2023-03-10', 10000.00, 'Shared printer for office use', NOW(), NOW()),
('PN-005', 'MacBook Pro', 'SN-23456', 1, 1, 1, 1, '2024-05-20', 120000.00, 'Assigned to CEO', NOW(), NOW()),
('PN-006', 'Conference Table', NULL, 2, 2, 1, 3, '2023-07-15', 25000.00, 'Meeting room table', NOW(), NOW()),
('PN-007', 'HP Desktop', 'SN-34567', 1, 1, 1, 4, '2022-11-10', 40000.00, 'Reception desk computer', NOW(), NOW()),
('PN-008', 'Filing Cabinet', NULL, 3, 2, 1, 2, '2024-03-05', 7000.00, 'Used in HR office', NOW(), NOW()),
('PN-009', 'Ford Ranger', 'SN-67890', 3, 3, 2, 1, '2023-09-10', 950000.00, 'Field operations vehicle', NOW(), NOW()),
('PN-010', 'CCTV System', 'SN-78901', 1, 1, 2, 3, '2023-08-20', 60000.00, 'Security surveillance system', NOW(), NOW()),
('PN-011', 'Air Conditioner', 'SN-89012', 2, 2, 1, 4, '2024-02-01', 30000.00, 'Installed in main office', NOW(), NOW()),
('PN-012', 'Canon Camera', 'SN-90123', 1, 1, 1, 2, '2023-04-10', 25000.00, 'For marketing team use', NOW(), NOW()),
('PN-013', 'Projector', 'SN-34512', 2, 1, 1, 1, '2022-10-12', 50000.00, 'For presentations', NOW(), NOW()),
('PN-014', 'Electric Fan', NULL, 3, 2, 1, 4, '2023-05-30', 1500.00, 'Utility fan for backup office', NOW(), NOW()),
('PN-015', 'iPad Pro', 'SN-41235', 1, 1, 1, 3, '2023-01-25', 80000.00, 'For design team', NOW(), NOW()),
('PN-016', 'Desktop PC', 'SN-56234', 2, 1, 1, 1, '2023-06-15', 45000.00, 'Workstation for accounting', NOW(), NOW()),
('PN-017', 'Standing Desk', NULL, 3, 2, 1, 2, '2024-04-22', 20000.00, 'Health-focused office desk', NOW(), NOW()),
('PN-018', 'Motorcycle', 'SN-23451', 3, 3, 2, 1, '2023-02-18', 150000.00, 'Used by messenger', NOW(), NOW()),
('PN-019', 'Kitchen Refrigerator', 'SN-78654', 1, 2, 1, 4, '2023-09-05', 18000.00, 'Pantry equipment', NOW(), NOW()),
('PN-020', 'Wi-Fi Router', 'SN-90342', 1, 1, 1, 1, '2024-03-18', 5000.00, 'Main office router', NOW(), NOW());
-- Insert a user into the users table
-- password psmd2024
INSERT INTO users (name, email, password, created_at, updated_at)
VALUES 
('PSMD', 'admin@admin.com', '$2y$12$uCdmALnrJb9awWOcL4mgAe5MUdsYkK2KBek.5St2sjHH4yv7/0.fu', NOW(), NOW());
