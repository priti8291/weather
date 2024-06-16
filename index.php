<?php
$status="";
$msg="";
$city="";
if(isset($_POST['submit'])){
  $city=$_POST['city'];
$url="https://api.openweathermap.org/data/2.5/weather?q=$city&appid=822fb91ea7cc0eeb5527c8e2d80fa7ea";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($ch);
curl_close($ch);

$result=json_decode($result,true);

if($result['cod']==200){
  $status="yes";
}
else{
  $msg=$result['message'];
}

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <style>
    body {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        background-color: #d9b0ff;
      }
     .card-body{
        height: 200px;
     }
     .b{
        padding-top: 1rem;
        text-align: center;
        background-color: #ff90c7;
        
     }
     .b1{
        background-color: #ff73b9;
     }
     .card .weather-icon {
  max-width: 100px;
  max-height: 100px;
}

     @media(max-width:575px)
     {
        .b{
            flex: 0 0 25%;
            max-width: 25%;
        }
     }
    </style>
  </head>
  <body>
    <div class="mt-5">
      <form class="row justify-content-center" method="post">
        <div class="col-md-6">
          <div class="input-group mb-1">
            <input type="text" class="form-control" placeholder="Enter City Name" aria-label="Recipient's username" name="city"
            aria-describedby="basic-addon2" value="<?php echo $city?>"/>
            <button type="submit" class="btn" id="basic-addon2" name="submit" style="background-color: #ff90c7">
              Submit
            </button>
          </div>
        </div>
       </form>
       <div class="row justify-content-center fs-1 text-capitalize">
      <?php echo $msg;?>
       </div>
     
      </div>
      
      <?php if($status=="yes"){?>
      <div class="row justify-content-center">
        <div class="col-md-6 ">
      <div class="card" style="border-radius: 20px;">
      <div class="card-body d-flex justify-content-center align-items-center">
       <img src="https://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@2x.png" alt="" class="card-img-top weather-icon"/> 

      </div>

       
        <div class="card-title">
        <div class="d-flex">
            <div class="col-md-3 col-sm-3 col-lg-3 b b1 rounded-start"><h1><?php echo round($result['main']['temp']-273.15)?><sup>o</sup>C</h1>
          <h4><?php echo $result['sys']['country']?></h4></div>
            <div class="col-md-3 col-sm-3 col-lg-3 b"><h4><?php echo $result['weather'][0]['main']?></h4><p><?php echo $result['name']?></p></div>
            <div class="col-md-3 col-sm-3 col-lg-3 b"><h4>WIND</h4><p><?php echo $result['wind']['speed']?></p></div>
            <div class="col-md-3  col-sm-3 col-lg-3 b b1 rounded-end"><h2><?php echo date('d M',$result['dt'])?></h2></div>
        </div>
      </div></div>
        </div>
      </div>
    <?php }?>
  </body>
</html>
