<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Phonebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">

    <!-- Datatables start -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/r-2.4.0/sb-1.4.0/sl-1.5.0/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/r-2.4.0/sb-1.4.0/sl-1.5.0/datatables.min.js"></script>
    <!-- Datatables end -->

    <script src="functions.js"></script>
</head>
<?php 
    if (isset($_GET["page"]) && ($_GET["page"] == 'new' || $_GET["page"] == 'edit')) 
    {
        $style = "style='background-color: #f8f9fa'";
    } 
    else
    {
        $style = "style='background-color: #212529;'";
    } 

?>

<body <?php if($style != null) echo $style ?>>

    <?php

        include "connectSQL.php";

        $pageType = 'home';

        if(isset($_GET["page"]))
        {
            $pageType = mysqli_real_escape_string($conn, $_GET["page"]);
        }

        $file_to_include = "views/$pageType.php";
        
        if(file_exists($file_to_include))
        {
            include "navbar.php";
            include $file_to_include;
        }
        else
        {
            include "error.php";
        }
    ?>

</body>
</html>