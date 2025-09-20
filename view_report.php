<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f4f9;
        }

        a {
            text-decoration: none;
        }
        .sidebar {
            width: 80px; /* Default to collapsed */
            height: 100vh;
            background-color: #F6F5F5; /* Changed to white */
            color: #333;
            position: fixed;
            overflow: hidden;
            box-shadow: 2px 0 5px rgb(54, 57, 88);
            transition: width 0.3s;
        }
        .sidebar.expanded {
            width: 250px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .sidebar ul.show {
            opacity: 1;
        }
        .sidebar ul li {
            padding: 20px;
            text-align: center;
            transition: background-color 0.3s, box-shadow 0.3s;
            opacity: 0;
            transform: translateX(-100%);
            animation: fadeInLeft 0s forwards;
            background-color: white;
            border: 1px solid #7693EE;
            border-radius: 5px;
            margin: 7px 20px;
            color: rgb(0, 0, 0);
        }

        .sidebar ul li:hover {
            cursor: pointer;
            color: white;
            background-color: #175AF4;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .sidebar .logo {
            text-align: center;
            padding: 20px;
            background-color: #F6F5F5; /* Changed to white */
        }
        .sidebar .logo img {
            max-width: 50px; /* Adjust the size as needed */
            height: auto;
            border-radius: 50%;
            border: 2px solid #333;
            padding: 5px;
            background-color: #f0f0f0;
        }
        .content {
            margin-left: 80px; /* Default to collapsed */
            padding: 20px;
            transition: margin-left 0.3s;
            width: 100%;
        }
        .content.expanded {
            margin-left: 250px;
        }
        .toggle-btn {
            position: absolute;
            top: 100px; /* Adjusted to be further below the logo */
            left: 20px; /* Inside the sidebar */
            cursor: pointer;
            transition: transform 0.3s;
            background-color: #F6F5F5;
            color: #175AF4;
            border: none;
            font-size: 24px;
            animation: vibrate 0.3s infinite;
        }
        .toggle-btn.expanded {
            transform: translateX(200px) rotate(180deg); /* Translate and rotate to form a cross */
            animation: none; /* Stop vibration when expanded */
        }
        .toggle-btn:not(.expanded):hover {
            animation: vibrate 0.3s infinite; /* Start vibration when not expanded */
        }
        @keyframes vibrate {
            0% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            50% { transform: translateX(2px); }
            75% { transform: translateX(-2px); }
            100% { transform: translateX(0); }
        }
        .category-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 10px;
            height: 200px;
        }
        .category {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .category h2 {
            margin-top: 0;
            text-align: center;
        }
        .item-container {
            display: flex;
            flex-direction: row;
            gap: 50px;
            margin-top: 20px;
            padding-right: 10px;
        }
        .item {
            background-color: rgb(255, 255, 255);
            color: black;
            border-color: #175AF4;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(25% - 20px);
            box-sizing: border-box;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            margin-left: 180px;
        }
        .item:hover {
            cursor: pointer;
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #175AF4;
            color: white;
        }
        .item h3 {
            margin-top: 0;
        }
        .item p {
            margin-bottom: 0;
        }
        .add-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #175AF4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .add-btn:hover {
            background-color: #0d3ba1;
        }
        .form-container {
            display: flex;
            flex-direction: row;
            gap: 10px;
            margin-top: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            align-items: center;
        }
        .form-container input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        .form-container button {
            padding: 10px;
            background-color: #175AF4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: #0d3ba1;
        }
        .report-container {
            margin-top: 20px;
            position: relative;
        }
        .report-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-container th, .report-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .report-container th {
            background-color: #f2f2f2;
        }
        .watermark {
            position: absolute;
            top: 200%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(360deg);
            font-size: 70px;
            color: rgba(0, 0, 0, 0.1);
            pointer-events: none;
            user-select: none;
            z-index: 0;
        }
        .report-container table {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="path/to/your/logo.png" alt="System Logo">
        </div>
        <hr>
        <button class="toggle-btn" id="toggle-btn">➤</button>
        <ul id="menu-items">
            <a href="admin_dashboard.php"><li>Budget</li></a>
            <li style="color: white; background-color:#175AF4">View Reports</li>
            <br><br>
            <a href="approval.php"><li>Approval</li></a>
            <br>
            <li>Logout</li>
        </ul>
    </div>
    <div class="content" id="content">
        <h1>Admin Dashboard - View Reports</h1>
        <hr>
        <div class="category-container">
            <div class="category">
                <h2>Expense Reports</h2>
                <div class="item-container">
                    <div class="item" data-report="pharmacy">
                        <h3>Pharmacy Counter</h3><div>View Expense Report</div><span></span>
                    </div>
                    <div class="item" data-report="surgical">
                        <h3>Surgical Ward</h3><div>View Expense Report</div><div></div><span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-container" id="date-form">
            <input type="date" id="start-date" placeholder="Start Date">
            <input type="date" id="end-date" placeholder="End Date">
            <button id="search-btn">Search</button>
        </div>
        <div class="report-container" id="report-container">
            <div class="watermark">Expense</div>
            <table id="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Expense Amount</th>
                        <th>Voucher</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("database/dblink.php");
                    $sql = "SELECT * FROM expense";
                    $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_array()) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['i_name'] . "</td>";
                            echo "<td>" . $row['i_amount'] . "</td>";
                            echo "<td>" . $row['i_image'] . "</td>";
                            echo "<td>" . $row['i_date'] . "</td>";
                            echo "</tr>";
                            $i++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggle-btn');
        const menuItems = document.getElementById('menu-items');
        const reportContainer = document.getElementById('report-container');
        const reportTable = document.getElementById('report-table').querySelector('tbody');
        const searchBtn = document.getElementById('search-btn');
        const startDateInput = document.getElementById('start-date');
        const endDateInput = document.getElementById('end-date');

        // Check the sidebar state on page load
        if (localStorage.getItem('sidebarExpanded') === 'true') {
            sidebar.classList.add('expanded');
            content.classList.add('expanded');
            toggleBtn.classList.add('expanded');
            menuItems.classList.add('show');
            toggleBtn.style.animation = 'none';
        }

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('expanded');
            content.classList.toggle('expanded');
            toggleBtn.classList.toggle('expanded');
            if (sidebar.classList.contains('expanded')) {
                menuItems.classList.add('show');
                toggleBtn.style.animation = 'none'; // Stop vibration when expanded
                localStorage.setItem('sidebarExpanded', 'true');
            } else {
                menuItems.classList.remove('show');
                toggleBtn.style.animation = 'vibrate 0.3s infinite'; // Start vibration when not expanded
                localStorage.setItem('sidebarExpanded', 'false');
            }
        });

        document.querySelectorAll('.item').forEach(item => {
            item.addEventListener('click', () => {
                const reportType = item.getAttribute('data-report');
                fetchReport(reportType);
            });
        });

        searchBtn.addEventListener('click', () => {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            if (startDate && endDate) {
                fetchReport('custom', startDate, endDate);
            }
        });

    </script>
</body>
</html>