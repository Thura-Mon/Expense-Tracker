<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Messages</title>
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
        .message-container {
            margin-top: 0px;
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
        }
        .message-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .message-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #175AF4;
            color: white;
        }
        .message-card h3 {
            margin-top: 0;
        }
        .message-card p {
            margin-bottom: 0;
        }
        .message-card .message-btn {
            margin-top: 10px;
            padding: 5px 10px;
            background-color:rgb(4, 69, 221);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .message-card .message-btn:hover {
            background-color:rgb(0, 55, 185);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .reply-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .reply-form button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #175AF4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .reply-form button:hover {
            background-color: #0d3ba1;
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
            <a href="approval.php"><li>Approval</li></a>
            <li style="color: white; background-color:#175AF4">Message</li>
            <br>
            <li>Logout</li>
        </ul>
    </div>
    <div class="content" id="content">
        <h1>Admin Dashboard - Messages</h1>
        <hr>
        <div class="message-container">
            <!-- Message cards will be appended here -->
            <div class="message-card">
                <h3>John Doe</h3>
                <p><strong>Email:</strong> user1@example.com</p>
                <p><strong>Message:</strong> Hello, I need help with my account.</p>
                <p><strong>Date:</strong> 2025-02-20</p>
                <button class="message-btn" onclick="openModal('user1@example.com', 'John Doe')">Reply</button>
            </div>
            <div class="message-card">
                <h3>Jane Smith</h3>
                <p><strong>Email:</strong> user2@example.com</p>
                <p><strong>Message:</strong> Can you please update my profile?</p>
                <p><strong>Date:</strong> 2025-02-21</p>
                <button class="message-btn" onclick="openModal('user2@example.com', 'Jane Smith')">Reply</button>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Reply to <span id="modalUserName"></span></h2>
            <form class="reply-form" action="send_reply.php" method="post">
                <input type="hidden" name="email" id="modalUserEmail">
                <textarea name="message" rows="5" placeholder="Type your reply here..."></textarea>
                <button type="submit">Send Reply</button>
            </form>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggle-btn');
        const menuItems = document.getElementById('menu-items');
        const modal = document.getElementById('replyModal');
        const modalUserName = document.getElementById('modalUserName');
        const modalUserEmail = document.getElementById('modalUserEmail');

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

        function openModal(email, name) {
            modal.style.display = "block";
            modalUserName.textContent = name;
            modalUserEmail.value = email;
        }

        function closeModal() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>