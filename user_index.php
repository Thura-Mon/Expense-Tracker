<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Awesome Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            scroll-behavior: smooth; /* Add smooth scrolling */
        }

        header {
            background: #5D64F5; /* Changed to #5D64F5 */
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
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            text-decoration: none;
        
        }

        nav ul li a:hover {
            color: #ff6347;
        }

        .container {
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #7693EE;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .button:hover {
            background: #175AF4;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 2s ease-in;
        }

        section {
            padding: 60px 0;
        }

    </style>
</head>
<body>
    <header>
        <h1></h1>
        <nav>
            <ul>
                <li>Home</li>
                <a href="expense.php"><li>Expense</li></a>
                <a href="user_message.php"><li>Message</li></a>
                <a href="user_logout.php"><li>Logout</li></a>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section id="home">
            <div class="card fade-in">
                <h2>Home Section</h2>
                <p>This is the home section. It has some content inside it. Hover over it to see the effect.</p>
                <a href="#" class="button">Read More</a>
            </div>
        </section>
        <section id="expense">
            <div class="card fade-in">
                <h2>Expense Section</h2>
                <p>This is the expense section. It has some content inside it. Hover over it to see the effect.</p>
                <a href="#" class="button">Read More</a>
            </div>
        </section>
        <section id="message">
            <div class="card fade-in">
                <h2>Message Section</h2>
                <p>This is the message section. It has some content inside it. Hover over it to see the effect.</p>
                <a href="#" class="button">Read More</a>
            </div>
        </section>
        <section id="logout">
            <div class="card fade-in">
                <h2>Logout Section</h2>
                <p>This is the logout section. It has some content inside it. Hover over it to see the effect.</p>
                <a href="#" class="button">Read More</a>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseover', function() {
                    card.style.transform = 'translateY(-10px)';
                });
                card.addEventListener('mouseout', function() {
                    card.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>