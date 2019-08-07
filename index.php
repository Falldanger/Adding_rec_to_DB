<?php
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'mysite');

    $mysqli=@new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if($mysqli->connect_errno){
    	exit('Error connection');
    }

    $mysqli->set_charset('utf-8');
    // if(isset($_POST['timez'])){
    // 	if(is_numeric($_POST['timezone'])&&$_POST['timezone']>=0 && $_POST['timezone']<=23&&$_POST['timezone']!=false){
    // 		$timezone=$mysqli->real_escape_string(htmlspecialchars($_POST['timezone']));
    // 		echo 'Time zone:'.$timezone;
    // 	}
    // 	else{
    // 		echo 'Time zone should be from 0 to 23';
    // 	}
    // 	if(isset($_POST['offset'])&&(($_POST['offset']%3600)==0)||($_POST['offset']==0)){
    // 		$offset=$mysqli->real_escape_string(htmlspecialchars($_POST['offset']));
    // 		echo '</br>Offset:'.$offset;
    // 	}
    // 	else{
    // 		echo '</br>Incorrect value of offset';
    // 	}
    // 	$mysqli->query("INSERT INTO `time_zone` (`Country`, `Time zone`, `Offset`) VALUES ('NULL', '$timezone', '$offset')");
    // 	$mysqli->query("DELETE FROM `time_zone` WHERE `time_zone`.`Time zone` = $timezone");
    // }

    //$mysqli->query("UPDATE `time_zone` SET `Country` = 'USA' WHERE `time_zone`.`Time zone` = 13");

    //echo '</br></br>';

    $result_set = $mysqli->query('SELECT * FROM `time_zone`');
    $table = [];
    while (($row = $result_set->fetch_assoc()) != false) {
        $table[] = $row;
    }
    if (isset($_POST['timezone'])) {
        $title = $_POST['title'];
        $query = "SELECT `Offset` FROM `time_zone` WHERE `Country`='$title'";
        
        $result = $mysqli->query($query);
        $table1 = [];

        while (($row = $result->fetch_assoc()) != false) {
        $table1[] = $row;
        
    } echo 'Selected country: '."<b>$title</b>".';'.' Greenwich offset: '; print_r($table1[0]['Offset']); echo ' seconds';
    }

    $mysqli->close();
?>

<!-- <form action="index.php" method="post" name="reg">
	<p>
		Time zone: <input type="text" name='timezone'>
	</p>
	<p>
		Offset: <input type="text" name='offset'>
	</p>
	<p>
		<input type="submit" name="timez" value="Send">
	</p> 
</form> -->
<form name='reg' action='index.php' method='post'>
    <select name="title">
        <?php foreach ($table as $key => $value) {
        echo "<option>".$value['Country']."</option><br>"; }
        ?>
    </select>
    <p>
        <input type='submit' name='timezone' value='Send selection' />
    </p>
</form>