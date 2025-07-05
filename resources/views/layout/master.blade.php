<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
</head>
<style>
    .div{
        border: 1px solid black;
        padding: 20px;
    }
    .body{
        border: 1px solid black;
        display: flex;
        padding: 5px;
        
    }

    *{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
<body>
    <div class="div">Header</div>
    <div class="div">Navigate</div>
    <div class="body">
        <div class="div" style="flex: left">
            @section('side-bar')
                <h2>Side Bar</h2>
            @show
        </div>
        <div class="div">
            @yield('content')
        </div>
    </div>
    <div class="div" style="display: flex; background-color: #a34949;">Footer</div>
</body>
</html>