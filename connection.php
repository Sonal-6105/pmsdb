<?php
    include('config.php');

    //Call ths function to open DB Connection
    function openDBConnection(){
        //initiate connection to server
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DB);

        //test connection
        if (!$conn){
            echo json_encode([
                "response" => "DB Server not reachable. Try again later. (Response Code - 02"
            ]);
            die();
        }
        else{
            return $conn;
        }
    }
    //call this function to close a database connection opened earlier
    function closeDBConnection($conn){
        mysqli_close($conn);
    }
?>