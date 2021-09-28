<?php require_once('funcionesvar.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td{
            width: 50px;
            height:50px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <?php construyeTabla();?>
    </table>
</body>
</html>