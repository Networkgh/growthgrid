<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      


/***********TTTTOOOOPPPP NAV BAR */





        
/***********DOWN NAV BAR */

.top-navbar {
   
   display: flex;
   align-items: center;
   justify-content: space-between;
   background-color: whitesmoke;
   color:black ;
   padding: 90px 20px;
   margin-bottom: -70px;
}

.welcome-message {
   flex: 1;
   text-align: left;
}

.date-time {
   flex: 1;
   text-align: center;
}

.logout {
   flex: 1;
   text-align: right;
}

.logout a {
   color: black;
   text-decoration: none;
   font-size: 20px;
}

@media (max-width: 768px) {
   .top-navbar {
       flex-direction: column;
       align-items: flex-start;
   }

   .welcome-message {
       order: 1;
       text-align: left;
       margin-bottom: 10px;
   }

   .date-time {
       order: 3;
       text-align: center;
       width: 100%;
       margin-bottom: 10px;
   }

   .logout {
       order: 2;
       text-align: right;
       width: 100%;
   }
}






        
    </style>
</head>
<body>

<div class="top-navbar">
        <div class="welcome-message">
              <h2>Welcome, <?php echo htmlspecialchars($_SESSION['vendor_username']); ?> &#129315;</h2>
        </div>
        <div class="date-time" id="date-time">
            <!-- JavaScript will insert the current time and date here -->
        </div>
        <div class="logout">
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
</div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const time = now.toLocaleTimeString();
            const date = now.toLocaleDateString();
            document.getElementById('date-time').textContent = `${time} | ${date}`;
        }
        setInterval(updateTime, 1000);
        updateTime(); // initial ca

</script>




</body>
</html>