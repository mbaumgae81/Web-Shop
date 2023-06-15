<?php
include ("../php/admin/util.inc.php");


?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="../index.php" method="post">
<table>
    <tr>
        <td>
        Suche nach . . .
        </td>
    </tr>
    <tr>
        <td>
        <input type="text" name="suchbegriff" >
        </td>
        <td>
        <input type="submit" name="search" >
        </td>
    </tr>



</table>
    </form>

</body>
</html>
