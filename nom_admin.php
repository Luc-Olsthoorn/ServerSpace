
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
            <!--<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>-->
        </div>
    </nav>
      
<div class="container" > 
    <h2 class="header">NOM</h2> 
    <div class="row">       

        <div class="col s12">
            <div>      
                <div id="formParent" class="col-md-6 col-md-offset-3">
                    <form id="form" class="form-horizontal" method="POST" action="nom_admin.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <h5>Access Code</h5>
                            <input type="number" id="input_code" name="input_code">
                            <input type="submit" value="Submit"  class="btn btn-primary col-md-offset-1">
                            
                        </div> 
                    </form>
                </div>
                    <h5>Count:</h5>
                    <h3>
                    <?php
                        require_once "php/db_connect.php";
                        require_once "php/nombackend.php";
                        
                        echo display($db);
                        echo item($db);
                    ?>
                    </h3>
                 <div class="row">
                    <div class="col s6">
                        <div>
                            <h5>Service</h5>
                        </div>
                    </div>
                    <div class="col s3">
                        <h5>How many to order</h5>
                    </div>
                    <div class="col s3">
                        <h5>How much will it cost you</h5>
                    </div>
                </div>
                    <?php
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
