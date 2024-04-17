<?php
    $server = "sql39.cpt3.host-h.net";
    $uname = "cutter_r";
    $ropwd = "Xeq9wt8QgPH9w95dX8R8";
    $dbName = "cutoff";
    $table = "websites";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }else{
        echo "no id";
        die('no id provided');
    }

    try {
        $conn = new mysqli($server, $uname, $ropwd, $dbName);

        if ($conn->connect_error) {
            $conn->close();
            error_log("cutoff.php DB connect: " . $conn->connect_error);
            die('DB connect error: '. $conn->connect_error);
        }

        $sql = "SELECT paid FROM `$table` WHERE id = $id;";

        if($res = $conn->query($sql)){
            echo $res->fetch_row()[0] ."";
        }else{
            error_log("cutoff.php no results from DB");
        }
    } catch (mysqli_sql_exception $e) {
        error_log("cutoff.php: " . $e->getMessage());
    }
    $conn->close();
?>