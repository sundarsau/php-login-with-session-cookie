<?php
session_start();
if (!isset($_SESSION['name']))
    header("location:login.php");
include "header.php";
?>
<h1>My Dashboard</h1>
</body>
</html>