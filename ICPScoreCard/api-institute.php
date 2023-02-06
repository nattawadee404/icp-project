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
$connect = new PDO("mysql:host=localhost:3306;dbname=icp-score-card", "root", "");


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
        ":institution_id" => $request_data->institution_id,
        ":institution_name" => $request_data->institution_name, 
        ":institution_address" => $request_data->institution_address,

    );
    $query = "INSERT INTO individual (institution_id,
                                      institution_name,
                                      institution_address) 
                             VALUES(:institution_id,
                                    :institution_name,
                                    :institution_address)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "getall") {
    $query = "SELECT * FROM institution as ins
              ;";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "getinstitutions") {
    $query = "SELECT * FROM institution as ins
              ;";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "getFacultys") {
    $institution_id = (int)$request_data->institution_id;
    $query = "SELECT * FROM faculty as fac
              WHERE fac.institution_id = $institution_id
              ;";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "getDegrees") {
    $institution_id = (int)$request_data->institution_id;
    $faculty_id = (int)$request_data->faculty_id;
    
    $query = "SELECT * FROM degree as deg
              INNER JOIN faculty   as fac  ON deg.faculty_id = fac.faculty_id
              INNER JOIN institution as ins  ON fac.institution_id = ins.institution_id
              WHERE deg.faculty_id = $faculty_id
              ;";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "getMajors") {
    $institution_id = (int)$request_data->institution_id;
    $faculty_id = (int)$request_data->faculty_id;
    $degree_id = (int)$request_data->degree_id;
    
    $query = "SELECT * FROM major as maj
              INNER JOIN degree    as deg  ON maj.degree_id = deg.degree_id
              INNER JOIN faculty   as fac  ON deg.faculty_id = fac.faculty_id
              INNER JOIN institution as ins  ON fac.institution_id = ins.institution_id
              WHERE deg.faculty_id = $faculty_id
              ;";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}
else if ($request_data->action == "edit") {
    $query = "SELECT * FROM institution WHERE institution_id = $request_data->institution_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['institution_id'] = $row['institution_id'];
        $data['institution_name'] = $row['institution_name'];
        $data['institution_address'] = $row['institution_address'];
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "update") {
    $data = array(
        ":institution_id" => $request_data->institution_id,
        ":institution_name" => $request_data->institution_name, 
        ":institution_address" => $request_data->institution_address,
    );
    $query = "UPDATE institution 
    SET 
        institution_id=:institution_id,
        institution_name=:institution_name,
        institution_address=:institution_address,
    WHERE institution_id=:institution_id;";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM institution WHERE institution_id = $request_data->institution_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
}
?>