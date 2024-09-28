<?php 
session_start();
ob_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../frontend_houses/fullhousepage.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}

$rent = !empty($_POST['rent']) ? $_POST['rent'] : null;
$deposit = !empty($_POST['deposit']) ? $_POST['deposit'] : null;
$city = !empty($_POST['city']) ? trim(strtolower($_POST['city'])) : null;
$area = !empty($_POST['area']) ? trim(strtolower($_POST['area'])) : null;
$housetype = !empty($_POST['housetype']) ? $_POST['housetype'] : null;
$preferredfor = !empty($_POST['preferredfor']) ? $_POST['preferredfor'] : null;
$parkingstatus = !empty($_POST['parkingstatus']) ? (($_POST['parkingstatus'])) : null;
include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();
$sql = "SELECT * FROM housedatafullhouse WHERE 1=1 ";
$types="";
$paramater = [];
 if(!empty($city)){
  $sql.=" AND city=?";
  $types.="s";
  $paramater[]=$city;
 }
 if(!empty($area)){
  $sql.=" AND area=?";
  $types.="s";
  $paramater[]=$area;
 }
 if(!empty($rent)){
  $sql.=" AND rentrate<=?";
  $types.="i";
  $paramater[]=$rent;
 }
 if(!empty($deposit)){
   $sql.=" AND deposit<=?";
   $types.="i";
   $paramater[]=$deposit;
  }
 if(!empty($housetype)){
  $sql.=" AND housetype LIKE ?";
  $types.="s";
  $paramater[]="%{$housetype}%";
 }
 if(!empty($preferredfor)){
  $sql.=" AND preferredtennets LIKE ?";
  $types.="s";
  $paramater[]="%{$preferredfor}%";
 }
 if(!empty($parkingstatus)){
  $sql.=" AND parkingstatus LIKE ?";
  $types.="s";
  $paramater[]="%{$parkingstatus}%";
 }

 if(count($paramater)>0){
  $query = database::$connection->prepare($sql);
 $query->bind_param("$types",...$paramater);
 }
 else{
    $query = database::$connection->prepare($sql);
 }
 $query->execute();
$variable = $query->get_result();
$array = [];
while($temp = $variable->fetch_assoc()){
  $temp['blobimage'] = base64_encode($temp['blobimage']);
$array[] = $temp;
}

database::$connection->close();
$jsarray = json_encode($array);
ob_end_clean();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full House</title>
    <link rel="stylesheet" href="../css_houses/fullhousepage.css">
    <style>
        .filter-option{
            height:auto;
            font-size:23px;
            cursor:pointer;
            display:flex;
            justify-content:center;
            align-items:center;
            width:auto;
            padding:3px 8px;
            border:1.8px solid white;
            border-radius:15px;
}
                .search-logo-style{
                height:23px;
                width:23px;
                margin-right:10px;
                }
         @media only screen and (max-width: 749px) {
            .filter-option{ 
            font-size:16px; 
            padding:2px 6px;
            border:1.5px solid white;
            }
                        .search-logo-style{
            height:16px;
            width:16px;
            margin-right:6px;
            }

         }
        
    </style>

</head>
<body>

<header class="header-main-container">

<a href="../welcome/home.php" style="color:white;text-decoration:none;"><div class="logo-container">
    <div class="image-containersos"><img src="../images/logo-roomhunt.png" class="logo-img-stylesos"></div>
    <div class="text-container">RoomHunt</div>
</div>
</a>


<div class="filter-option">
    <img src='../images/Searchlogo.jpg' class="search-logo-style">
    <div>filter</div>
</div>

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
   <div class="main-container">

    <div class="filter-main-container">

    <form class="property-form" action="fullhousepage.php"  method="post" enctype="multipart/form-data">
    <div class="filter-container">
       
        <div class="furnish-input-container">
            <label for="rent-text">Enter Rent Range </label>
            <input id="rent-text" type="number" class="text-style" name="rent" placeholder="Enter Rent">
        </div>


        <div class="furnish-input-container">
        <label for="deposit-text">Enter Deposit Range </label>
        <input id="deposit-text" type="number" class="text-style" name="deposit" placeholder="Enter Deposit">
    </div>
        


        <div class="furnish-input-container">
            <label for="city-text">Enter City*</label>
            <input id="city-text" type="text" class="text-style" name="city" placeholder="Enter City" required>
        </div>

        <div class="furnish-input-container">
            <label for="area-text">Enter Area</label>
            <input id="area-text" type="text" class="text-style" name="area" placeholder="Enter Area">
        </div>

        <div class="furnish-input-container">
            <label for="housetype">House Type</label>
            <select id="housetype" name="housetype">
                <option value="" selected>Select</option>
                <option value="1BHK">1BHK</option>
                <option value="2BHK">2BHK</option>
                <option value="3BHK">3BHK</option>
            </select>
        </div>

       

        <div class="furnish-input-container">
            <label for="preferredfor">Preferred For</label>
            <select id="preferredfor" name="preferredfor">
                <option value="" selected>Select</option>
                <option value="family">Family</option>
                <option value="company">Company</option>
            </select>
        </div>

        <div class="furnish-input-container">
            <label for="parking">Parking Type</label>
            <select id="parking" name="parkingstatus">
                <option value="" selected>Select</option>
                <option value="2 wheeler">2 wheeler</option>
                <option value="4 wheeler">4 wheeler</option>
            </select>
        </div>
        
        <div class="submit-container">
            <input type="submit" class="submit-button" value="Search">
        </div>
        
        
    </div>
   
   </form>
           </div>
    <div class="content-page">

    </div>
   </div>



  
   <div class="try">
    <div class="main-container-profile">

        <div class="left-box">
            <div class="profile-container-profile">
                <img src="../images/sample-profile.png" class="profile-style-profile">
             </div>
        </div>
       
        <div class="right-box">
            <div class="details-container-profile">
                <div class="name-container-profile">
                     <p class="name-label-profile">Name:</p>
                     <p class="actual-name-profile">Loading...</p>
                </div>
                <hr class="hrline-profile">
                <div class="mailid-container-profile">
                     <p class="mailid-label-profile">EmailId:</p>
                     <p class="actual-mailid-profile">Loading...</p>
                </div>
                <hr class="hrline-profile">
                <div class="phonenumber-container-profile">
                 <p class="phone-label-profile">Phone Number</p>
                 <p class="actual-number-profile">Loading...</p>
                </div>
                <div class="edit-button-container-profile">
                 <button class="edit-buttonss-profile">close</button>
                </div>
                <div class="close-button-profile"><div>X</div></div>
                </div>
        </div>
        
 
     </div>
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
  //js code for filter interactive
  const filterbutton = document.querySelector('.filter-option');
  const filtercontainer = document.querySelector('.filter-main-container');
  filterbutton.addEventListener('click',function(){
    if(filtercontainer.style.display == 'block'){
        filtercontainer.style.display = 'none';
    }
    else{
        filtercontainer.style.display = 'block';
    }
  }); 
  //js code for filter interactive
let array = <?php echo($jsarray); ?>;
console.log(array.length);

let htmlgen = '';
for(let i=0;i<array.length;i++){
  let housetype = (array[i].housetype);
  let propertytype = (array[i].propertytype);
  let preferredtennets = (array[i].preferredtennets);
let htmltemp = `
<div class="specific-main-container">
            <address class="address-container">
                ${array[i].address}
                
            </address>
            <div class="amount-detail-container">
                <div class="rent-detail">
                  <div class="values7">&#8377;<span>${array[i].rentrate}</span></div>
                  <div class="option">Rent</div>
                </div>
                <div class="deposit-container">
                    <div class="values8">&#8377;<span>${array[i].deposit}</span></div>
                  <div class="option">Deposit</div>
                </div>
                <div class="squarefeet-container">
                    <div class="values9"><span>${array[i].sqft}</span>sqft</div>
                  <div class="option">SquareFeet</div>
                </div>
            </div>
    
            <div class="image-description-container">
                <div class="image-container">
                <img src="data:${array[i].mimetype};base64,${array[i].blobimage}" class="image-style">
                </div>
    
    
                <div class="description-main">
                <div class="description-container">
                    <div class="furnish-container">
                        <div class="values1">${array[i].furnish}</div>
                        <div class="option">Furnish</div>
                    </div>
                    <div class="apartment-container">
                        <div class="values1">${housetype}</div>
                        <div class="option">${propertytype}</div>
                    </div>
    
    
                    <div class="allowedtenants-container">
                        <div class="values3">${preferredtennets}</div>
                        <div class="option">EligibleTenants</div>
                    </div>
    
    
                    <div class="allowedtenants-container">
                        <div class="values4">${array[i].availability}</div>
                        <div class="option">House Status</div>
                    </div>
    
    
                    <div class="parking-detail-container">
                        <div class="values5">${array[i].parkingstatus}</div>
                        <div class="option">Parking Status</div>
                    </div>
    
    
                    <div class="metro-detail-container">
                        <div class="values6">${array[i].metro}</div>
                        <div class="option">metro facility</div>
                    </div>
    
    
                </div>
                <div class="buttons">
                    <button class="owner-button-container" data-owner-id="${array[i].userid}">Get Owner Details</button>

                    <button class="add-wishlist-container"
                    data-product-id="${array[i].pid}"
                    data-owner-id="${array[i].userid}"
                    data-modeof-house="${array[i].modeofhouse}"
                    >
                      Add To WishList
                      </button>
                  </div>
            </div>


            </div>
        </div>
`;
htmlgen += htmltemp;

}
document.querySelector('.content-page').innerHTML =htmlgen;

const imageaccess =  document.querySelector('.profile-style-profile');

let alladdbutton = document.querySelectorAll('.add-wishlist-container');

for(let i=0; i<alladdbutton.length;i++){
  alladdbutton[i].addEventListener('click',function(){
  wishlistretrieve(this);
});

}


let closebutton = document.querySelector('.close-button-profile');
   
   let container = document.querySelector('.try');
   closebutton.addEventListener('click',function(){
    imageaccess.src="../images/sample-profile.png";
               document.querySelector('.actual-name-profile').innerHTML = 'Loading...';
               document.querySelector('.actual-mailid-profile').innerHTML ='Loading...';
               document.querySelector('.actual-number-profile').innerHTML = 'Loading...';
    container.style.display = 'none';
   });

let testing = document.querySelector('.edit-buttonss-profile');
    testing.addEventListener('click',function(){
        imageaccess.src="../images/sample-profile.png";
               document.querySelector('.actual-name-profile').innerHTML = 'Loading...';
               document.querySelector('.actual-mailid-profile').innerHTML ='Loading...';
               document.querySelector('.actual-number-profile').innerHTML = 'Loading...';
        container.style.display = 'none';
    });



let ownerbutton = document.querySelectorAll('.owner-button-container');

for(let m=0;m<ownerbutton.length;m++){
    ownerbutton[m].addEventListener('click',function(){
     getownerdetail(this);
    });
}

function wishlistretrieve(variable){
  let productid = variable.dataset.productId;
    let productOwnerid = variable.dataset.ownerId;
    let modeofhouse = variable.dataset.modeofHouse;
    let clientUserid = "<?php echo($_SESSION['userid']); ?>";
  
    const formData = {
            action: 'insert', 
            productid:productid,
            pownerid:productOwnerid,
            housemode:modeofhouse,
            clientUserid:clientUserid,
        };

        fetch('../wishlist/wishlistfullhouse.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.text())
        .then(data => {
            alert('Response: ' + data);
        })
        .catch(error => {
            console.error('Error:', error);
        });

        

}

function getownerdetail(access){
    container.style.display = 'block';
   const userid = access.dataset.ownerId;
   fetch('../backend_profile/profileresponse.php',{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                'userid':userid
            })
        })

           .then(function(response){
            return response.json();
           })
        

        
            .then(function(data){
               
                
               const imagetype = data.imagetype;
                const base64 = data.base64image;
                const username = data.username;
                const mailid = data.mailid;
                const mobileno = data.mobileno;
              
              const srcs =`data:${imagetype};base64,${base64}`;
               imageaccess.src=srcs;
               document.querySelector('.actual-name-profile').innerHTML = username;
               document.querySelector('.actual-mailid-profile').innerHTML = mailid;
               document.querySelector('.actual-number-profile').innerHTML = mobileno;
               
             
        }              
        )
        .catch(function(error) {
        console.error('Error fetching data:', error);
    });
}

</script>
</html>