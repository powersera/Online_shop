<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>


<h1>Ajax Пример</h1>

<p>Your name:</p>

<input type="text" id = "input1">

<br>
<br>
<p id = "hello"></p>

<br>

<button id="send">Асинхронная отправка </button>

<script>

    $("#send").click(function(){
        var params = {
            text: $("#input1").val()
        }
        $.post("ajax.php", params, function (data) {
            $("#hello").html(data);
        })

    });



</script>


</body>
</html>