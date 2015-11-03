<!DOCTYPE html>
<html ng-app="svgImageTest">
<head>
   <style>

#clock-container { 
  display: inline-block;
  position: relative;
  width: 100%;
  padding-bottom: 100%;
  vertical-align: middle;
  overflow: hidden;
 
} 
#face { stroke-width: 2px; stroke: #fff; }
#hour, #min, #sec { 
  stroke-width: 1px;
  fill: #ffffff;
  stroke: #fff9f9;
}
#sec { stroke: #f55; }
    </style>  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Luc Olsthoorn</title>

    
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
                    </ul>
                </li>
            </ul>
            <ul id="slide-out" class="side-nav">
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/index.html">Home</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/portfolio.html">Resume</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/storage.php">Storage</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/clockify.html">Clockify</a></li>
                <li><a href="http://lamp.cse.fau.edu/~lolsthoorn2014/math.html">Calculator</a></li>
            </ul>
            <!--<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>-->
        </div>
    </nav>
      
<div class="container" > 
    <h2 class="header">CLOCKIFY</h2> 
      <div class="row">
        <ul class="tabs">
          <li class="tab col s3"><a class="active" href="#test1">Clockify</a></li>
          <li class="tab col s3"><a  href="#test2">Code</a></li>
        </ul>
      </div>
            <div id="test2" class="col s12">
            
            <div>
            <h5>CLOCKIFY is a simple HTML5 JavaScript clock which allows you to use any image you choose for the face of the clock</h5>
            </div>
           
            <h5>
            I used a pizza for this example
            
            Let’s break the code down down:
            </h5>
            <p class="flow-text">
            The svg circle command fills a circle with a pattern, in this case an image which we converted to a pattern. To change the image just change "img/pizza.jpg" to whichever background you choose
            </p>
            <code style="background-color:grey;">
                <pre>
                &lt;div id=&quot;clock-container&quot;&gt;
             &lt;svg id=&quot;clock&quot; viewBox=&quot;0 0 100 100&quot;&gt;
              &lt;defs&gt;
                &lt;pattern id=&quot;image&quot; patternUnits=&quot;userSpaceOnUse&quot; height=&quot;100&quot; width=&quot;100&quot;&gt;
                  &lt;image x=&quot;0&quot; y=&quot;0&quot; height=&quot;100&quot; width=&quot;100&quot; xlink:href=&quot;img/pizza.jpg&quot;&gt;&lt;/image&gt;
                &lt;/pattern&gt;
              &lt;/defs&gt;
              &lt;circle id=&#39;top&#39; cx=&quot;50&quot; cy=&quot;50&quot; r=&quot;45&quot; fill=&quot;url(#image)&quot;/&gt;
              </pre>
            </code>
            <p class="flow-text">
            Here we create the hands of the clock.
            </p>
            <code>
                <pre>
              &lt;g id=&quot;hands&quot;&gt;
                &lt;rect id=&quot;hour&quot; x=&quot;47.5&quot; y=&quot;12.5&quot; width=&quot;5&quot; height=&quot;40&quot; rx=&quot;2.5&quot; ry=&quot;2.55&quot; /&gt;
                &lt;rect id=&quot;min&quot; x=&quot;48.5&quot; y=&quot;12.5&quot; width=&quot;3&quot; height=&quot;40&quot; rx=&quot;2&quot; ry=&quot;2&quot;/&gt;
                &lt;line id=&quot;sec&quot; x1=&quot;50&quot; y1=&quot;50&quot; x2=&quot;50&quot; y2=&quot;16&quot; /&gt;
              &lt;/g&gt;
            &lt;/svg&gt;
            &lt;/div&gt;
                </pre>
            </code>
            <p class="flow-text">
            Here is the javascript to create the moving clock
            </p>

            <code>
                <pre>
              &lt;script&gt;
                   setInterval(function() {
              function r(el, deg) {
                el.setAttribute(&#39;transform&#39;, &#39;rotate(&#39;  deg  &#39; 50 50)&#39;)
              }
              var d = new Date()
              r(sec, 6*d.getSeconds())  
              r(min, 6*d.getMinutes())
              r(hour, 30*(d.getHours()%12)   d.getMinutes()/2)
            }, 1000)
                &lt;/script&gt; 
                    </pre>
            </code>
            <p class="flow-text">
            Here is the css behind the clock
            </p>
           
            <code>
                <pre>
                &lt;style&gt;

                #clock-container { 
                  display: inline-block;
                  position: relative;
                  width: 100%;
                  padding-bottom: 100%;
                  vertical-align: middle;
                  overflow: hidden;

                } 
                #face { stroke-width: 2px; stroke: #fff; }
                #hour, #min, #sec { 
                  stroke-width: 1px;
                  fill: #ffffff;
                  stroke: #fff9f9;
                }
                #sec { stroke: #f55; }
                    &lt;/style&gt;
                </pre>
            </code>
            <p class="flow-text">
            All together for your copying and pasting pleasure
            </p>
           
            <code>
                <pre>
                &lt;div id=&quot;clock-container&quot;&gt;
             &lt;svg id=&quot;clock&quot; viewBox=&quot;0 0 100 100&quot;&gt;
              &lt;defs&gt;
                &lt;pattern id=&quot;image&quot; patternUnits=&quot;userSpaceOnUse&quot; height=&quot;100&quot; width=&quot;100&quot;&gt;
                  &lt;image x=&quot;0&quot; y=&quot;0&quot; height=&quot;100&quot; width=&quot;100&quot; xlink:href=&quot;img/pizza.jpg&quot;&gt;&lt;/image&gt;
                &lt;/pattern&gt;
              &lt;/defs&gt;
              &lt;circle id=&#39;top&#39; cx=&quot;50&quot; cy=&quot;50&quot; r=&quot;45&quot; fill=&quot;url(#image)&quot;/&gt;
               &lt;g id=&quot;hands&quot;&gt;
                &lt;rect id=&quot;hour&quot; x=&quot;47.5&quot; y=&quot;12.5&quot; width=&quot;5&quot; height=&quot;40&quot; rx=&quot;2.5&quot; ry=&quot;2.55&quot; /&gt;
                &lt;rect id=&quot;min&quot; x=&quot;48.5&quot; y=&quot;12.5&quot; width=&quot;3&quot; height=&quot;40&quot; rx=&quot;2&quot; ry=&quot;2&quot;/&gt;
                &lt;line id=&quot;sec&quot; x1=&quot;50&quot; y1=&quot;50&quot; x2=&quot;50&quot; y2=&quot;16&quot; /&gt;
              &lt;/g&gt;
            &lt;/svg&gt;
            &lt;/div&gt;
             &lt;script&gt;
                   setInterval(function() {
              function r(el, deg) {
                el.setAttribute(&#39;transform&#39;, &#39;rotate(&#39;  deg  &#39; 50 50)&#39;)
              }
              var d = new Date()
              r(sec, 6*d.getSeconds())  
              r(min, 6*d.getMinutes())
              r(hour, 30*(d.getHours()%12)   d.getMinutes()/2)
            }, 1000)
            &lt;style&gt;

                #clock-container { 
                  display: inline-block;
                  position: relative;
                  width: 100%;
                  padding-bottom: 100%;
                  vertical-align: middle;
                  overflow: hidden;

                } 
                #face { stroke-width: 2px; stroke: #fff; }
                #hour, #min, #sec { 
                  stroke-width: 1px;
                  fill: #ffffff;
                  stroke: #fff9f9;
                }
                #sec { stroke: #f55; }
                    &lt;/style&gt;
                &lt;/script&gt; 
                </pre>
            </code>
    </div>
    <div id="test1" class="col s12">
        
        <div id="clock-container">
            <svg id="clock" viewBox="0 0 100 100">
              <defs>
                <pattern id="image" patternUnits="userSpaceOnUse" height="100" width="100">
                  <image x="0" y="0" height="100" width="100" xlink:href="img/pizza.jpg"></image>
                </pattern>
              </defs>
              <circle id='top' cx="50" cy="50" r="45" fill="url(#image)"/>

              <g id="hands">
                <rect id="hour" x="47.5" y="12.5" width="5" height="40" rx="2.5" ry="2.55" />
                <rect id="min" x="48.5" y="12.5" width="3" height="40" rx="2" ry="2"/>
                <line id="sec" x1="50" y1="50" x2="50" y2="16" />
              </g>
            </svg>
            </div>
                <script>
                    setInterval(function() 
                        {
                          function r(el, deg) 
                          {
                            el.setAttribute('transform', 'rotate('+ deg +' 50 50)')
                          }
                          var d = new Date()
                          r(sec, 6*d.getSeconds())  
                          r(min, 6*d.getMinutes())
                          r(hour, 30*(d.getHours()%12) + d.getMinutes()/2)
                        }, 1000)
                </script>
        </div>
    </div>
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
     <!-- jQuery -->
    <script src="js/jquery.js"></script>

  

    <!-- Plugin JavaScript -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/bin/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/prism.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.1/angular.min.js"></script>

 

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>


</body>       