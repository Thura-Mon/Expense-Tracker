<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            scroll-behavior: smooth;
        }

        header {
            background: #5D64F5;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            z-index: 1000;
        }

        nav ul li {
            margin: 0 15px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: color 0.3s ease;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav ul li:hover a {
            cursor: pointer;
            color: rgb(7, 3, 2);
        }

        .container {
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #5D64F5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .button:hover {
            background: #175AF4;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            height: 60%;
            width: 25%; /* Adjusted width */
            max-width: 500px; /* Adjusted max-width */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .modal-content input {
            width: 80%;
            padding: 10px;
            margin-top: 7px;
            margin-bottom: 15px;
            margin-left: 25px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            margin-top: 7%;
            margin-left: 15.5%;
            width: 70%;
            padding: 10px;
            background: #7693EE;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background: #175AF4;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 24px;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .report-button {
            display: inline-block;
            padding: 10px 20px;
            background: #ff6347;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .report-button:hover {
            background: #ff4500;
        }
    </style>
</head>
<body>
    <header>
        <h1>Department name created by admin</h1>
        <nav>
            <ul>
                <li><a href="user_index.php">Home</a></li>
                <li><a href="#expense">Expense</a></li>
                <li><a href="user_message.php">Message</a></li>
                <li><a href="#user_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section id="expense">
            <h2>Expense Section</h2>
            <div class="button-container">
                <button class="button" id="addItemButton">Add Item</button>
                <a href="#" class="report-button">Report To Admin</a>
            </div>
            <div class="modal" id="expenseModal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h3>Add Expense</h3>
                    <form id="expenseForm">
                        <input type="text" id="expenseId" placeholder="ID" required>
                        <input type="text" id="itemName" placeholder="Item Name" required>
                        <input type="number" id="amount" placeholder="Amount" required>
                        <input type="date" id="dateOfExpense" placeholder="Date of Expense" required>
                        <input type="file" id="image" placeholder="Image" required>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <table id="expenseTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Amount</th>
                        <th>Date of Expense</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Expense items will be added here -->
                </tbody>
            </table>
        </section>
    </div>
    <script>
        document.getElementById('addItemButton').addEventListener('click', function() {
            document.getElementById('expenseModal').style.display = 'flex';
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('expenseModal').style.display = 'none';
        });

        document.getElementById('expenseForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('expenseId').value;
            const itemName = document.getElementById('itemName').value;
            const amount = document.getElementById('amount').value;
            const dateOfExpense = document.getElementById('dateOfExpense').value;
            const image = document.getElementById('image').files[0].name;

            const table = document.getElementById('expenseTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `<td>${id}</td><td>${itemName}</td><td>${amount}</td><td>${dateOfExpense}</td><td>${image}</td>`;

            document.getElementById('expenseModal').style.display = 'none';
            document.getElementById('expenseForm').reset();
        });

        window.onclick = function(event) {
            if (event.target == document.getElementById('expenseModal')) {
                document.getElementById('expenseModal').style.display = 'none';
            }
        }
    </script>
</body>
</html>