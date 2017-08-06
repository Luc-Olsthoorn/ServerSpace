
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Luc Olsthoorn</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class = "parallax-demo">    
  <nav class ="blue"style=" z-index: 2;box-shadow: none;">
    <div class="nav-wrapper">
      <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom.html">Home</a></li>
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom_new.php">Create new</a></li>
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom_admin.php">View your Noms</a></li>
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom_users.php">Enter your Code</a></li>
      </ul>
      <ul id="slide-out" class="side-nav">
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom.html">Home</a></li>
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom_new.php">Create new</a></li>
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom_admin.php">View your Noms</a></li>
        <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/nom_users.php">Enter your Code</a></li>
      </ul>
    </div>
  </nav>
      
  <div class="container" > 
    <h2 class="header">NOM</h2> 
      <div class="row">       
		    <div class="col s12">
          <div>      
                    <?php
                        require_once "php/db_connect.php";
                        require_once "php/nombackend.php";
                        $type = $_POST["type"];
                        if(is_null($type))
                        {
                            ?>
                           
                          <div id="formParent" class="col-md-6 col-md-offset-3">
                            <div class="row">
                              <h3>Please select your food options</h3>
                              <form id="form" class="form-horizontal" method="POST" action="nom_new.php" enctype="multipart/form-data">
                                <div class="form-group">
                                  <?php
                                    echo options($db);
                                  ?>
                                  
                                  <div class="col m12">
                                    <span class= "col m1">
                                     <input  type="radio" id="0" Name="type" value="other"/>
                                     <label for="0">Other</label>
                                    </span>
                                    <span class= "col m11">
                                      <input id="Other" type="text"  name="input_other">
                                    </span>
                                  </div>
                                  <h4>Enter the maximum allowed</h4>
                                  <input type="number" id="input_max" name="input_max">
                                  <div>
                                    <input type="submit" value="Submit" class="btn btn-primary col-md-offset-1" >
                                  </div>
                                </div> 
                              </form>
                            </div>
                          </div>
                        <?php
                        }
                        else{
                        $code = select($db);
                        $short_url = get_bitly_short_url('http://lamp.cse.fau.edu/~lolsthoorn2014/nom_users.php?k='.$code,'lucols97','R_caf88a88160548fa92c81057c6692f96');
                        //$short = make_bitly_url('http://lamp.cse.fau.edu/~lolsthoorn2014/nom_users.php?k='.$code,'lucols97','2e7746ab49e874caeb1b54994348feb9384bc3c0','json');
                        echo '<div class="col s12 m6"><h3>URL:</h3><h1>'.$short_url.'</h1></div>'; 
                        echo '<div class="col s12 m6" style="text-align:right;"><h3>Your Code is </h3><h1>'.$code .'</h1></div>';
                     
                      }
                     ?>
                    
             
                    
                </div>    
            </div>
        </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="functions.js"></script>
  <script src="js/bin/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/prism.js"></script>
  <script src="js/agency.js"></script>
</body>
</html>
