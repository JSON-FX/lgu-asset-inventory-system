INSERT INTO properties (
    property_number,
    description,
    serial_number,
    office,
    date_purchase,
    accountable_person,
    acquisition_cost,
    status,
    inventory_remarks
) VALUES
    ('PROP-001', 'Laptop Dell XPS 13', 'SN123456789', 'Office A', '2023-01-15', 'John Doe', 1500.00, 'Active', 'No remarks'),
    ('PROP-002', 'Office Chair Ergonomic', 'SN987654321', 'Office B', '2022-08-22', 'Jane Smith', 250.00, 'Inactive', 'Broken armrest'),
    ('PROP-003', 'Projector Epson 3000', 'SN112233445', 'Conference Room', '2021-10-05', 'Alice Brown', 1200.00, 'Active', 'Works fine'),
    ('PROP-004', 'Desktop PC HP', 'SN223344556', 'Office A', '2023-06-10', 'Bob White', 900.00, 'Active', 'Pending software upgrade'),
    ('PROP-005', 'Mobile Phone Samsung Galaxy', 'SN334455667', 'Office C', '2022-11-13', 'Charlie Green', 800.00, 'Active', 'No remarks');
