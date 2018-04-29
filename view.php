<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get information from DOI</title>
    <style>
        * {font-family: Verdana, sans-serif; margin: 0; padding: 0; box-sizing: border-box;}
        body {background-color: rgb(233, 250, 255);}
        .container {margin: 100px 0 10px 0}
        h1 {text-align: center; font-weight: 400; margin: 0 0 50px 0;}
        form {position: relative; width: 70%; height: 50px; margin: auto;}
        input[type="text"] {position: relative; width: 100%; height: 100%; border: 0; padding: 0 0 0 30px; font-size: 15px;}
        input[type="submit"] {position: absolute; width: 50px; height: 50px; top: 0; right: 0; border: 0; background-color: rgb(115, 180, 189); color: #fff; text-transform: uppercase; font-size: 16px; cursor: pointer; transition: background-color 200ms ease-in-out;}
        input[type="submit"]:hover {background-color: rgb(69, 149, 160); transition: background-color 200ms ease-in-out;}
        .error {width: 70%; margin: auto; padding-left: 20px;}
        .result {width: 70%; margin: auto; padding: 0 20px; margin-top: 40px;}
        .result__url {background-color: rgba(0,0,0,.8); padding: 20px;}
        .result__url a {color: #fff;}
        .result__url span {color: #eee; float: right; font-style: italic; font-size: 13px;}
        h2 {display: inline-block; text-align: left; font-weight: 400; margin: 20px 5px 20px 0; font-size: 18px;}
        .authors {display: inline-block;}
        .authors li {list-style: none; display: inline-block; background-color: rgb(115, 180, 189); color: rgba(0,0,0,.7); padding: 5px; margin: 0 2px;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Hi !<br>Put the DOI id into the input to get information !</h1>
        <form action="" method="post">
            <input type="text" name="identifiant" placeholder="Example : 10.1145/147126.147133">
            <input type="submit" value="go" name="getInformationAction">
        </form>
    </div>
</body>
</html>