<?php
if(!empty($_REQUEST['first'])){
    print_r($_POST);
    print_r($_FILES);
    exit;
}


//echo 'Branch 22222';
//I don't get it!

// mysqli, object oriented way
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

//http://stackoverflow.com/questions/10113562/pdo-mysql-use-pdoattr-emulate-prepares-or-not
$dsn = 'mysql:dbname='.$dbname.';host='.$servername.';port=3306';
$aOptions = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
try {
    $db = new PDO($dsn, $username, $password, $aOptions); // also allows an extra parameter of configuration
 } catch(PDOException $e) {
    die('Could not connect to the database:<br/>' . $e);
  }

//echo 'Connected!<br>';

    //Working example 1
/*
$min_price = 10;
$min_price = $db->quote($min_price, PDO::PARAM_INT);

$limit = 1;
$limit = (int)trim($limit);

$statement = <<<SQL
SELECT * FROM `vehicles` WHERE `price` > $min_price LIMIT 0, $limit
SQL;
try {
  $cars = $db->query($statement);
  if($cars->rowCount()){
        $aAllCars = $cars->FetchAll();
        foreach($aAllCars as $car) {
            echo $car['brand'] . '<br />';
        }
    }else{
         echo '0 rows';
      }

 } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }*/
// END Working example 1


//http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers
/*
$min_price = 10;
$min_price = $db->quote($min_price, PDO::PARAM_INT);

$limit = 1;
$limit = (int)trim($limit);

try {
 $sql = "SELECT * FROM `vehiclesfff` WHERE `price` > $min_price LIMIT 0, ".$limit;
  foreach($db->query($sql) as $row) {
     echo $row['brand'] . '<br />';
   }
} catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}


exit;
*/



/*
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//example 1
$sql = "SELECT * FROM `vehicles` WHERE `price` > 0 AND `brand` = '".mysqli_real_escape_string($conn, "BMW")."'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Car: " . $row["brand"]. " " . $row["model"]. "<br>";
    }
} else {
    echo "0 results";
}

echo '<hr>';

$min_price = 0;
$brand = "BMW";
if($query = $conn->prepare("SELECT * FROM `vehicles` WHERE `timestamp` > NOW() AND `price` > ? AND `brand` = ?")) {
    $query->bind_param('is', $min_price, $brand);
    $result = $query->execute();
    $query->store_result();
    $result = $query->get_result();
    //print_r($query);
    //if($query->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Car: " . $row["brand"] . " " . $row["model"] . "<br>";
        }
     //}
 }else{
    var_dump($conn->error);
}


$conn->close();
*/

?>


<html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>

<form id="data" method="post" enctype="multipart/form-data">
    <input type="text" name="first" value="Bob" />
    <input type="text" name="middle" value="James" />
    <input type="text" name="last" value="Smith" />
    <input name="image" type="file" />
    <button>Submit</button>
</form>


<script>
$(document).ready( function(e) {

    $("form#data").submit(function(){

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                alert(data)
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });

});
</script>
</html>
