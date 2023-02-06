<?php
function cors()
{
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
    // echo "You have CORS!";
}

cors();

$request_data = json_decode(file_get_contents("php://input"));
$data = array();
$servername = "localhost";
$username = "icpscorecard";
$password = "icp2565";
$database = "icp-score-card";


try {
        $connect = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
    } catch(PDOException $e) {    
        echo "Connection failed: " . $e->getMessage();
    }
                    
if ($request_data->action == "insert") {
    echo " insert ";
    $data = array(
        ":disability_id" => $request_data->disability_id,
        ":disability_name" => $request_data->disability_name, 
        ":dis_description" => $request_data->dis_description,

    );
    $query = "INSERT INTO disability (disability_id,
                                      disability_name,
                                      dis_description) 
                             VALUES(:disability_id,
                                    :disability_name,
                                    :dis_description)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "getall") {
    $query = "SELECT * FROM disability as dis
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "getDisabilitys") {
    $query = "SELECT * FROM disability as dis
              ;";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "edit") {
    $query = "SELECT * FROM disability WHERE disability_id = $request_data->disability_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['disability_id'] = $row['disability_id'];
        $data['disability_name'] = $row['disability_name'];
        $data['dis_description'] = $row['dis_description'];
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "update") {
    $data = array(
        ":disability_id" => $request_data->disability_id,
        ":disability_name" => $request_data->disability_name, 
        ":dis_description" => $request_data->dis_description,
    );
    $query = "UPDATE disability
    SET 
        disability_id=:disability_id,
        disability_name=:disability_name,
        dis_description=:dis_description,
    WHERE disability_id=:disability_id;";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM disability WHERE disability_id = $request_data->disability_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
}
?>