<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('send') }}" method="post">
        @csrf
        <div class="">
            <label for="">phone with country code</label>
            <input type="text" name="phone" id="">
        </div>
        <div class="">
            <label for="">message</label>
            <input type="text" name="msg" id="">
        </div>
        <input type="submit" value="send" name="" id="">

    </form>
</body>
</html>
