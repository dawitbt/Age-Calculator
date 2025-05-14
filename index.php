<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Age Calculator</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      text-align: center;
      width: 350px;
    }
    input[type="date"] {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 10px;
      width: 100%;
    }
    button {
      margin-top: 15px;
      padding: 10px 20px;
      font-size: 16px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .result {
      margin-top: 20px;
      font-size: 18px;
    }
    .error {
      color: red;
    }
    .success {
      color: green;
    }
    .birthday {
      color: orange;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🎂 Interactive Age Calculator</h2>
  <form method="POST">
    <label for="birthdate">Select Your Birthdate:</label><br>
    <input 
      type="date" 
      name="birthdate" 
      id="birthdate" 
      required 
      aria-label="Birthdate"
      value="<?php echo isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : ''; ?>"
    >
    <br>
    <button type="submit">Calculate Age</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['birthdate'])) {
      $birthdate = new DateTime($_POST['birthdate']);
      $today = new DateTime();

      if ($birthdate > $today) {
          echo "<div class='result error'>⚠️ Birthdate cannot be in the future.</div>";
      } else {
          $age = $today->diff($birthdate);

          echo "<div class='result success'>";
          echo "You are <strong>" . $age->y . "</strong> years, <strong>" . $age->m . "</strong> months, and <strong>" . $age->d . "</strong> days old.";
          echo "</div>";

          if ($birthdate->format('m-d') === $today->format('m-d')) {
              echo "<div class='result birthday'>🎉 Happy Birthday! 🎉</div>";
          }
      }
  }
  ?>
</div>

</body>
</html>

