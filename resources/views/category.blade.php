<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<a href="/add-order" style="display: flex; flex-direction: row-reverse;">
<img src="images/shopping-cart.png" width="40px" height="40px"/>
</a>
<div id="app">
    <category-page :products='@json($products)'></category-page>
</div>
    <p>@json($products)</p>
</body>
</html>
