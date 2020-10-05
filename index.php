<?php
    $weather  = '';
    $weatherArray = '';
    $urlContents = '';
    $tempo = '';
    $error= '';

error_reporting(E_ERROR | E_PARSE);//to avoid warnings

    if(isset($_GET['city'])){

        $urlContents= file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=590b4883a015e424e619b2ba2cbfe63e");
       
        
       $weatherArray = json_decode($urlContents,true);
        
       if($weatherArray['cod'] == 200)
       {
            $tempo = intval($weatherArray['main']['temp'] - 273);

           $weather = "The weather in ".$_GET['city']." is currently  ' ".$weatherArray['weather'][0]['description']." '.<br>The temperature is ".$tempo."&#8451 and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
        }
        else{
             $error="Entered city is invalid";
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Weather Scrapper</title>
      
      <style>
      
          body{
              background-image: url(kees-streefkerk-Adl90-aXYwA-unsplash.jpg);
          }
      
          .container{
              text-align: center;
              margin-top: 100px;
              width: 450px;
          }
          
          input{
              margin: 20px;
          }
          #weather{
           margin-top: 15px;   
          }
      </style>
  </head>
  <body>
  
      
      <div class="container">
      
        <h1>What's the weather?</h1>
          
          
          <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Enter the name of city</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Eg.  Delhi, London" name="city">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
       
          <div id="weather"><?php
              if($weather){
                  echo '<div class="alert alert-success" role="alert">'.
  $weather.
'</div>';}
                  elseif($error)
                  {
                      echo '<div class="alert alert-danger" role="alert">'.$error.'
</div>';
                  }
                  
              
              
              ?>
          </div>
          
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>