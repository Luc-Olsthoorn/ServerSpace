
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Luc Olsthoorn</title>

    
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<style>
    span.white-text > a
    {
        color: white;
    }
</style>
</head>
<body class = "parallax-demo">
     
<nav style="background-color: rgb(0, 0, 0); z-index: 2;box-shadow: none;">
        <div class="nav-wrapper">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/index.html">Home</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/portfolio.html">Resume</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Projects<i class="material-icons right">arrow_drop_down</i></a>
                    <ul id="dropdown1" class="dropdown-content" style="width: 144px; position: absolute; top: 0px; left: 531.491455078125px; opacity: 1; display: none;">
                        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/storage.php">Storage</a></li>
                        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/clockify.html">Clockify</a></li>
                        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/math.html">Calculator</a></li>
                        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom.html">NOM</a></li>
                    </ul>
                </li>
            </ul>
            <ul id="slide-out" class="side-nav">
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/index.html">Home</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/portfolio.html">Resume</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/storage.php">Storage</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/clockify.html">Clockify</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/math.html">Calculator</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom.html">NOM</a></li>
            </ul>
            <!--<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>-->
        </div>
    </nav>
      
<div class="container" > 
    <h2 class="header">STORAGE</h2> 
    <div class="row">
        <div class="col s12 ">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#test1">Storage</a></li>
                <li class="tab col s3"><a href="#test2">Code</a></li>
            </ul>
        </div>
            <div id="test2" class="col s12">
            <div>
            <h5>
                Storage uses simple php and javascript functions to access a mysql  database, to store the time it was posted, which in turn is later used to refrence  the file stored else where on the server as well tell how long ago it was posted              </h5>
            </div>
           
            <h5>
            Let’s break the code down below:
            </h5>
            <p class="flow-text">
            This is the main page, which collects info from functions.php, and db_connect and displays it
            </p>
            <code>
                <pre>
                    &lt;div class=&quot;col s12 m6&quot;&gt;
            &lt;?php
            require_once &quot;php/db_connect.php&quot;;
            require_once &quot;php/functions.php&quot;;
            $name = sanitizeString($db, $_POST[&#39;name&#39;]);
            $time = $_SERVER[&#39;REQUEST_TIME&#39;];
            $file_name = $_FILES[&#39;upload&#39;][&#39;name&#39;];
            if ($_FILES)
            {
                $tmp_name = $_FILES[&#39;upload&#39;][&#39;name&#39;];
                $dstFolder = &#39;users&#39;;
                move_uploaded_file($_FILES[&#39;upload&#39;][&#39;tmp_name&#39;], $dstFolder . DIRECTORY_SEPARATOR . $_FILES[&#39;upload&#39;][&#39;name&#39;]);
                //echo &quot;Uploaded image &#39;$file_name&#39;&lt;br /&gt;&lt;img src=&#39;$dstFolder/$file_name&#39;/&gt;&quot;;
            }
            SavePostToDB($db, $time, $file_name);
            ?&gt;
            &lt;div&gt;      
                &lt;div id=&quot;formParent&quot; class=&quot;col-md-6 col-md-offset-3&quot;&gt;
                    &lt;form id=&quot;form&quot; class=&quot;form-horizontal&quot; method=&quot;POST&quot; action=&quot;storage.php&quot; enctype=&quot;multipart/form-data&quot;&gt;
                        &lt;div class=&quot;form-group&quot;&gt;
                            &lt;input type=&quot;file&quot; id=&quot;upload&quot; name=&quot;upload&quot;&gt;
                            &lt;input type=&quot;submit&quot; value=&quot;Post It!&quot; class=&quot;btn btn-primary col-md-offset-1&quot;&gt;
                        &lt;/div&gt; 
                    &lt;/form&gt;
                &lt;/div&gt;
                &lt;div class=&quot;row&quot;&gt;
                    &lt;?php
                        require_once &quot;php/db_connect.php&quot;;
                        require_once &quot;php/functions.php&quot;;
                        echo getPostcards($db);
                     ?&gt;
                &lt;/div&gt;     
            &lt;/div&gt;
        &lt;/div&gt;
                </pre>
            </code>
            <p class="flow-text">
            This connects to the mysql
            </p>
            <code>
                <pre>
                    &lt;?php 
// Do not change the following two lines.
$teamURL = dirname($_SERVER[&#39;PHP_SELF&#39;]) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER[&#39;PHP_SELF&#39;]);

// You will need to require this file in EVERY php file that uses the database.
// Be sure to use $db-&gt;close(); at the end of each php file that includes this!

$dbhost = &quot;localhost&quot;; // Most likely will not need to be changed
$dbname = &quot;********&quot;; // needs to be changed to your designated table name
$dbuser = &quot;************&quot;; // needs to be changed to reflect LAMP server credentials
$dbpass = &quot;*******************&quot;; // needs to be changed to reflect LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db-&gt;connect_errno &gt; 0)
{
    die(&#39;Unable to connect to database [&#39; . $db-&gt;connect_error . &#39;]&#39;);
}
?&gt;
                 </pre>
            </code>
            <p class="flow-text">
            This contains all the functions related to storing the file. The timing, accessing the specifics of the database, as well as the output 
            </p>
            <code>
                <pre>
                &lt;?php
function nicetime($time)
{
    if(empty($time)) {
        return &quot;No date provided&quot;;
    }
    
    $periods         = array(&quot;second&quot;, &quot;minute&quot;, &quot;hour&quot;, &quot;day&quot;, &quot;week&quot;, &quot;month&quot;, &quot;year&quot;, &quot;decade&quot;);
    $lengths         = array(&quot;60&quot;,&quot;60&quot;,&quot;24&quot;,&quot;7&quot;,&quot;4.35&quot;,&quot;12&quot;,&quot;10&quot;);
    
    $now             = time();
    $unix_date         = $time;
    
       // check validity of date
    if(empty($unix_date)) {    
        return &quot;Bad date&quot;;
    }

    // is it future date or past date
    if($now &gt; $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = &quot;ago&quot;;
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = &quot;from now&quot;;
    }
    
    for($j = 0; $difference &gt;= $lengths[$j] &amp;&amp; $j &lt; count($lengths)-1; $j  ) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= &quot;s&quot;;
    }
    
    return &quot;$difference $periods[$j] {$tense}&quot;;
}

$date = &quot;2009-03-04 17:45&quot;;
$result = nicetime($time); // 2 days ago

?&gt;
&lt;?php
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
	if (!($stmt = $_db-&gt;prepare(&quot;INSERT INTO POSTCARDS(TIME_STAMP, IMAGE_NAME) VALUES (?, ?)&quot;)))
	{
		echo &quot;Prepare failed: (&quot; . $_db-&gt;errno . &quot;) &quot; . $_db-&gt;error;
	}

	/* Prepared statement, stage 2: bind parameters*/
	if (!$stmt-&gt;bind_param(&#39;ss&#39;,  $_time, $_file_name))
	{
		echo &quot;Binding parameters failed: (&quot; . $stmt-&gt;errno . &quot;) &quot; . $stmt-&gt;error;
	}

	/* Prepared statement, stage 3: execute*/
	if (!$stmt-&gt;execute())
	{
		
	}
}


function getPostcards($_db)
{
    $query = &quot;SELECT TIME_STAMP, IMAGE_NAME FROM POSTCARDS ORDER BY TIME_STAMP DESC&quot;;
    
    if(!$result = $_db-&gt;query($query))
    {
        die(&#39;There was an error running the query [&#39; . $_db-&gt;error . &#39;]&#39;);
    }
    
    $output = &#39;&#39;;
    
    while($row = $result-&gt;fetch_assoc())
    {
        $output = $output . &#39;&lt;div class=&quot;col s6&quot;&gt;&#39;.&#39;&lt;div class=&quot;card-panel teal&quot;&gt;&#39; 
                                    
        . &#39;&lt;span class=&quot;white-text&quot;&gt;&lt;a href=&quot;&#39; .&#39;http://lamp.cse.fau.edu/~lolsthoorn2014/p5/users/&#39; . $row[&#39;IMAGE_NAME&#39;] . &#39;&quot;&gt;&#39;. $row[&#39;IMAGE_NAME&#39;] .&#39;&lt;/a&gt;&lt;/span&gt;&#39; .&#39;&lt;br&gt;&#39; 
            .&#39;&lt;a&gt;&lt;small style=&quot;color:white;&quot;&gt;- &#39;.nicetime($row[&#39;TIME_STAMP&#39;]).&#39;&lt;/small&gt;&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&#39; ;
    }
    
    return $output;
}
?&gt;

                </pre>
            </code>
        </div>

		<div id="test1" class="col s12">
            <?php
            require_once "php/db_connect.php";
            require_once "php/functions.php";
            $name = sanitizeString($db, $_POST['name']);
            $time = $_SERVER['REQUEST_TIME'];
            $file_name = $_FILES['upload']['name'];
            if ($_FILES)
            {
                $tmp_name = $_FILES['upload']['name'];
                $dstFolder = 'users';
                move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $_FILES['upload']['name']);
                //echo "Uploaded image '$file_name'<br /><img src='$dstFolder/$file_name'/>";
            }
            SavePostToDB($db, $time, $file_name);
            ?>
            <div>      
                <div id="formParent" class="col-md-6 col-md-offset-3">
                    <form id="form" class="form-horizontal" method="POST" action="storage.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" id="upload" name="upload">
                            <input type="submit" value="Post It!" class="btn btn-primary col-md-offset-1">
                        </div> 
                    </form>
                </div>
                <div class="row">
                    <?php
                        require_once "php/db_connect.php";
                        require_once "php/functions.php";
                        echo getPostcards($db);
                     ?>
                </div>     
            </div>
        </div>
	<!-- JavaScript placed at bottom for faster page loadtimes. -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	
	<script src="functions.js"></script>
    <script src="js/bin/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/prism.js"></script>
            <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>
</body>

</html>
