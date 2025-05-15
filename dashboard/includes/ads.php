<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Dashboard Banner with Animation</title>
  <style>
    /* General styling for the banner */
    .dashboard-banner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-radius: 8px;
      padding: 20px;
      margin: 20px 0;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      animation: backgroundColorChange 15s infinite; /* Animation for background color */
    }

    /* Banner content styling */
    .banner-content {
      flex: 1;
      padding: 10px;
    }

    .banner-content h2 {
      font-size: 24px;
      color: #fff;
      margin-bottom: 10px;
    }

    .banner-content p {
      font-size: 16px;
      color: #fff;
      margin-bottom: 20px;
    }

    .banner-content .btn-upgrade {
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
    }

    /* Banner image styling */
    .banner-image img {
      max-width: 300px;
      height: auto;
      border-radius: 8px;
    }

    /* Responsive styles for tablets */
    @media (max-width: 768px) {
      .dashboard-banner {
        flex-direction: column;
        text-align: center;
      }

      .banner-image img {
        max-width: 200px;
        margin-top: 15px;
      }
    }

    /* Responsive styles for mobile */
    @media (max-width: 480px) {
      .banner-content h2 {
        font-size: 20px;
      }

      .banner-content p {
        font-size: 14px;
      }

      .banner-image img {
        max-width: 150px;
      }
    }

    /* Background color animation */
    @keyframes backgroundColorChange {
      0% { background-color: #3498db; }  /* Blue */
      25% { background-color: #2ecc71; } /* Green */
      50% { background-color: #f39c12; } /* Orange */
      75% { background-color: #e74c3c; } /* Red */
      100% { background-color: #3498db; } /* Blue again */
    }
  </style>
</head>
<body>

  <div class="dashboard-banner">
    <div class="banner-content">
      <h2>Upgrade to Premium</h2>
      <p>Get access to exclusive features and more!</p>
      <a href="#" class="btn-upgrade">Upgrade Now</a>
    </div>
    <div class="banner-image">
      <img src="https://via.placeholder.com/300x150.png?text=Ad+Banner" alt="Ad Banner">
    </div>
  </div>

</body>
</html>
