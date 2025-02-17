<?php
    echo("<P>");
    echo("Name = "); echo $_GET["name"];
    echo("<P>");
    echo("email = "); echo $_GET["email"];
?>
<P>

<form action="action.php" method="get">
    Name:   <input type="text" name="name"><br>
    Email:  <input type="text" name="email"><br>
            <input type="submit">
</form>
