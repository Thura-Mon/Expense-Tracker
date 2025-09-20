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
            /* transition: width 0.3s; */
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
            animation: fadeInLeft forwards;
            background-color: white;
            border: 1px solid rgb(106, 151, 255);
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
            /* transition: transform 0.3s; */
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
            width: calc(50% - 50px);
            box-sizing: border-box;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .category h2 {
            margin-top: 0;
            text-align: center;
        }
        .item-container {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            gap: 10px;
            max-height: 200px;
            overflow-y: auto;
            padding-right: 10px;
        }
        .item-container::-webkit-scrollbar {
            width: 8px;
        }
        .item-container::-webkit-scrollbar-thumb {
            background-color: #175AF4;
            border-radius: 10px;
        }
        .item-container::-webkit-scrollbar-track {
            background-color: #f4f4f9;
        }
        .item {
            background-color: rgb(255, 255, 255);
            color: black;
            border-color: #175AF4;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(100% - 40px);
            box-sizing: border-box;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
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
        .form-container {
            display: none;
            flex-direction: column;
            gap: 10px;
            margin-top: 125px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        .form-container .clear-form-btn {
            background-color: grey;
            margin-top: 10px;
            width: 100%;
        }
        .form-container .clear-form-btn:hover {
            background-color: darkgrey;
        }

        .budget-form-container {
            display: none;
            flex-direction: column;
            gap: 10px;
            margin-top: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .budget-form-container input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        .budget-form-container button {
            padding: 10px;
            background-color: #175AF4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .budget-form-container button:hover {
            background-color: #0d3ba1;
        }
        .budget-form-container .cancel-budget-btn {
            background-color: grey;
            margin-top: 10px;
        }
        .budget-form-container .cancel-budget-btn:hover {
            background-color: darkgrey;
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
            <li style="color: white; background-color:#175AF4">Budget</li>
            <a href="view_report.php"><li>View Reports</li></a>
            <br><br>
            <a href="approval.php"><li>Approval</li></a>
            <br>
            <li>Logout</li>
        </ul>
    </div>
    <div class="content" id="content">
        <h1>Admin Dashboard - Budget & Department</h1>
        <hr>
        <div class="category-container">
            <div class="category" id="budget-category">
                <h2>Budget</h2>
                <div class="item-container" id="budget-items">
                    <div class="item" data-budget="0">
                        <h3>Budget</h3>
                        <p>Total : <?php 
                        include("database/dblink.php");
                        $result = $mysqli->query("SELECT SUM(budget_amount) AS total FROM department");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        $mysqli->close();
                        ?></p>
                        
                    </div>
                    <div class="item" data-budget="0">
                        <h3>Total's Expense</h3>
                        <p>Amount<span>?</span></p>
                    </div>
                </div>
            </div>
            <div class="category">
                <h2>Department</h2>
                <div class="item-container" id="department-items">
                    <?php
                    include("database/dblink.php");
                    $result = $mysqli->query("SELECT did, dname, budget_amount, user_email FROM department");
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='item' data-id='{$row['did']}'>
                                <h3>{$row['dname']}</h3>
                                <p>Budget: {$row['budget_amount']}</p> <p>{$row['user_email']}</p>
                              </div>";
                    }
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
        <div class="form-container" id="budget-form">
            <form action="department_update.php" method="post">
                <input type="hidden" id="department-id" name="department-id">
                <input type="text" id="department-name" name="department-name" placeholder="Department Name" required>
                <input type="number" id="new-budget-amount" placeholder="New Budget Amount" name="new-budget-amount" required>
                <input type="text" id="user-email" name="user-email" placeholder="User's email" required>
                <input type="submit" id="update-budget-btn" value="Update Budget" name="update-budget">
                <button type="button" class="cancel-budget-btn" id="cancel-budget-btn">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggle-btn');
        const menuItems = document.getElementById('menu-items');
        const departmentItems = document.getElementById('department-items');
        const departmentForm = document.getElementById('department-form');
        const budgetForm = document.getElementById('budget-form');
        const saveDepartmentBtn = document.getElementById('save-department-btn');
        const clearDepartmentBtn = document.getElementById('clear-department-btn');
        const updateBudgetBtn = document.getElementById('update-budget-btn');
        const cancelBudgetBtn = document.getElementById('cancel-budget-btn');
        let currentDepartment = null;

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
            } else {
                menuItems.classList.remove('show');
                toggleBtn.style.animation = 'vibrate 0.3s infinite'; // Start vibration when not expanded
            }
        });

        // JavaScript to animate items from right to left
        const items = document.querySelectorAll('.item');
        items.forEach((item, index) => {
            setTimeout(() => {
                item.style.transform = 'translateX(0)';
            }, index * 500); // Delay each item by 500ms
        });

        // JavaScript to show form when existing department is clicked
        document.querySelectorAll('#department-items .item').forEach(item => {
            item.addEventListener('click', () => {
                currentDepartment = item;
                budgetForm.style.display = 'flex';
                document.getElementById('department-id').value = item.getAttribute('data-id');
                document.getElementById('department-name').value = item.querySelector('h3').innerText;
                document.getElementById('new-budget-amount').value = item.querySelector('p').innerText.split(': ')[1].split(',')[0];
                document.getElementById('user-email').value = item.querySelectorAll('p')[1].innerText;
            });
        });

        // JavaScript to save budget details
        updateBudgetBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent form submission
            const departmentId = document.getElementById('department-id').value;
            const newBudgetAmount = document.getElementById('new-budget-amount').value;
            const userEmail = document.getElementById('user-email').value;

            fetch('department_update.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `department-id=${departmentId}&new-budget-amount=${newBudgetAmount}&user-email=${userEmail}&update-budget=true`
            })
            .then(response => response.text())
            .then(data => {
                // Update the budget amount and user email in the department list
                currentDepartment.querySelector('p').innerText = `Budget: ${newBudgetAmount}`;
                currentDepartment.querySelectorAll('p')[1].innerText = userEmail;
                budgetForm.style.display = 'none';

                // Reload the budget category div
                reloadBudgetCategory();
            })
            .catch(error => console.error('Error:', error));
        });

        // JavaScript to reload the budget category div
        function reloadBudgetCategory() {
            const budgetCategory = document.getElementById('budget-category');
            budgetCategory.innerHTML = `
                <h2>Budget</h2>
                <div class="item-container" id="budget-items">
                    <div class="item" data-budget="0">
                        <h3>Budget</h3>
                        <p>Total : <?php 
                        include("database/dblink.php");
                        $result = $mysqli->query("SELECT SUM(budget_amount) AS total FROM department");
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        $mysqli->close();
                        ?></p>
                    </div>
                    <div class="item" data-budget="0">
                        <h3>Total's Expense</h3>
                        <p>Amount<span>?</span></p>
                    </div>
                </div>
            `;
        }

        // JavaScript to cancel budget form
        cancelBudgetBtn.addEventListener('click', () => {
            budgetForm.style.display = 'none';
        });
    </script>
</body>
</html>