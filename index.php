<?php
    require_once 'inc/connection.inc.php';

    function processDescriptionText($string){
        return str_replace("\n", '<br>', $string);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="prabhakar gupta">

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Top 100 Villians</title>
</head>

<body>
    <a href="https://github.com/prabhakar267/IGN-top-100-villian" target="_blank">
        <img src="img/right-dusk-blue%402x.png" class="fork-github visible-lg">
    </a>

    <div class="head">
        <h2><strong>IGN Top 100 Villians</strong></h2>
        <br>
        <div class="container">
            <blockquote><small>As of 2009, comic books have been with us for 75 years. In that span, countless heroes have arisen and captivated generations of readers with their courageous exploits. But a hero is nothing without a good villain. What's the point of being able to leap tall buildings in a single bound unless there's someone to test your mettle?<br>We've combed through the Golden Age, Silver Age, Bronze Age, and Modern Age to gather the best of the worst for our Top 100 Comic Book Villains of All Time. Who will reign supreme?</small></blockquote>
            This is a simple script written in PHP to scrape the data from <a href="http://ca.ign.com/top/comic-book-villains/" target="_blank">IGN Website</a> using HTML DOM Parsing<br>and hence display the data in a list format which was not present on IGN original website.<br>
            <strong>I basically built this scraper so that I could read about all the villians on a single page and I don't need to click on NEXT for every other villian.</strong>
            <br><br>
        </div>
    </div>
    
    <div class="container">

<?php
    $query = "SELECT * FROM `data` WHERE 1 ORDER BY `rank` DESC";
    $query_run = mysqli_query($connection, $query);
    while($query_row = mysqli_fetch_assoc($query_run)){
        echo "
            <div class='col-md-12 villian-info'>
                <span style='background-image: url(" . $query_row['image'] . ")'></span>
                <header>#" . $query_row['rank'] . " | " . $query_row['name'] . "</header>
                <p>" . processDescriptionText($query_row['description']) . "</p>
            </div>\n";
    }
?>

    </div>
    <hr>
</body>
</html>