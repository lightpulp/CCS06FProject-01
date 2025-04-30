<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loading...</title>
  <meta http-equiv="refresh" content="3;url=frontend/page_login.php">

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    .loader {
      text-align: center;
    }
    .loader h1 {
      margin-bottom: 20px;
    }
    .spinner {
      width: 50px;
      height: 50px;
      border: 6px solid #ccc;
      border-top: 6px solid #007bff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body>

    <div class="loader">
        <h1>Loading Project...</h1>
        <div class="spinner"></div>
    </div>

</body>
</html>
