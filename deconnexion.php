<?php 

include "includes/bdd.inc.php";
include "includes/session.inc.php";

session_destroy();

header("Location: index.php")

?>