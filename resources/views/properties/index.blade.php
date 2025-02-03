<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-scale=1.0">
    <title>Generate Report</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        label {
            margin-right: 10px;
        }

        #pagination {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .selected {
            background-color: #f0f8ff;
        }
        /* Dropdown button style */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .dropdown-button:hover {
            background-color: #45a049;
        }

        /* Dropdown content (the checkbox list) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            padding: 10px 0;
        }

        .dropdown-content label {
            display: block;
            padding: 8px 15px;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown-content label:hover {
            background-color: #ddd;
        }

        /* Show the dropdown content when hovering over the button */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Add styles for checkboxes */
        .toggle-column {
            margin-right: 10px;
        }

    </style>
</head>
<body>
    <a href="{{ route('assetlist.index') }}" class="btn btn-primary btn-sm mt-auto">Back to Home</a>
    
    <h2>Select Rows to Copy, Export & Toggle Columns</h2>

    <!-- Column visibility toggle -->
    <!-- Buttons for Print, Copy & Export -->
    <div id="pagination">
        <button id="prevPage" onclick="changePage('prev')">Prev</button>
        <span id="pageNum">Page 1</span>
        <button id="nextPage" onclick="changePage('next')">Next</button>

        <label for="rowsPerPage">Rows per page:</label>
        <select id="rowsPerPage" onchange="changeRowsPerPage()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="100000">all</option>
        </select>
    </div>
    <button id="printButton">Print</button>
    <button id="copyButton">Copy Selected Rows for Excel</button>
    <button id="exportButton">Export Selected Rows to Excel</button>

    <!-- Pagination and rows per page -->
    
    <div class="dropdown">
        <button class="dropdown-button">Filter</button>
        <div class="dropdown-content">
            <label><input type="checkbox" class="toggle-column" data-column="0" checked> Select</label>
            <label><input type="checkbox" class="toggle-column" data-column="1" checked> Property Number</label>
            <label><input type="checkbox" class="toggle-column" data-column="2" checked> Description</label>
            <label><input type="checkbox" class="toggle-column" data-column="3" checked> Office</label>
            <label><input type="checkbox" class="toggle-column" data-column="4" checked> Category</label>
            <label><input type="checkbox" class="toggle-column" data-column="5" checked> Status</label>
            <label><input type="checkbox" class="toggle-column" data-column="6" checked> Account</label>
            <label><input type="checkbox" class="toggle-column" data-column="7" checked> End User</label>
            <label><input type="checkbox" class="toggle-column" data-column="8" checked> Accountable</label>
            <label><input type="checkbox" class="toggle-column" data-column="9" checked> Serial Number</label>
            <label><input type="checkbox" class="toggle-column" data-column="10" checked> ELC Number</label>
            <label><input type="checkbox" class="toggle-column" data-column="11" checked> Engine Number</label>
            <label><input type="checkbox" class="toggle-column" data-column="12" checked> Chasis Number</label>
            <label><input type="checkbox" class="toggle-column" data-column="13" checked> Plate Number</label>
            <label><input type="checkbox" class="toggle-column" data-column="14" checked> Quantity</label>
            <label><input type="checkbox" class="toggle-column" data-column="15" checked> Acquisition Cost</label>
            <label><input type="checkbox" class="toggle-column" data-column="16" checked> Inventory Remarks</label>
        </div>
    </div>
    
    
    <!-- Column search inputs -->
    <div>
        <h3>Search Columns</h3>
        <label>Property Number: <input type="text" id="searchPropertyNumber" onkeyup="searchTable(1, this.value)"></label>
        <label>Description: <input type="text" id="searchDescription" onkeyup="searchTable(2, this.value)"></label>
        <label>Office: <input type="text" id="searchOffice" onkeyup="searchTable(3, this.value)"></label>
        <label>Category: <input type="text" id="searchCategory" onkeyup="searchTable(4, this.value)"></label>
        <label>Status: <input type="text" id="searchStatus" onkeyup="searchTable(5, this.value)"></label>
    </div>

    <div class="table-container">
        <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th data-field="property_number" data-sortable="true" data-filter-control="input">Property Number</th>
                    <th data-field="description" data-sortable="true" data-filter-control="input">Description</th>
                    <th data-field="office" data-sortable="true" data-filter-control="input">Office</th>
                    <th data-field="category" data-sortable="true" data-filter-control="input">Category</th>
                    <th data-field="status" data-sortable="true" data-filter-control="input">Status</th>
                    <th data-field="account" data-sortable="true" data-filter-control="input">Account</th>
                    <th data-field="employee" data-sortable="true" data-filter-control="input">End User</th>
                    <th data-field="employee2" data-sortable="true" data-filter-control="input">Accountable</th>
                    <th data-field="serial_number" data-sortable="true" data-filter-control="input">Serial Number</th>
                    <th data-field="elc_number" data-sortable="true" data-filter-control="input">ELC Number</th>
                    <th data-field="engine_number" data-sortable="true" data-filter-control="input">Engine Number</th>
                    <th data-field="chasis_number" data-sortable="true" data-filter-control="input">Chasis Number</th>
                    <th data-field="plate_number" data-sortable="true" data-filter-control="input">Plate Number</th>
                    <th data-field="qty" data-sortable="true" data-filter-control="input">Quantity</th>
                    <th data-field="acquisition_cost" data-sortable="true" data-filter-control="input">Acquisition Cost</th>
                    <th data-field="inventory_remarks" data-sortable="true" data-filter-control="input">Inventory Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td><input type="checkbox" class="row-select" data-id="{{ $property->id }}"></td>
                        <td>{{ $property->property_number }}</td>
                        <td>{{ $property->description }}</td>
                        <td>{{ $property->office->office_name }}</td>
                        <td>{{ $property->category->category_name }}</td>
                        <td>{{ $property->status->status_name }}</td>
                        <td>{{ $property->account->account_name }}</td>
                        <td>{{ $property->employee->employee_name }}</td>
                        <td>{{ $property->employee2->employee_name }}</td>
                        <td>{{ $property->serial_number}}</td>
                        <td>{{ $property->elc_number}}</td>
                        <td>{{ $property->engine_number}}</td>
                        <td>{{ $property->chasis_number}}</td>
                        <td>{{ $property->plate_number}}</td>
                        <td>{{ number_format($property->qty, 0) }}</td>
                        <td>{{ number_format($property->acquisition_cost, 2) }}</td>
                        <td>{{ $property->inventory_remarks}}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 
    

    <script>
        // JavaScript functions for handling table logic
    let currentPage = 1;
    let rowsPerPage = 10;

    const table = document.getElementById('dataTable');
    const rows = table.querySelectorAll('tbody tr');
    const totalRows = rows.length;
    let pageCount = Math.ceil(totalRows / rowsPerPage);
    


    // Function to display only the rows for the current page
    function paginate() {
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        rows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Update the page number display
        document.getElementById('pageNum').textContent = `Page ${currentPage} of ${pageCount}`;
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = currentPage === pageCount;
    }

    // Function to handle page change (Next/Previous)
    function changePage(direction) {
        if (direction === 'next' && currentPage < pageCount) {
            currentPage++;
        } else if (direction === 'prev' && currentPage > 1) {
            currentPage--;
        }
        paginate();
    }

    // Function to handle rows per page change
    function changeRowsPerPage() {
        rowsPerPage = parseInt(document.getElementById('rowsPerPage').value);
        pageCount = Math.ceil(totalRows / rowsPerPage);
        currentPage = 1; // Reset to page 1 after changing rows per page
        paginate();
    }

    // Function for column search
    function searchTable(columnIndex, searchValue) {
        searchValue = searchValue.toLowerCase();
        rows.forEach(row => {
            const cell = row.cells[columnIndex];
            if (cell) {
                const cellText = cell.textContent || cell.innerText;
                if (cellText.toLowerCase().includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }
    const headers = table.querySelectorAll('th');
    headers.forEach((header, index) => {
        header.addEventListener('click', function() {
            sortTable(index);
        });
    });
    document.getElementById('selectAll').addEventListener('change', function() {
        const checked = this.checked;
        document.querySelectorAll('.row-select').forEach(checkbox => {
            checkbox.checked = checked;
            const row = checkbox.closest('tr');
            if (checked) {
                row.classList.add('selected');
            } else {
                row.classList.remove('selected');
            }
        });
    });
    


    function sortTable(columnIndex) {
        const rowsArray = Array.from(rows);
        const isNumeric = !isNaN(rowsArray[0].cells[columnIndex].innerText.trim());
        rowsArray.sort((a, b) => {
            const aText = a.cells[columnIndex].innerText.trim();
            const bText = b.cells[columnIndex].innerText.trim();
            return isNumeric ? aText - bText : aText.localeCompare(bText);
        });

        rowsArray.forEach(row => table.appendChild(row)); // Reorder rows
    }


    // Column visibility toggle
    const columnToggleCheckboxes = document.querySelectorAll('.toggle-column');
    columnToggleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const columnIndex = parseInt(this.getAttribute('data-column'));
            toggleColumnVisibility(columnIndex, this.checked);
        });
    });

    function toggleColumnVisibility(columnIndex, isVisible) {
        const rows = table.rows;

        for (let i = 0; i < rows.length; i++) {
            const cell = rows[i].cells[columnIndex];
            if (cell) {
                cell.style.display = isVisible ? '' : 'none';
            }
        }
    }

    // Copy to clipboard - now respects hidden columns
    document.getElementById('copyButton').addEventListener('click', function() {
        const selectedRows = [];
        const selectedCheckboxes = document.querySelectorAll('.row-select:checked');
        
        selectedCheckboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const rowData = [];

            Array.from(row.cells).forEach((cell, columnIndex) => {
                // Check if the column is visible (not hidden)
                const columnVisible = table.querySelector(`thead th:nth-child(${columnIndex + 1})`).style.display !== 'none';
                if (columnVisible) {
                    rowData.push(cell.innerText);
                }
            });
            
            selectedRows.push(rowData.join('\t')); // Use tabs for Excel format
        });

        if (selectedRows.length > 0) {
            const textToCopy = selectedRows.join('\n'); // Join rows with newlines
            copyToClipboard(textToCopy);
        } else {
            alert('No rows selected!');
        }
    });

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Selected rows copied to clipboard!');
        }).catch(err => {
            console.error('Error copying text: ', err);
            alert('Failed to copy to clipboard!');
        });
    }

    // Export to Excel
    document.getElementById('exportButton').addEventListener('click', function() {
        const selectedRows = [];
        const selectedCheckboxes = document.querySelectorAll('.row-select:checked');
        
        selectedCheckboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const rowData = [];

            Array.from(row.cells).forEach((cell, columnIndex) => {
                // Check if the column is visible (not hidden)
                const columnVisible = table.querySelector(`thead th:nth-child(${columnIndex + 1})`).style.display !== 'none';
                if (columnVisible) {
                    rowData.push(cell.innerText);
                }
            });

            selectedRows.push(rowData);
        });

        if (selectedRows.length > 0) {
            exportToExcel(selectedRows);
        } else {
            alert('No rows selected!');
        }
    });

    function exportToExcel(data) {
        const ws = XLSX.utils.aoa_to_sheet([['', 'Property Number', 'Description', 'Office', 'Category', 'Status', 'Account', 'End User', 'Accountable', 'Serial Number', 'ELC Number', 'Engine Number', 'Chasis Number', 'Plate Number', 'Quantity', 'Acquisition Cost', 'Inventory Remarks'], ...data]);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        XLSX.writeFile(wb, 'selected_rows.xlsx');
    }
    const rowSelectCheckboxes = document.querySelectorAll('.row-select');
    rowSelectCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const row = checkbox.closest('tr');
            if (checkbox.checked) {
                row.classList.add('selected');
            } else {
                row.classList.remove('selected');
            }
        });
        

    });
    document.getElementById('printButton').addEventListener('click', function() {
        const selectedRows = [];
        const selectedCheckboxes = document.querySelectorAll('.row-select:checked');
        
        selectedCheckboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const rowData = [];

            // Collect data for each selected row
            Array.from(row.cells).forEach((cell, columnIndex) => {
                // Check if the column is visible (not hidden)
                const columnVisible = table.querySelector(`thead th:nth-child(${columnIndex + 1})`).style.display !== 'none';
                if (columnVisible) {
                    rowData.push(cell.innerText);
                }
            });
            
            selectedRows.push(rowData); // Push the row data to the selectedRows array
        });

        // If there are selected rows, create print layout for each row
        if (selectedRows.length > 0) {
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print Selected Rows</title>');

            // Add custom styles for printing
            printWindow.document.write('<style>');
            printWindow.document.write(`
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                    padding: 0;
                }
                .header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 5px;
                }
                .logo {
                    width: 0.75in; /* Adjusted to fit within the card */
                    height: auto;
                }
                .municipal-text {
                    font-size: 14px; /* Adjusted to fit within the card */
                    font-weight: bold;
                    text-align: center;
                }
                .qr-code {
                    width: 0.5in; /* Adjusted size for the QR code */
                    height: 0.5in; /* Adjusted size for the QR code */
                }
                .content-block {
                    width: 2.5in;  /* Set width of card */
                    height: 1.5in; /* Set height of card */
                    border: 1px solid #000; /* Border for the card */
                    padding: 5px;
                    margin-bottom: 10px;
                    float: left;
                    margin-right: 10px;
                    page-break-inside: avoid;
                    /* Ensure no breaks inside individual card */
                }
                .description {
                    margin-top: 5px;
                    font-size: 10px; /* Smaller font size for description */
                    text-align: center;
                }
                .page {
                    page-break-before: always;
                }
                .page:last-child {
                    page-break-before: auto;
                }
                .row-container {
                    display: flex;
                    flex-wrap: wrap;
                    margin-bottom: 20px;
                }
            `);
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');

            let rowsPerPage = 5; // Maximum number of rows per page (depends on available space)
            let rowCount = 0;

            selectedRows.forEach((rowData, index) => {
                // Create a new page if the current page is full
                if (rowCount === rowsPerPage) {
                    printWindow.document.write('<div class="page"></div>');
                    rowCount = 0;
                }

                // Create a content block (card) for each row
                if (rowCount === 0) {
                    printWindow.document.write('<div class="row-container">');
                }

                const logoHTML = '<img src="assets/images/municipal-logo.png" class="logo" />'; // Replace with your logo URL
                const municipalText = '<div class="municipal-text">Municipal Center</div>';
                const qrImage = '<img src="your-static-qr-code.png" class="qr-code" />'; // Replace with your static QR code image
                const descriptionHTML = `<div class="description">Description: Name ${index + 1}</div>`; // Description with row index

                // Create a content block (card) for each row
                printWindow.document.write('<div class="content-block">');
                
                // Header with logo, text, and QR code
                printWindow.document.write('<div class="header">');
                printWindow.document.write('<div class="logo">' + logoHTML + '</div>');
                printWindow.document.write('<div class="municipal-text">' + municipalText + '</div>');
                printWindow.document.write('<div class="qr-code">' + qrImage + '</div>');
                printWindow.document.write('</div>'); // End header div
                
                // Insert the row data as a table (one row per block)
                printWindow.document.write('<table><tr>');
                rowData.forEach(cellData => {
                    printWindow.document.write(`<td>${cellData}</td>`);
                });
                printWindow.document.write('</tr></table>');
                
                // Insert description below the table
                printWindow.document.write(descriptionHTML);

                printWindow.document.write('</div>'); // End content-block div

                // After every row, increase the counter
                rowCount++;

                // Close the row-container after the page is full
                if (rowCount === rowsPerPage) {
                    printWindow.document.write('</div>'); // End row-container div
                }
            });

            // Close the last row-container
            if (rowCount < rowsPerPage) {
                printWindow.document.write('</div>'); // End row-container div
            }

            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Trigger print dialog
            printWindow.print();
        } else {
            alert('No rows selected!');
        }
    });
    







    // Initialize table pagination
    paginate();

    </script>
</body>
</html>
