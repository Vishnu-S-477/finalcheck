<?php 
session_start();
ob_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../php_upload/upload.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}

// storage for error ackno
$pgerrorpgfor = !empty($_SESSION['errorpgforpg']) ? $_SESSION['errorpgforpg'] : '';
$pgerrorfurnish = !empty($_SESSION['errorfurnishpg']) ? $_SESSION['errorfurnishpg'] : '';
$pgerrorroomtype = !empty($_SESSION['errorroomtypepg']) ? $_SESSION['errorroomtypepg'] : '';
$pgerrorpreferred = !empty($_SESSION['errorpreferredpg']) ? $_SESSION['errorpreferredpg'] : '';
$pgerrorfood = !empty($_SESSION['errorfoodpg']) ? $_SESSION['errorfoodpg'] : '';
$pgerrormetro = !empty($_SESSION['errormetropg']) ? $_SESSION['errormetropg'] : '';
$pgerrorparking = !empty($_SESSION['errorparkingpg']) ? $_SESSION['errorparkingpg'] : '';
$pgerrorbathroom = !empty($_SESSION['errorbathroompg']) ? $_SESSION['errorbathroompg'] : '';

// storage for error ackno

// storage for error FlatHouse ackno
$fmerrorroom = !empty($_SESSION['fmerrorroom']) ? $_SESSION['fmerrorroom'] : '';
$fmerrorallowedtenant = !empty($_SESSION['fmerrorallowedtenant']) ? $_SESSION['fmerrorallowedtenant'] : '';
$fmerrorfurnish = !empty($_SESSION['fmerrorfurnish']) ? $_SESSION['fmerrorfurnish'] : '';
$fmerrorproperty = !empty($_SESSION['fmerrorproperty']) ? $_SESSION['fmerrorproperty'] : '';
$fmerrorfood = !empty($_SESSION['fmerrorfood']) ? $_SESSION['fmerrorfood'] : '';
$fmerrorfloor = !empty($_SESSION['fmerrorfloor']) ? $_SESSION['fmerrorfloor'] : '';
$fmerrorparking = !empty($_SESSION['fmerrorparking']) ? $_SESSION['fmerrorparking'] : '';
$fmerrormetro = !empty($_SESSION['fmerrormetro']) ? $_SESSION['fmerrormetro'] : '';
$fmerrorbathroom = !empty($_SESSION['fmerrorbathroom']) ? $_SESSION['fmerrorbathroom'] : '';

// storage for error FlathOuse ackno

// storage for error ackno Full house
$fherrorhouse = !empty($_SESSION['fherrorhouse']) ? $_SESSION['fherrorhouse'] : '';
$fherroravailable = !empty($_SESSION['fherroravailable']) ?  $_SESSION['fherroravailable'] : '';
$fherrorperferred = !empty($_SESSION['fherrorperferred']) ? $_SESSION['fherrorperferred'] : '';
$fherrorproperty = !empty($_SESSION['fherrorproperty']) ? $_SESSION['fherrorproperty'] : '';
$fherrorfurnish = !empty($_SESSION['fherrorfurnish']) ? $_SESSION['fherrorfurnish'] : '';
$fherrorparking = !empty($_SESSION['fherrorparking']) ? $_SESSION['fherrorparking'] : '';
$fherrormetro = !empty($_SESSION['fherrormetro']) ? $_SESSION['fherrormetro'] : '';

// storage for error ackno Full house 

$city = '';
$area = '';
$address = '';
$rentrate = '';
$deposit = '';
$sqft = '';
$modeofhouse = '';
$roomtype = '';
$houseavailable = '';
$houseprefertenants = '';
$propertytype = '';
$furnish = '';
$parking = '';
$metro = '';
$bathroomfacility = '';
$pgfor = '';
$allowedtenant = '';
$allowedfood = '';
$floor = '';
$pgroomtype = '';
$housetype = '';
$errormessage = $_SESSION['errormessage'] ?? '';
$errorhouse = $_SESSION['optionpick'] ?? '';
$pgpreferred = '';
$pgfood = '';

if (isset($_SESSION['databackup'])) {
    $city = $_SESSION['databackup']['city'] ?? '';
    $area = $_SESSION['databackup']['area'] ?? '';
    $address = $_SESSION['databackup']['address'] ?? '';
    $rentrate = $_SESSION['databackup']['rentrate'] ?? '';
    $deposit = $_SESSION['databackup']['deposit'] ?? '';
    $sqft = $_SESSION['databackup']['sqft'] ?? '';
    $modeofhouse = $_SESSION['databackup']['modeofhouse'] ?? '';
    $houseavailable = $_SESSION['databackup']['houseavailable'] ?? '';
    $houseprefertenants = $_SESSION['databackup']['preferredtenates'] ?? ''; // for pg it is actually correct but name  not make scence
    $propertytype = $_SESSION['databackup']['propertytype'] ?? '';
    $furnish = $_SESSION['databackup']['furnish'] ?? '';
    $parking = $_SESSION['databackup']['parkingstatus'] ?? '';
    $metro = $_SESSION['databackup']['metro'] ?? '';
    $bathroomfacility = $_SESSION['databackup']['bathroom'] ?? '';
    $allowedtenant = $_SESSION['databackup']['allowedtenant'] ?? '';
    $allowedfood = $_SESSION['databackup']['allowedfood'] ?? '';//flat
    $floor = $_SESSION['databackup']['floor'] ?? '';//flat
    $roomtype = $_SESSION['databackup']['roomtype'] ?? ''; // flat
    $pgroomtype = $_SESSION['databackup']['pgroomtype'] ?? '';
    $housetype = $_SESSION['databackup']['housetype'] ?? '';
    $pgpreferred = $_SESSION['databackup']['preferpg'] ?? ''; // pg
    $pgfood = $_SESSION['databackup']['foodpg'] ?? '';
}    

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

session_unset();

 $_SESSION['userid'] = $userid ;
 $_SESSION['username'] = $username;
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Form</title>
    <link rel=stylesheet href="../css_upload/upload.css">
    <style>
        body{
            padding-top:65px;
        }
        .Pg-container{
            display: none;
        }
        .Full-House-Container{
            display:block;
        }
        .checklist-style-container{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            border: 1px solid #ced4da;
            padding:10px;
            box-sizing: border-box;
            width:100%;
        }
        .checklist-style-container-food{
            border: 1px solid #ced4da;
            padding:10px;
            box-sizing: border-box;
            display:grid;
            grid-template-columns:1fr 1fr;
        }
        .checklist-style{
            margin-right:15px;
            display:flex;
            justify-content: space-between;
            


        }
        .Flate-Mates-container{
            display:none;
        }

        /* css for start of header*/ 
   .header-main-container{
    display:flex;
    align-items:center;
    justify-content: space-between;
    height:62px;
    width:100%;
    background-color:black;
    color:white;
    font-family:arial,sans-serif;
    position:fixed;
    top:0;
    right:0;
    left:0;
  } 
  .logo-container{
  display: flex;
  align-items:center;
  justify-content:start;
  cursor:pointer;
  }
  .image-containersos{
    height:60px;
    width:60px;
  }
  .logo-img-stylesos{
    height:100%;
    width:100%;
    background-color:transparent;
  }
  .text-container{
    font-size:20px;
  }
  .filter-option{
    height:auto;
    font-size:20px;
    cursor:pointer;
  }
  .option-container{
    height:30px;
    width:30px;
    padding-right:10px;
    position:relative;
  }
  .menu-icon-style{
    height:100%;
    width:100%;
    background-color: transparent;
  }
  .alert-empty{
    font-family:arial;
    font-size:18px;
    color:red;
    margin-bottom:20px;
    display:block;
  }
  /* this is option container*/
  .option-main-container{
    height:auto;
    width:130px;
    border:1.5px solid black;
    border-radius:4px;
    padding:5px;
    font-family:arial;
    font-size:1rem;
    background-color:rgb(236, 233, 233);
    position:absolute;
    color:black;
    top:50px;
    left:-105px;
    display:none;
  }
  @media only screen and (min-width:0px) and (max-width:741px){
    .text-container{
        font-size:0px;
    }
    .container {
    width: 95%;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
}
.Pg-container{
    box-sizing:border-box;
}
  }

  /* css end of header style*/
    </style>
</head>
<body>

<header class="header-main-container">

<a href="../welcome/home.php" style="color:white;text-decoration:none;"><div class="logo-container">
    <div class="image-containersos"><img src="../images/logo-roomhunt.png" class="logo-img-stylesos"></div>
    <div class="text-container">RoomHunt</div>
</div>
</a>


<div class="filter-option">My WishList</div>

<div class="option-container" style="cursor:pointer"><img src="../images/menu-icon.png" class="menu-icon-style">

    <div class="option-main-container">
    <a href="../profile/myprofile.php" style="text-decoration:none; color:black"><div>My Profile</div></a>
            <hr>
            <a href="../frontend_houses/mysellhouse.php" style="text-decoration:none;color:black"><div>My SellHouse</div></a>
            <hr>
            <a href="../frontend_houses/mypage.php" style="text-decoration:none;color:black"><div>My RentalHouse</div></a>
            <hr>
            <a href="../php_upload/upload.php" style="text-decoration:none;color:black"><div>Upload Houses</div></a>
            <hr>
            <a href="../signout/signout.php" style="text-decoration:none;color:black"><div>Signout</div></a>
    </div>
</div>
</header>

    <div class="container">
        <form class="property-form" action="../backendhouses/backendfullhouse.php" id="form-id" method="post" enctype="multipart/form-data">
            <h1>Property Details</h1>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php if(isset($city)){
                echo($city);
            } ?>" placeholder="Enter City Name" required>

            <label for="area">Area:</label>
            <input type="text" id="area" name="area" value="<?php if(isset($area)){
                echo($area);
            } ?>" placeholder="Enter Area Place" required>


            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="5" placeholder="Enter address" required><?php if(isset($address)){
                echo($address);
            } ?></textarea>

            <label for="price">Rent Price:</label>
            <input type="number" id="price" name="price" value="<?php if(isset($rentrate)){
                echo($rentrate);
            } ?>" placeholder="Enter Rent Amount">

            <label for="deposit">Deposit Price:</label>
            <input type="number" id="deposit" name="deposit" value="<?php if(isset($deposit)){
                echo($deposit);
            } ?>" placeholder="Enter Deposit Amount">


            <label for="sqft">Enter sqft:</label>
            <input type="number" id="sqft" name="sqft" value="<?php if(isset($sqft)){
                echo($sqft);
            } ?>" placeholder="Enter SquareFeet">
          

            <label for="ModeOfHouse">Mode Of House:</label>
            <select id="ModeOfHouse" name="ModeOfHouse" onchange="testing();" required>
            <option value="" selected>select</option>
                <option value="fullhouse" selected>Full House</option>
                <option value="pg">PG</option>
                <option value="flatmates">Flat House</option>
            </select>

            <div class="Pg-container">

                
                <label for="pgfor">PG For:</label>
                <select id="pgfor" name="pgfor">
                <option value="" selected>select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="anyone">Anyone</option>
                </select>

                <span class="alert-empty"><?php echo($pgerrorpgfor); ?></span>
                
            <label for="pgfurnish">Furnishing:</label>
            <select id="pgfurnish" name="furnishpg" >
                <option value="" selected>select</option>
                <option value="none">None</option>
                <option value="full">Full</option>
                <option value="semi">Semi</option>
                
            </select>

            <span class="alert-empty"><?php echo($pgerrorfurnish); ?></span>

                
           
          <div class="checklist-style-container">
            <label>Room Type:</label>
             <div class="checklist-style">
                <label for="singleroom">Single Room</label>
                <input type="checkbox" id="singleroom" value="SingleRoom" name="roomtypes[]" class="pgroomtypes">
             </div>
               <div class="checklist-style">
                <label for="doubleroom">Shared Room</label>
               <input type="checkbox" id="doubleroom" value="SharedRoom" name="roomtypes[]" class="pgroomtypes">
               </div>
              

          </div>

          <span class="alert-empty"><?php echo($pgerrorroomtype); ?></span>
             
        
            





            
          <div class="checklist-style-container">
            <label>Preferred For:</label>
             <div class="checklist-style">
                <label for="students">Students</label>
                <input type="checkbox" id="students" value="students" name="Preferredforpg[]" class="pgprefer">
             </div>

               <div class="checklist-style">
                <label for="professionals">Professionals</label>
               <input type="checkbox" id="professionals" value="professionals" name="Preferredforpg[]" class="pgprefer">
               </div>

          </div>

          <span class="alert-empty"><?php echo($pgerrorpreferred); ?></span>
             




          <div class="checklist-style-container">
            <label>Food info:</label>

            <div class="checklist-style-container-food">
            <div class="checklist-style">
                <label for="none">None</label>
                <input type="checkbox" id="none" value="none" name="Foodincluded[]" class="pgfood">
             </div>

             <div class="checklist-style">
                <label for="breakfast">breakfast(only)</label>
                <input type="checkbox" id="breakfast" value="breakfast(only)" name="Foodincluded[]" class="pgfood">
             </div>

             
               <div class="checklist-style">
                <label for="lunch">Lunch(only)</label>
               <input type="checkbox" id="lunch" value="lunch(only)" name="Foodincluded[]" class="pgfood">
               </div>

               <div class="checklist-style">
                <label for="dinner">Dinner(only)</label>
                <input type="checkbox" id="dinner" value="dinner(only)" name="Foodincluded[]" class="pgfood">
             </div>
             <div class="checklist-style">
                <label for="breakfastlunch">BreakFast+Lunch</label>
                <input type="checkbox" id="breakfastlunch" value="breakfast & lunch" name="Foodincluded[]" class="pgfood">
             </div>
             <div class="checklist-style">
                <label for="threetmies">All Meals</label>
                <input type="checkbox" id="3threetimes" value="all meals" name="Foodincluded[]" class="pgfood">
             </div>
             </div>
          </div>

          <span class="alert-empty"><?php echo($pgerrorfood); ?></span>


          <label for="pgmetro">Metro:</label>
            <select id="pgmetro" name="metropg">
             <option value="" selected>select</option>
                <option value="no metro">No Metro</option>
                <option value="1km away">1km Away</option>
                <option value="3km away">3km Away</option>
                <option value="5km away">5km Away</option>
            </select>

            <span class="alert-empty"><?php echo($pgerrormetro); ?></span>



          <label for="pgparkingStatus">Parking Type:</label>
            <select id="pgparkingStatus" name="parkingStatuspg">
            <option value="" selected>select</option>
                <option value="2 wheeler">2 Wheeler</option>
                <option value="4 wheeler">4 Wheeler</option>
            </select>


            <span class="alert-empty"><?php echo($pgerrorparking); ?></span>




            
            <label for="pgbathroomfacility">Bathroom Facility:</label>
            <select id="pgbathroomfacility" name="bathroomfacilitypg">
            <option value="" selected>select</option>
                <option value="commonbathroom">Common Bathroom</option>
                <option value="attachedbathroom">Attached Bathroom</option>
            </select>

            <span class="alert-empty"><?php echo($pgerrorbathroom); ?></span>
            
            <label for="housepic">Upload Picture of House:</label>
            <input type="file" id="housepic" name="housepicpg">

            <button type="submit" class="ref">Submit</button>
         
            </div>


           <div class="Full-House-Container">
           


            <div class="checklist-style-container">
                <label>Housing Type:</label>
                 <div class="checklist-style">
                    <label for="1BHK">1BHK</label>
                    <input type="checkbox"  id="1BHK" value="1BHK" name="HousingType[]" class="housing-checkbox">
                 </div>
    
                 <div class="checklist-style">
                    <label for="2BHK">2BHK</label>
                    <input type="checkbox" id="2BHK" value="2BHK" name="HousingType[]" class="housing-checkbox">
                 </div>

                 <div class="checklist-style">
                    <label for="3BHK">3BHK</label>
                    <input type="checkbox" id="3BHK" value="3BHK" name="HousingType[]" class="housing-checkbox">
                 </div>
                
                
                
              </div>
                 

       <span class="alert-empty"><?php echo ($fherrorhouse); ?></span>

          

            <label for="availabletime">Availability:</label>
            <select id="availabletime" name="houseavailable">
            <option value="" selected>select</option>
                <option value="immediate">immediate</option>
                <option value="within15days">within 15Days</option>
                <option value="within30days">within 30Days</option>
                <option value="after30days">After 30Days</option>
            </select>

            <span class="alert-empty"><?php echo($fherroravailable); ?></span>
           

            <div class="checklist-style-container">
                <label>Preferred Tenant:</label>
                 <div class="checklist-style">
                    <label for="family">Family</label>
                    <input type="checkbox" id="family" value="family" name="preferredtenates[]" class="house-preferred-tennets">
                 </div>
    
                 <div class="checklist-style">
                    <label for="company">Company</label>
                    <input type="checkbox" id="company" value="company" name="preferredtenates[]" class="house-preferred-tennets">
                 </div>

              </div>
              <span class="alert-empty"><?php echo($fherrorperferred); ?></span>

            <label for="propertytype">Property Type:</label>
            <select id="propertytype" name="propertytypefullhouse">
            <option value="" selected>select</option>
                <option value="apartment">Apartment</option>
                <option value="independenthouse">Independent House</option>
            </select>

            <span class="alert-empty"><?php echo($fherrorproperty); ?></span>

           
            <label for="furnish">Furnishing:</label>
            <select id="furnish" name="furnishfullhouse">
            <option value="" selected>select</option>
                <option value="full">Full</option>
                <option value="semi">Semi</option>
                <option value="none">None</option>
            </select>
           
            <span class="alert-empty"><?php echo($fherrorfurnish); ?></span>

            <label for="parkingStatus">Parking Type:</label>
            <select id="parkingStatus" name="parkingStatusfullhouse">
            <option value="" selected>select</option>
                <option value="2 wheeler">2 Wheeler</option>
                <option value="4 wheeler">4 Wheeler</option>
            </select>

            <span class="alert-empty"><?php echo($fherrorparking); ?></span>

            <label for="metro">Metro:</label>
            <select id="metro" name="metrofh">
            <option value="" selected>select</option>
                <option value="No Metro">No Metro</option>
                <option value="1km Away">1km Away</option>
                <option value="3km Away">3km Away</option>
                <option value="5km Away">5km Away</option>
            </select>

            <span class="alert-empty"><?php echo($fherrormetro); ?></span>

            <label for="housepic">Upload Picture of House:</label>
            <input type="file" id="housepic" name="housepic">

            <button type="submit" class="ref">Submit</button>
         

        </div>


        
        <div class="Flate-Mates-container">

            <div class="checklist-style-container">
                <label>Room Type:</label>
                 <div class="checklist-style">
                    <label for="singleroom">Single Room</label>
                    <input type="checkbox" id="singleroom" value="SingleRoom" name="RoomType[]" class="fmroomtype">
                 </div>

                 <div class="checklist-style">
                    <label for="doubleroom">Double Room</label>
                   <input type="checkbox" id="doubleroom" value="DoubleRoom" name="RoomType[]" class="fmroomtype">
                   </div>
    
                   <div class="checklist-style">
                    <label for="sharedroom">Shared Room</label>
                   <input type="checkbox" id="sharedroom" value="SharedRoom" name="RoomType[]" class="fmroomtype">
                   </div>
    
              </div>

              <span class="alert-empty"><?php echo($fmerrorroom);?></span>

              <label for="TenantFor">Allowed Tenants:</label>
              <select id="TenantFor" name="TenantFor">
              <option value="" selected>select</option>
                  <option value="Couples">Couples</option>
                  <option value="Family">Family</option>
                  <option value="Bachelor">Bachelor</option>
              </select>

              <span class="alert-empty"><?php echo($fmerrorallowedtenant);?></span>
            
  
              <label for="fmfurnish">Furnishing:</label>
              <select id="fmfurnish" name="furnish">
              <option value="" selected>select</option>
                  <option value="full">Full</option>
                  <option value="semi">Semi</option>
                  <option value="none">None</option>
              </select>
  
              <span class="alert-empty"><?php echo($fmerrorfurnish);?></span>

              <label for="fmpropertytype">Property Type:</label>
              <select id="fmpropertytype" name="propertytype">
              <option value="" selected>select</option>
                  <option value="apartment">Apartment</option>
                  <option value="independenthouse">Independent House</option>
              </select>
  
              <span class="alert-empty"><?php echo($fmerrorproperty);?></span>

              <label for="showonly">Show Only:</label>
              <select id="showonly" name="showonly">
              <option value="" selected>select</option>
                  <option value="Both Veg And Non Veg">Non Veg Allowed</option>
                  <option value="Only Veg">Veg (Only) Allowed</option>
              </select>
              <span class="alert-empty"><?php echo($fmerrorfood);?></span>
   
              <label for="floors">Floors:</label>
              <select id="floors" name="floors">
              <option value="" selected>select</option>
                  <option value="ground">Ground</option>
                  <option value="1 to 3">1 to 3</option>
                  <option value="4 to 6">4 to 6</option>
                  <option value="7 to 9">7 to 9</option>
              </select>

              <span class="alert-empty"><?php echo($fmerrorfloor);?></span>
  
              <label for="fmparkingStatus">Parking Type:</label>
              <select id="fmparkingStatus" name="parkingStatus">
              <option value="" selected>select</option>
                  <option value="2 wheeler">2 Wheeler</option>
                  <option value="4 wheeler">4 Wheeler</option>
              </select>

              <span class="alert-empty"><?php echo($fmerrorparking);?></span>

              <label for="fmmetro">Metro:</label>
            <select id="fmmetro" name="metrofm">
            <option value="" selected>select</option>
                <option value="No Metro">No Metro</option>
                <option value="1km Away">1km Away</option>
                <option value="3km Away">3km Away</option>
                <option value="5km Away">5km Away</option>
            </select>
  
            <span class="alert-empty"><?php echo($fmerrormetro);?></span>
                 
              <label for="fmbathroomfacility">Bathroom Facility:</label>
              <select id="fmbathroomfacility" name="bathroomfacility">
              <option value="" selected>select</option>
                  <option value="1 or more">1 or More</option>
                  <option value="2 or more">2 or More</option>
                  <option value="3 or more">3 or More</option>
              </select>
  
              <span class="alert-empty"><?php echo($fmerrorbathroom);?></span>
              
            <label for="housepic">Upload Picture of House:</label>
            <input type="file" id="housepic" name="housepics">

            <button type="submit" class="ref">Submit</button>
         

        
            </div>

           
              
           


        </form>
    </div>
</body>
<script>



 // The js code for header interactive
 let menu = document.querySelector('.option-container');

let dropdown = document.querySelector('.option-main-container');
menu.addEventListener('click',function(){

    if(dropdown.style.display == 'block'){
        dropdown.style.display = 'none';
    }
    else{
        dropdown.style.display = 'block';
    }
});


// the js code for header interactive

let formaccess = document.getElementById('form-id');

  let Pgcontainer = document.querySelector('.Pg-container');

  let Fullhousecontainer = document.querySelector('.Full-House-Container');

  let FlatMate = document.querySelector('.Flate-Mates-container');


// code for access all option fields 
// code for full house 
let housecheckbox = document.querySelectorAll('.housing-checkbox');
let availability = document.getElementById('availabletime');
let housepreferredtenants = document.querySelectorAll('.house-preferred-tennets');
let housepropertytype = document.getElementById('propertytype');
let housefurnish = document.getElementById('furnish');
let houseparking = document.getElementById('parkingStatus');
let housemetro = document.getElementById('metro');
// code for end of full house

// code for Flathouse
let fmroomtype = document.querySelectorAll('.fmroomtype');
let fmtenant = document.getElementById('TenantFor');
let fmfurnish = document.getElementById('fmfurnish');
let fmpropertytype = document.getElementById('fmpropertytype');
let perfood = document.getElementById('showonly');
let floors = document.getElementById('floors');
let fmparkingStatus = document.getElementById('fmparkingStatus');
let fmmetro = document.getElementById('fmmetro');
let fmbathroomfacility = document.getElementById('fmbathroomfacility');
// code for end of flat house
// code for pg 
let pgforoption = document.getElementById('pgfor');
let pgfurnish = document.getElementById('pgfurnish');
let pgroomstype = document.querySelectorAll('.pgroomtypes');
let pgprefer = document.querySelectorAll('.pgprefer');
let pgfoods = document.querySelectorAll('.pgfood');
let pgmetro = document.getElementById('pgmetro');
let pgparkingStatus = document.getElementById('pgparkingStatus');
let pgbathroom = document.getElementById('pgbathroomfacility');
 
// code  for end of pg
//  code for access all option fields


 function testing(){
    let houseoption = document.getElementById('ModeOfHouse');
    let access = houseoption.value;

    if(houseoption.value === 'pg'){
      Pgcontainer.style.display = 'block';
      Fullhousecontainer.style.display = 'none';
      FlatMate.style.display = 'none';
     formaccess.action = '../backendhouses/backendpg.php';
    }
    else if(houseoption.value === 'fullhouse'){
        Fullhousecontainer.style.display = 'block';
        Pgcontainer.style.display = 'none';
        FlatMate.style.display = 'none';
        formaccess.action = '../backendhouses/backendfullhouse.php';
    }
    else if(houseoption.value === 'flatmates'){
        FlatMate.style.display = 'block';
        Fullhousecontainer.style.display = 'none';
        Pgcontainer.style.display = 'none';
        formaccess.action = '../backendhouses/backendflatmates.php';
    }
 }


 
 let ErrorMessage = <?php echo json_encode($errormessage); ?>;

let ErrorHouse = <?php echo json_encode($errorhouse); ?>;

let modeofhouse = <?php echo json_encode($modeofhouse); ?>;
let houseavailable = <?php echo json_encode($houseavailable); ?>;
let housepreferredtenant = <?php echo json_encode($houseprefertenants); ?>;
let propertytype = <?php echo json_encode($propertytype); ?>;
let furnish = <?php echo json_encode($furnish); ?>;
let parking = <?php echo json_encode($parking); ?>;
let metro = <?php echo json_encode($metro); ?>;
let bathroomfacility = <?php echo json_encode($bathroomfacility); ?>;
let allowedtenant = <?php echo json_encode($allowedtenant); ?>;
let allowedfood = <?php echo json_encode($allowedfood); ?>;
let floor = <?php echo json_encode($floor); ?>;
let flathouseroomtype = <?php echo json_encode($roomtype); ?>;
let pgroomtype = <?php echo json_encode($pgroomtype); ?>;
let housetype = <?php echo json_encode($housetype) ?>;
let pgpreferred = <?php echo(json_encode($pgpreferred)); ?>;
let pgfood = <?php echo(json_encode($pgfood)); ?>;

let houseoption = document.getElementById('ModeOfHouse');


if(ErrorMessage){
    alert(ErrorMessage);
    if(ErrorHouse === 'fullhouse'){
        houseoption.value = 'fullhouse';
        Fullhousecontainer.style.display = 'block';
        Pgcontainer.style.display = 'none';
        FlatMate.style.display = 'none';
        formaccess.action = '../backendhouses/backendfullhouse.php';
        for(let i=0;i<housetype.length;i++){
            for(let j=0;j<housecheckbox.length;j++){
                if(housecheckbox[j].value === housetype[i]){
                    housecheckbox[j].checked = true;
                }
            }
        }

        availability.value = houseavailable;
       
        for(let i=0;i<housepreferredtenant.length;i++){
            for(let j=0;j<housepreferredtenants.length;j++){
                if(housepreferredtenants[j].value === housepreferredtenant[i]){
                    housepreferredtenants[j].checked = true;
                }
            }
        }

        housepropertytype.value = "independenthouse";
        housefurnish.value = furnish;
        houseparking.value = parking;
        housemetro.value = metro;
    }
    else if(ErrorHouse === 'flathouse'){
        houseoption.value = 'flatmates';
        FlatMate.style.display = 'block';
        Fullhousecontainer.style.display = 'none';
        Pgcontainer.style.display = 'none';
        formaccess.action = '../backendhouses/backendflatmates.php';
        for(let i=0;i<flathouseroomtype.length;i++){
            for(let j=0;j<fmroomtype.length;j++){
                if(fmroomtype[j].value === flathouseroomtype[i]){
                    fmroomtype[j].checked = true;
                }
            }
        }

        fmtenant.value = allowedtenant;
        fmfurnish.value = furnish;
        fmpropertytype.value = propertytype;
        perfood.value = allowedfood;
        floors.value = floor;
        fmparkingStatus.value = parking;
        fmmetro.value = metro;
        fmbathroomfacility.value = bathroomfacility;
    
      

    }
    else if(ErrorHouse === 'pg'){
        houseoption.value = 'pg';
        Pgcontainer.style.display = 'block';
        Fullhousecontainer.style.display = 'none';
        FlatMate.style.display = 'none';
        formaccess.action = '../backendhouses/backendpg.php';
        pgforoption.value = housepreferredtenant;
        pgfurnish.value = furnish;
         for(let i=0;i<pgroomtype.length;i++){
            for(let j=0;j<pgroomstype.length;j++){
                if(pgroomstype[j].value === pgroomtype[i]){
                    pgroomstype[j].checked = true;
                }
            }
         }
       
        for(let i=0;i<pgpreferred.length;i++){
            for(let j=0;j<pgprefer.length;j++){
                if(pgprefer[j].value === pgpreferred[i]){
                    pgprefer[j].checked = true;
                }
            }
        }
        for(let i=0;i<pgfood.length;i++){
            for(let j=0;j<pgfoods.length;j++){
                if(pgfoods[j].value === pgfood[i]){
                    pgfoods[j].checked = true;
                }
            }
        } 
        console.log(parking);
        pgmetro.value = metro;
        pgparkingStatus.value = parking;
        pgbathroom.value = bathroomfacility;
      
    }


}




    

    </script>
</html>