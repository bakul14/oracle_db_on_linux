<form action="action.php" method="post">
    Name: <input type="text" name="name"><br>
    <input type="submit">
</form>

<?php
    echo("name=");
    echo $_POST["name"];
?>
