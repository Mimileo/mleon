<?php

$backgroundImage = "img/sea.jpg";

// API call goes here

if (isset($_GET['keyword'])) { //checks if the URL has a parameter called "keyword"
    //echo "You searched for: " . $_GET['keyword'];
    // check if category
    include 'api/pixabayAPI.php';
    
    $keyword = $_GET['keyword'];
    
    if(!empty($_GET['category'])) { // user selected a category
    $keyword = $_GET['category'];
    
    }
    if(isset($_GET['layout'])) {
    $imageURLs = getImageURLs($keyword, $_GET['layout']);
    }else{
   // print_r($imageURLs);
    $imageURLs = getImageURLs($keyword);
    }
     $backgroundImage = $imageURLs[array_rand($imageURLs)];
} 

function checkIfSelected($option){
    if ($option == $_GET['category']) {
            
            return "selected";
            
        }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Pixabay Carousel </title>
         <meta charset="utf-8">
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
           @import url("css/styles.css");
           
           body {
               
               background-image: url(<?=$backgroundImage?>);
               background-size: 100% 100%;
               background-attachment:fixed;
               
           }
           
         </style>
    </head>
    <body>
        <br /><br />
        <!-- html form goes here -->
        <form>
              <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
        
            <div id="rgroup">
            <input type="radio" id="lhorizontal" name="layout" value="horizontal" <?= ($_GET['layout']=='horizontal') ? "checked" : "" ?> >
            
            <label for="lhorizontal"> Horizontal</label>
            <br/>

            <input type="radio"id="lvertical" name="layout" value="vertical" <?= ($_GET['layout']=='vertical') ? "checked" : "" ?> >
            <label for="lvertical"> Vertical</label>
            </div>
            <br/>
            
            <select name="category">
                <option value=""> - Select One - </option>
                <option <?=checkIfSelected('ocean')?> value="ocean">Sea</option>
                <option <?=checkIfSelected('forest')?>  value="forest">Forest</option>
                <option <?=checkIfSelected('mountain')?> value="mountain">Mountain</option>
                 <option <?=checkIfSelected('parrot')?> value="parrot">Parrot</option>
                  <option <?=checkIfSelected('sushi')?> value="sushi">Sushi</option>
            </select>
          <br/>
            <input id="submit-btn" type="submit" value="Search" />
            
        </form>
     

         <br /><br />
         <?php
            if(!isset($_GET['keyword'])) { // form has not been submitted
                echo "<h2> Type a keyword to display a slideshow 
        with random images from Pixabay.com</h2>";
            }else { // form has been submitted
                 
            if(empty($_GET['keyword']) && empty($_GET['category']) ) {
            echo "<h2 style='color:red;'> Error! You must enter a keyword or category </h2>";
            return;
            exit;
        }
        
         
         ?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators here -->
        <ol class="carousel-indicators">
        <?php
             for($i=0;$i <7;$i++){
                echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                echo ($i == 0) ? " class='active'": "";
                echo "></li>";
             }
          ?>
          </ol>
        <!-- Wrapper for Images -->
        <div class="carousel-inner" role="listbox">
            <?php
            //if(!isset($imageURLs)){
             //   echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
           // } else {
            // Display Carasoul here
                for($i=0;$i<7;$i++){
                    do {
                        $randomIndex = rand(0,count($imageURLs));
                    } while(!isset($imageURLs[$randomIndex]));
                    echo '<div class="item ';
                    echo ($i == 0) ? "active" : "";
                    echo '">';
                    echo '<img src="' . $imageURLs[$randomIndex] . '" width="700" >';
                    echo '</div>';
                    unset($imageURLs[$randomIndex]);
                }
        
            ?>
        </div>
        <!-- controls here -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
        <!--<h1> reg h1 tag statemnet </h1>-->
        <?php
        } // end of else statemnet
        ?>
        <br>
        


               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>     

    </body>
</html>