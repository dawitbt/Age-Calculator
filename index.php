Here’s an upgraded version of your Age Calculator project with:

* Better modern UI
* Live clock
* Dark gradient background
* Age in years, months, days, hours
* Next birthday countdown
* Responsive design
* Reset button
* Smooth hover effects

```php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Age Calculator</title>

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    body{
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #141e30, #243b55);
      height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      color:white;
    }

    .container{
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(10px);
      padding:30px;
      border-radius:20px;
      width:400px;
      text-align:center;
      box-shadow:0 0 20px rgba(0,0,0,0.3);
    }

    h1{
      margin-bottom:15px;
      font-size:28px;
    }

    .clock{
      margin-bottom:20px;
      font-size:18px;
      color:#ffd369;
    }

    input[type="date"]{
      width:100%;
      padding:12px;
      border:none;
      border-radius:10px;
      margin-top:10px;
      font-size:16px;
    }

    button{
      margin-top:15px;
      padding:12px 20px;
      border:none;
      border-radius:10px;
      cursor:pointer;
      font-size:16px;
      transition:0.3s;
    }

    .calculate-btn{
      background:#00b894;
      color:white;
    }

    .calculate-btn:hover{
      background:#00a383;
      transform:scale(1.05);
    }

    .reset-btn{
      background:#d63031;
      color:white;
      margin-left:10px;
    }

    .reset-btn:hover{
      background:#b71c1c;
      transform:scale(1.05);
    }

    .result{
      margin-top:25px;
      padding:15px;
      border-radius:10px;
      background:rgba(255,255,255,0.15);
    }

    .success{
      color:#55efc4;
    }

    .error{
      color:#ff7675;
    }

    .birthday{
      color:#ffeaa7;
      font-size:20px;
      margin-top:10px;
      font-weight:bold;
    }

    .next-birthday{
      margin-top:10px;
      color:#81ecec;
    }

    @media(max-width:450px){
      .container{
        width:90%;
      }

      button{
        width:100%;
        margin-left:0;
      }

      .reset-btn{
        margin-top:10px;
      }
    }
  </style>
</head>

<body>

<div class="container">

  <h1>🎂 Age Calculator</h1>

  <div class="clock" id="clock"></div>

  <form method="POST">

    <label>Select Your Birthdate</label>

    <input 
      type="date" 
      name="birthdate"
      required
      value="<?php echo isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : ''; ?>"
    >

    <button type="submit" class="calculate-btn">
      Calculate Age
    </button>

    <button type="reset" class="reset-btn">
      Reset
    </button>

  </form>

  <?php

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['birthdate'])){

      $birthdate = new DateTime($_POST['birthdate']);
      $today = new DateTime();

      if($birthdate > $today){

          echo "<div class='result error'>";
          echo "⚠ Birthdate cannot be in the future.";
          echo "</div>";

      } else {

          $age = $today->diff($birthdate);

          $hours = floor((time() - strtotime($_POST['birthdate'])) / 3600);

          echo "<div class='result success'>";

          echo "<h2>Your Age</h2><br>";

          echo "<p><strong>{$age->y}</strong> Years</p>";
          echo "<p><strong>{$age->m}</strong> Months</p>";
          echo "<p><strong>{$age->d}</strong> Days</p>";
          echo "<p><strong>{$hours}</strong> Total Hours</p>";

          echo "</div>";

          // Birthday Check
          if($birthdate->format('m-d') == $today->format('m-d')){

              echo "<div class='birthday'>";
              echo "🎉 Happy Birthday! 🎉";
              echo "</div>";
          }

          // Next Birthday Countdown
          $nextBirthday = new DateTime($today->format('Y') . '-' . $birthdate->format('m-d'));

          if($nextBirthday < $today){
              $nextBirthday->modify('+1 year');
          }

          $remaining = $today->diff($nextBirthday);

          echo "<div class='next-birthday'>";
          echo "🎁 Next Birthday in ";
          echo "<strong>{$remaining->m}</strong> months and ";
          echo "<strong>{$remaining->d}</strong> days.";
          echo "</div>";
      }
  }

  ?>

</div>

<script>

function updateClock(){

    const now = new Date();

    document.getElementById("clock").innerHTML =
      "🕒 " + now.toLocaleTimeString();
}

setInterval(updateClock,1000);

updateClock();

</script>

</body>
</html>
```
