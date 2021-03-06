<!DOCTYPE html>
<html>
<head>
  @yield('title')

  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

  <style>
    html, body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      color: #B0BEC5;
      display: table;
      font-weight: 100;
      font-family: 'Lato';
    }

    .container {
      text-align: center;
      display: table-cell;
      vertical-align: middle;
    }

    .content {
      text-align: center;
      display: inline-block;
      color: #000000;
      font-weight: 200;
      font-size: 25px;
    }

    .title {
      font-size: 72px;
      margin-bottom: 40px;
    }
  </style>
</head>
<body>
<div class="container">
  <div>
    @yield('content')
  </div>
</div>
</body>
</html>