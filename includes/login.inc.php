<?php 
    require_once "./includes/check_input.php";
    require_once "./includes/param.inc.php";

    global $lifeTimeInMin;
    $id=$pw=$hint="";

    session_start();
    if(isset($_SESSION["loggedIn"])){
        if(isset($_SESSION["lastActivity"]) && (time() - $_SESSION["lastActivity"] < 60 * $lifeTimeInMin)){
            $hint="跳转中...";
            switch($_SESSION["usr_level"]){
                case 1:
                    break;
                    
                case 2:
                    break;
                    
                case 3:
                    header("refresh:1;url=../DashBoard");
                    break;
                    
                case 99:
                    phpinfo();
                    break;
                              
                default:
                    $hint="User level incorrect, it can not be " . $row["usr_level"] . " .";
                    session_destroy();
                    break;
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $pw = $_POST['pw'];
        $id = check_input($id);
        $pw = check_input($pw);
    if($id != $_POST['id'] || $pw != $_POST['pw']){
        // check special characters
        $message = "禁止使用特殊字符！";
        //header("refresh:0;url=index.php");
        echo "<script type='text/javascript'>alert('$message');</script>";
        $hint=$message;
    } else{
        // check database.
		require_once("param.inc.php");
		global $host;
		global $user;
		global $dbpw;
		global $db;
        $conn = new mysqli($host, $user, $dbpw, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "Connection failed: $conn";
        } else{
            $sql = "SELECT * FROM user_usr WHERE usr_id = '$id';";
            $result = $conn->query($sql);
            $conn->close();
            if($result->num_rows == 0){
                // id wrong
                $hint="用户名或密码错误！";
            } else{
				$row = $result->fetch_assoc();
                if(password_verify($pw, $row["usr_pw"])){
                    // login successful
                    $hint="欢迎 " . htmlentities($row["usr_name"]) . ".";
                
                    // session start, set user info.
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["usr_id"] = $row["usr_id"];
                    $_SESSION["usr_name"] = $row["usr_name"];
                    $_SESSION["usr_level"] = $row["usr_level"];
                    $_SESSION["lastActivity"] = time();
                    switch($row["usr_level"]){
                        case 1:
                            break;
							
                        case 2:
                            break;
								
                        case 3:
                            header("refresh:1;url=../DashBoard");
                            break;
							
                        case 99:
                            phpinfo();
                            session_destroy();
                            break;
                           
                        default:
                            $hint="User level incorrect, it can not be " . $row["usr_level"] . " .";
                            session_destroy();
							break;
					} 
                } else{
                     // password wrong
                     $hint="用户名或密码错误！";
                }
            }
        }
    }
}
?>
