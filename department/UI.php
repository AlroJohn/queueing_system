<?php
    include("../connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylse.css">
</head>
<body>
    <table id="fetchData">

    </table>

    <video controls autoplay loop class="unconstrained-video">
        <source src="../video/2D_animated_ads.MP4" type="video/mp4">
    </video>

    <!-- SCRIPT FOR REALTIME ALIKE FETCHING DATA -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function fetchData() {
    $.ajax({
        url: 'fetch_data.php',
        method: 'GET',
        success: function(response) {
            // Update the content of the table with the response data
            $('#fetchData').html(response);
        },
        error: function() {
            console.log('Error fetching data');
        }
    });
    }

    fetchData();

    setInterval(fetchData, 3000);
    </script>

</body>
</html>
