<?php

function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}

function addAmount($_db)
    {
    $codein = $_POST["precode"];
    $amountin = $_POST["input_amount"];
    $query = "UPDATE nom_users SET amount = $amountin+amount WHERE code= $codein";
    if(!$result = $_db->query($query))
    {
        //die('There was an error running the query [' . $_db->error . ']');
    }
    
}

function getItem($_db)
    {
    
    $codein = $_GET['k'];
    
    $query = "SELECT amount, item, code, url FROM nom_users ";
    if(!$result = $_db->query($query))
    {
        //die('There was an error running the query [' . $_db->error . ']');
    }

    while($row = $result->fetch_assoc())
        {
          
            if($codein==$row["code"])
            {
                return $row["item"];
            }
            
        }
    
}
function MAXI($_db)
{
    $codein = $_GET['k'];
    
    $query = "SELECT amount, item, code, url FROM nom_users ";
    if(!$result = $_db->query($query))
    {
        //die('There was an error running the query [' . $_db->error . ']');
    }

    while($row = $result->fetch_assoc())
        {
          
            if($codein==$row["code"])
            {
                return $row["url"];
            }
            
        }
}

function display($_db)
    {
        
        
        $in_code=$_POST["input_code"];
        $query = "SELECT amount, item, code, url FROM nom_users ";
        
        if(!$result = $_db->query($query))
        {
            die('There was an error running the query [' . $_db->error . ']');
        }
       

        while($row = $result->fetch_assoc())
        {
          
            if($in_code==$row["code"])
            {
                return $row["amount"];
            }
            
        }
}    
function item($_db)
{
    $in_code=$_POST["input_code"];
        $query = "SELECT amount, item, code, url FROM nom_users ";
        
        if(!$result = $_db->query($query))
        {
            die('There was an error running the query [' . $_db->error . ']');
        }
       

        while($row = $result->fetch_assoc())
        {
          
            if($in_code==$row["code"])
            {
                return $row["item"];
            }
            
        }
    
}
function select($_db){
    $codein = rand ( 0 , 99999 );
    $itemin = $_POST["type"];
    $maxin = $_POST["input_max"];
    if($_POST["type"]=="other")
    {
        $itemin = $_POST["input_other"];
    }
    $query = "INSERT INTO nom_users (amount, item, code, url)
    VALUES ('0', '$itemin', '$codein','$maxin')";
    if(!$result = $_db->query($query))
        {
            die('There was an error running the query [' . $_db->error . ']');
        }
    return $codein;
    
}

function options($_db){
   
    $query = "SELECT name, item_price, image, link, description, SPI, unit_price FROM nom ORDER BY unit_price DESC";
    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }
    
    $output = '';
    $i='1';
    while($row = $result->fetch_assoc())
    {
                $output=$output.'<div><input type="radio" id="'
                                        .$i
                                        .'"Name="type"value="'
                                        . $row['name']
                                        .'"/><label for="'
                                        .$i
                                        .'">'
                                        . $row['name']
                                        .'</label></div>';


        $i++;
                                   
    }
    
    return $output;
}


    /* make a URL small */
function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
{
    //create the URL
    $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
    
    //get the url
    //could also use cURL here
    $response = file_get_contents($bitly);
    
    //parse depending on desired format
    if(strtolower($format) == 'json')
    {
        $json = @json_decode($response,true);
        return $json['results'][$url]['shortUrl'];
    }
    else //xml
    {
        $xml = simplexml_load_string($response);
        return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
    }
}


function getPostcards($_db)
{
    $input = display($_db);
    $item = item($_db);
    $query = "SELECT name, item_price, image, link, description, SPI, unit_price FROM nom ORDER BY unit_price DESC";
    
    
    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }
    
    $output = '';
    $selected ='';
    
    while($row = $result->fetch_assoc())
    {
        
        $order = $row['SPI'] * $input;
        $order = round($order,0);
        $price = $order * $row["item_price"];
        if($row['name']==$item){
            $selected = '<div class = "row">'
                            .'<div class="col s6 ">'
                                .'<div class="card">'
                                    .'<div class="card-image waves-effect waves-block waves-light">'
                                      .'<img class="activator" src="'
                                        .$row['image']
                                      .'"> 
                                    </div>
                                    <div class="card-content">
                                      <span class="card-title activator grey-text text-darken-4">'
                                      . $row['name']
                                      .'<i class="material-icons right">more_vert</i></span>
                                      <p><a href="'
                                        . $row['link'] 
                                      .'">'
                                        . $row['name']
                                      .'</a></p>
                                    </div>
                                    <div class="card-reveal">
                                      <span class="card-title grey-text text-darken-4">'
                                        . $row['name']
                                        .'<i class="material-icons right">close</i></span>
                                      <p>'
                                      . $row['description'] 
                                      
                                      .'</p>
                                    </div>
                                </div>
                            </div>
                            <div class = "col s3">
                                    <div class="card" style="padding:10px; text-align:center;">
                                        <h2 style="line-height: 0.5;">'
                                        .$order
                                        .'</h2>
                                    </div>
                            </div>
                            <div class = "col s3">
                                    <div class="card" style="padding:10px; text-align:center;">
                                        <h2 style="line-height: 0.5;">'
                                        .$price
                                        .'</h2>
                                    </div>
                            </div>

                        </div>';
        }
        else{
        $output=$output.'<div class = "row">'
                            .'<div class="col s6 ">'
                                .'<div class="card">'
                                    .'<div class="card-image waves-effect waves-block waves-light">'
                                      .'<img class="activator" src="'
                                        .$row['image']
                                      .'"> 
                                    </div>
                                    <div class="card-content">
                                      <span class="card-title activator grey-text text-darken-4">'
                                      . $row['name']
                                      .'<i class="material-icons right">more_vert</i></span>
                                      <p><a href="'
                                        . $row['link'] 
                                      .'">'
                                        . $row['name']
                                      .'</a></p>
                                    </div>
                                    <div class="card-reveal">
                                      <span class="card-title grey-text text-darken-4">'
                                        . $row['name']
                                        .'<i class="material-icons right">close</i></span>
                                      <p>'
                                      . $row['description'] 
                                      
                                      .'</p>
                                    </div>
                                </div>
                            </div>
                            <div class = "col s3">
                                    <div class="card" style="padding:10px; text-align:center;">
                                        <h2 style="line-height: 0.5;">'
                                        .$order
                                        .'</h2>
                                    </div>
                            </div>
                            <div class = "col s3">
                                    <div class="card" style="padding:10px; text-align:center;">
                                        <h2 style="line-height: 0.5;">'
                                        .$price
                                        .'</h2>
                                    </div>
                            </div>

                        </div>';
                    }
    }
    
    return $selected . $output;
}
?>
