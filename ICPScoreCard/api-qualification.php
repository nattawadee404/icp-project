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
    $member_id          = (int)$request_data->member_id;
    $qualification_name = "'". $request_data->qualification_name ."'";
    // $data = array(
    //     ":member_id" => $request_data->member_id,
    //     ":qualification_name" => $request_data->qualification_name,
    // );
    $query = "INSERT INTO qualification (member_id,qualification_name) 
              VALUES($member_id , $qualification_name)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "getall") {
    // echo " getAllUser ";
    $query = "SELECT * FROM qa_plan_career as qpc
              INNER JOIN qualification as qa ON qpc.qualification_id = qa.qualification_id
              INNER JOIN plan_career as pc ON qpc.plan_career_id = pc.plan_career_id
              INNER JOIN career as ca ON pc.career_id = ca.career_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "edit") {
    $query = "SELECT * FROM qualification WHERE qualification_id = $request_data->qualification_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['qualification_id'] = $row['qualification_id'];
        // $data['plan_career_id'] = $row['plan_career_id'];
        $data['qualification_name'] = $row['qualification_name'];
        // $data['level'] = $row['level'];
        // $data['target'] = $row['target'];
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "update") {
    $data = array(
        ":qualification_id" => $request_data->qualification_id,
        ":plan_career_id" => $request_data->plan_career_id,
        ":qualification_name" => $request_data->qualification_name,
        ":level" => $request_data->level,
        ":target" => $request_data->target
    );
    $query = "UPDATE qualification 
    SET 
        qualification_id=:qualification_id,
        plan_career_id=:plan_career_id,
        qualification_name=:qualification_name,
        level=:level,
        target=:target
    WHERE qualification_id=:qualification_id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM qualification WHERE qualification_id = $request_data->qualification_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
}
