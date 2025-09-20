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

        }
        .sidebar.expanded {
            width: 250px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            opacity: 0;
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
        .approval-container {
            margin-top: 20px;
        }
        .approval-table {
            width: 100%;
            border-collapse: collapse;
        }
        .approval-table th, .approval-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .approval-table th {
            background-color: #f2f2f2;
        }
        .approve-btn, .decline-btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .approve-btn {
            background-color: #175AF4;
        }
        .approve-btn:hover {
            background-color: #0d3ba1;
        }
        .decline-btn {
            background-color: #d9534f;
        }
        .decline-btn:hover {
            background-color: #c9302c;
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
            <a href="view_report.php"><li>View Reports</li></a>
            <br><br>
            <li style="color: white; background-color:#175AF4">Approval</li>
            <br>
            <li>Logout</li>
        </ul>
    </div>
    <div class="content" id="content">
        <h1>Admin Dashboard - Account Changes Approval</h1>
        <hr>
        <div class="approval-container">
            <center><h2>User Password Change Approvals</h2></center>
            <table class="approval-table">
                <thead>
                    <tr>
                        <th>User Email</th>
                        <th>User Name</th>
                        <th>User Phone Number</th>
                        <th>Date of Request</th>
                        <th>Approval</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Approval rows will be appended here -->
                    <tr>
                        <td>user1@example.com</td>
                        <td>John Doe</td>
                        <td>123-456-7890</td>
                        <td>2025-02-20</td>
                        <td>
                            <button class="approve-btn">Approve</button>
                            <button class="decline-btn">Decline</button>
                        </td>
                    </tr>
                    <tr>
                        <td>user2@example.com</td>
                        <td>Jane Smith</td>
                        <td>098-765-4321</td>
                        <td>2025-02-21</td>
                        <td>
                            <button class="approve-btn">Approve</button>
                            <button class="decline-btn">Decline</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggle-btn');
        const menuItems = document.getElementById('menu-items');

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
    </script>
</body>
</html>