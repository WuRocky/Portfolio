<?php 
    $servername = "localhost";
    $user_dbname = "registrationForm";
    $dbname = "User_ESP32_001";
    $username = "root";
    $password = "SD89bK8vC5Pi";

    $upload_str = $sensor = $location = $Heart_Rate = $Stride_Cadence = $Velocity = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $upload_str = test_input($_POST["upload_str"]);

        $sensor = test_input($_POST["sensor"]);

        $location = test_input($_POST["location"]);

        $Heart_Rate = test_input($_POST["Heart_Rate"]);

        $Stride_Cadence = test_input($_POST["Stride_Cadence"]);

        $Velocity = test_input($_POST["Velocity"]);

        $Distance = test_input($_POST["Distance"]);
                
        $user_conn = mysqli_connect($servername, $username, $password, $user_dbname);

        if ($user_conn->connect_error) 
        {
            die("Connection failed: " . $user_conn->connect_error);
        }

        $sqlacc_read = "SELECT account FROM recording WHERE watch = 'IOT-watch001'";
        $executed_status_acc =mysqli_query($user_conn, $sqlacc_read);
        $row_acc = mysqli_fetch_assoc($executed_status_acc);
        $dbname = $row_acc[account];
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if ($upload_str == "start")
        {
            $date = str_replace("-","","D" . (string)date("Y-m-d-H-i-s", time() + 8 * 60 * 60));
            $sqlcreate = "CREATE TABLE `" .  $date . "` (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                Sensor VARCHAR(30) NOT NULL,
                Location VARCHAR(30) NOT NULL,
                Heart_Rate FLOAT,
                Stride_Cadence FLOAT,
                Velocity FLOAT,
                Distance FLOAT,
                Reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                if (mysqli_query($conn, $sqlcreate)) 
                {
                    echo "資料表建立成功";
                } 
                else 
                {
                    echo "無法創建資料表: " . mysqli_error($conn);
                }

                $sqltemp_create = "CREATE TABLE temp (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                table_name01 VARCHAR(30) NOT NULL)";
                if(mysqli_query($conn, $sqltemp_create))
                {
                    echo "temp 建立成功";
                }
                else
                {
                    echo "temp 建立失敗" . mysqli_error($conn);
                }

            $sqltemp_insert = "INSERT INTO temp (table_name01) VALUES ('$date')";
            if ($conn->query($sqltemp_insert) === TRUE) 
            {
                echo "New record created successfully";
            } 
             else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
                
        elseif($upload_str == "uploading")
        {
            
        $sqltemp_read = "SELECT table_name01 FROM temp WHERE id = 1";
        $executed_status =mysqli_query($conn, $sqltemp_read);
        $row = mysqli_fetch_assoc($executed_status);
        $table = $row[table_name01];

        // $table = $_COOKIE["Table"];
        $sql = "INSERT INTO  `".$table."` (sensor, location, Heart_Rate, Stride_Cadence, Velocity, Distance)
        VALUES ('$sensor','$location' ,'$Heart_Rate' , '$Stride_Cadence' ,'$Velocity', '$Distance')";
        if ($conn->query($sql) === TRUE) 
        {
            echo "New record created successfully";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        }

        elseif($upload_str == "end")
        {
            $sql_drop = "Drop Table temp;";
            if(mysqli_query($conn, $sql_drop))
            {
                echo "temp 建立成功";
            }
            else
            {
                echo "temp 建立失敗" . mysqli_error($conn);
            }
        }
    }
    else 
    {
        echo "No data POSTed with HTTP POST.<br>";
        echo "REQUEST_METHOD == " . $_SERVER["REQUEST_METHOD"];
        echo $_GET["sensor"];
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }