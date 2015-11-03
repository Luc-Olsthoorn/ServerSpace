<?php
function nicetime($time)
{
    if(empty($time)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date         = $time;
    
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}

$date = "2009-03-04 17:45";
$result = nicetime($time); // 2 days ago

?>
<?php
function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}


function SavePostToDB($_db, $_time, $_file_name)
{
	/* Prepared statement, stage 1: prepare query */
	if (!($stmt = $_db->prepare("INSERT INTO POSTCARDS(TIME_STAMP, IMAGE_NAME) VALUES (?, ?)")))
	{
		echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
	}

	/* Prepared statement, stage 2: bind parameters*/
	if (!$stmt->bind_param('ss',  $_time, $_file_name))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	/* Prepared statement, stage 3: execute*/
	if (!$stmt->execute())
	{
		
	}
}


function getPostcards($_db)
{
    $query = "SELECT TIME_STAMP, IMAGE_NAME FROM POSTCARDS ORDER BY TIME_STAMP DESC";
    
    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }
    
    $output = '';
    
    while($row = $result->fetch_assoc())
    {
        $output = $output . '<div class="col s6">'.'<div class="card-panel teal">' 
                                    
        . '<span class="white-text"><a href="' .'http://lamp.cse.fau.edu/~lolsthoorn2014/users/' . $row['IMAGE_NAME'] . '">'. $row['IMAGE_NAME'] .'</a></span>' .'<br>' 
            .'<a><small style="color:white;">- '.nicetime($row['TIME_STAMP']).'</small></a></div></div>' ;
    }
    
    return $output;
}
?>
