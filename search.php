<?php
/**
 * Different Search
 * Note: Requires PHP 5 or later
 * @package Search
 * @author Ashraful Islam Nixon <nixon613@gmail.com>
 * @copyright (c) 2013, Ashraful Islam Nixon
 */
?>

<?php

require_once 'class.database.php'; // load the database class 

$ni = new DBHandle();
$allPost = $ni->grabAllPost();

while ($row = $allPost->fetch_row())
{
    echo "<b>year:</b> " . $row[1] . "</br>"; // print the year
    echo "<b>post:</b> " . $row[0] . "</br>"; // print the post
    echo "--------------------------------------</br>";
}

?>


<form action="search.php" method="post">
Crawling Url: <input type="text" name="search">
<input type="submit">
</form> 


<?php

if(isset($_POST["search"]) && !empty($_POST["search"])) // checking for post veriable is set or empty
{
    require_once 'class.search.php'; // load the search class
   
    $searchString = $_POST["search"];
    
    $n = new Search($searchString); // send the search sting to process

    
    $query =  $n->searchLogic(); // the query
    $results = $ni->searchToken($query); // grab the result
    
    while ($row = $results->fetch_row())
            {
                echo $row[0] ."</br>"; // print the result
            }
    
}

?>

