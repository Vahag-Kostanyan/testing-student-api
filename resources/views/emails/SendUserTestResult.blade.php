<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Result</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .result-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      text-align: center;
      position: relative;
      overflow: hidden;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    h1 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #333;
      font-weight: 700;
    }

    .result-details {
      text-align: left;
      margin-bottom: 20px;
    }

    .result-details p {
      font-size: 18px;
      margin: 10px 0;
      line-height: 1.5;
    }

    .result-details .score {
      font-weight: bold;
      color: #4CAF50;
      /* Green color for positive score */
    }

    .result-details .status {
      font-weight: bold;
      padding: 5px 10px;
      border-radius: 5px;
      display: inline-block;
    }

    .result-details .status.pass {
      background-color: #4CAF50;
      /* Green background for pass */
      color: #fff;
    }

    .result-details .status.fail {
      background-color: #f44336;
      /* Red background for fail */
      color: #fff;
    }

    .result-icon {
      position: absolute;
      bottom: -30px;
      right: -30px;
      background-color: #4CAF50;
      color: #fff;
      border-radius: 50%;
      padding: 20px;
      font-size: 40px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .result-icon.fail {
      background-color: #f44336;
    }
  </style>
</head>

<body>
  <div class="result-container">
    <h1>Test Results</h1>
    <div class="result-details">
      <p><strong>Name:</strong> {{ $username }}</p>
      <p><strong>Test:</strong> {{ $testName }}</p>
      <p><strong>Score:</strong> <span class="score">{{ $mark }}%</span></p>
      <p><strong>Status:</strong>
        @if($status)
        <span class="status pass">Pass</span>
        @else
        <span class="status fail">Fail</span>
        @endif
      </p>
    </div>
  </div>
</body>

</html>