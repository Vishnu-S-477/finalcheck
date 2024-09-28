<?php 
session_start();
ob_start();
if(isset($_SESSION['userid'])){
    echo('login status Green');
    $_SESSION['backupsite'] = '';
}
else{
    
    $_SESSION['backupsite'] = '../frontend_houses/mysellhouse.php';
    session_write_close();
    header("Location:../frontend_authentication/Login.php");
    exit();
}

$userid = $_SESSION['userid'];

include '../database/database.php';
database::$db_name = 'roomhunt';
database::connection();

$fullhousearray=[];

  $sql=database::$connection->prepare("SELECT * FROM housedatafullhouse WHERE userid = ?;");
  $sql->bind_param("s",$userid);
  $sql->execute();
  $temps = $sql->get_result();
  while($tem = $temps->fetch_assoc()){
    $tem['blobimage'] = base64_encode($tem['blobimage']);
    $fullhousearray[] = $tem;
  }


$sql->close();

//BreakPoints

  $flathousearray = [];


  $sql=database::$connection->prepare("SELECT * FROM housedataflathouse WHERE userid = ?;");
  $sql->bind_param("s",$userid);
  $sql->execute();
  $temps = $sql->get_result();
  while($tem = $temps->fetch_assoc()){
    $tem['blobimage'] = base64_encode($tem['blobimage']);
    $flathousearray[] = $tem;
  }

$sql->close();






// Break Point

  $pgarray = [];
  $sql=database::$connection->prepare("SELECT * FROM housedatapg WHERE userid = ?;");
  $sql->bind_param("s",$userid);
  $sql->execute();
  $temps = $sql->get_result();
  while($tem = $temps->fetch_assoc()){
    $tem['blobimage'] = base64_encode($tem['blobimage']);
    $pgarray[] = $tem;
  }


$sql->close();
ob_end_clean();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Sell House</title>
    <link rel="stylesheet" href="../css_houses/mypage.css">
</head>
<body>
<header class="header-main-container">

<a href="../welcome/home.php" style="color:white;text-decoration:none;"><div class="logo-container">
    <div class="image-containersos"><img src="../images/logo-roomhunt.png" class="logo-img-stylesos"></div>
    <div class="text-container">RoomHunt</div>
</div>
</a>


<div class="filter-option">My Houses</div>

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
 let pgarrays = <?php  echo(json_encode($pgarray)); ?>;
 let flathousearray = <?php  echo(json_encode($flathousearray)); ?>;
 let fullhousearray = <?php  echo(json_encode($fullhousearray)); ?>;
 let tempofhouse = '';
 for(let i=0;i<pgarrays.length;i++){
  let roomtype = (pgarrays[i].roomtype);
    let preferredfor = (pgarrays[i].preferredfor);
    let food = (pgarrays[i].foodfacility);
  let temp = `
  <div class="specific-main-container">
            <address class="address-container">
               ${pgarrays[i].address}
                
            </address>
            <div class="amount-detail-container">
                <div class="rent-detail">
                  <div class="values7">&#8377;<span>${pgarrays[i].rentrate}</span></div>
                  <div class="option">Rent</div>
                </div>
                <div class="deposit-container">
                    <div class="values8">&#8377;<span>${pgarrays[i].deposit}</span></div>
                  <div class="option">Deposit</div>
                </div>
                <div class="squarefeet-container">
                    <div class="values9"><span>${pgarrays[i].sqft}</span>sqft</div>
                  <div class="option">Builtup</div>
                </div>
            </div>
    
            <div class="image-description-container">
                <div class="image-container">
                    <img src="data:${pgarrays[i].mimetype};base64,${pgarrays[i].blobimage}" class="image-style">
                </div>
    
    
                <div class="description-main">
                <div class="description-container">
                    <div class="furnish-container">
                        <div class="values1">${pgarrays[i].furnish}</div>
                        <div class="option">Furnish</div>
                    </div>
                    <div class="apartment-container">
                        <div class="values2">${roomtype}</div>
                        <div class="option">RoomType</div>
                    </div>
    
    
                    <div class="pgfor-container">
                        <div class="values3">${pgarrays[i].pgfor}</div>
                        <div class="option">Pg For</div>
                    </div>

                    <div class="preferredcontainer-container">
                        <div class="values4">${preferredfor}</div>
                        <div class="option">Preferred for</div>
                    </div>
    
    
                    <div class="food-container">
                        <div class="values6">${food}</div>
                        <div class="option">Food Included</div>
                    </div>
    
                    <div class="parking-detail-container">
                        <div class="values7">${pgarrays[i].parking}</div>
                        <div class="option">Parking Status</div>
                    </div>

                    <div class="parking-detail-container">
                        <div class="values7">${pgarrays[i].metro}</div>
                        <div class="option">Metro Status</div>
                    </div>
    
                    
                    <div class="bathroom-detail-container">
                        <div class="values8">${pgarrays[i].bathroomfacility}</div>
                        <div class="option">Bathroom Status</div>
                    </div>
    
    
    
                </div>
                <div class="buttons">
                    <button class="owner-button-container" data-owner-id="${pgarrays[i].userid}">Get Owner Details</button>
                    <button class="add-wishlist-container removepg"
                    data-product-id="${pgarrays[i].pid}"
                    data-modeof-house="${pgarrays[i].modeofhouse}"
                    >
                    Remove 
                      </button>
                  </div>
            </div>


            </div>
        </div>
  `;

  tempofhouse += temp;

 }

 



 for(let j=0;j<flathousearray.length;j++){
  let roomtype = (flathousearray[j].roomtype);
 let temp = `
 <div class="specific-main-container">
            <address class="address-container">
            ${flathousearray[j].address}
        
            </address>
            <div class="amount-detail-container">
                <div class="rent-detail">
                  <div class="values7">&#8377;<span>${flathousearray[j].rentrate}</span></div>
                  <div class="option">Rent</div>
                </div>
                <div class="deposit-container">
                    <div class="values8">&#8377;<span>${flathousearray[j].deposit}</span></div>
                  <div class="option">Deposit</div>
                </div>
                <div class="squarefeet-container">
                    <div class="values9"><span>${flathousearray[j].sqft}</span>sqft</div>
                  <div class="option">Builtup</div>
                </div>
            </div>
    
            <div class="image-description-container">
                <div class="image-container">
                <img src="data:${flathousearray[j].mimetype};base64,${flathousearray[j].blobimage}" class="image-style">
                </div>
    
    
                <div class="description-main">
                <div class="description-container">
                    <div class="furnish-container">
                        <div class="values1">${flathousearray[j].furnish}</div>
                        <div class="option">Furnish</div>
                    </div>
                    <div class="apartment-container">
                        <div class="values2">${roomtype}</div>
                        <div class="option">Roomtype</div>
                    </div>
    
    
                    <div class="allowedtenants-container">
                        <div class="values3">${flathousearray[j].allowedtenant}</div>
                        <div class="option">Eligible Tenants</div>
                    </div>
    
    
                    <div class="homeavailable-container">
                        <div class="values4">${flathousearray[j].metro}</div>
                        <div class="option">Metro Status</div>
                    </div>
    
    
                    <div class="parking-detail-container">
                        <div class="values5">${flathousearray[j].parkingtype}</div>
                        <div class="option">Parking Status</div>
                    </div>
    
    
                    <div class="metro-detail-container">
                        <div class="values6">${flathousearray[j].allowedfood}</div>
                        <div class="option">allowed Food</div>
                    </div>

                    <div class="metro-detail-container">
                        <div class="values7">${flathousearray[j].floor}</div>
                        <div class="option">Floor</div>
                    </div>


                    <div class="metro-detail-container">
                        <div class="values8">${flathousearray[j].bathroom}</div>
                        <div class="option">Bathroom Facility</div>
                    </div>
                    

    
    
                </div>
                <div class="buttons">
                    <button class="owner-button-container" data-owner-id="${flathousearray[j].userid}">Get Owner Details</button>
                    <button class="add-wishlist-container removeflat"
                    data-product-id="${flathousearray[j].pid}"
                    data-modeof-house="${flathousearray[j].modeofhouse}"
                    >
                    Remove 
                      </button>
                  </div>
            </div>


            </div>
        </div>
 `;
 tempofhouse += temp;

 }
 

 for(let k=0;k<fullhousearray.length;k++){
  let housetype = (fullhousearray[k].housetype);
  let propertytype = (fullhousearray[k].propertytype);
  let preferredtennets = (fullhousearray[k].preferredtennets);
  let temp = `
  <div class="specific-main-container">
            <address class="address-container">
                ${fullhousearray[k].address}
                
            </address>
            <div class="amount-detail-container">
                <div class="rent-detail">
                  <div class="values7">&#8377;<span>${fullhousearray[k].rentrate}</span></div>
                  <div class="option">Rent</div>
                </div>
                <div class="deposit-container">
                    <div class="values8">&#8377;<span>${fullhousearray[k].deposit}</span></div>
                  <div class="option">Deposit</div>
                </div>
                <div class="squarefeet-container">
                    <div class="values9"><span>${fullhousearray[k].sqft}</span>sqft</div>
                  <div class="option">Builtup</div>
                </div>
            </div>
    
            <div class="image-description-container">
                <div class="image-container">
                <img src="data:${fullhousearray[k].mimetype};base64,${fullhousearray[k].blobimage}" class="image-style">
                </div>
    
    
                <div class="description-main">
                <div class="description-container">
                    <div class="furnish-container">
                        <div class="values1">${fullhousearray[k].furnish}</div>
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
                        <div class="values4">${fullhousearray[k].availability}</div>
                        <div class="option">House Status</div>
                    </div>
    
    
                    <div class="parking-detail-container">
                        <div class="values5">${fullhousearray[k].parkingstatus}</div>
                        <div class="option">Parking Status</div>
                    </div>
    
    
                    <div class="metro-detail-container">
                        <div class="values6">${fullhousearray[k].metro}</div>
                        <div class="option">metro facility</div>
                    </div>
    
    
                </div>
                <div class="buttons">
                    <button class="owner-button-container" data-owner-id="${fullhousearray[k].userid}">Get Owner Details</button>
                    <button class="add-wishlist-container removefull"
                    data-product-id="${fullhousearray[k].pid}"
                    data-modeof-house="${fullhousearray[k].modeofhouse}"
                    >
                      Remove 
                      </button>
                  </div>
            </div>


            </div>
        </div>
  `;
   tempofhouse += temp;
 }
 document.querySelector('.content-page').innerHTML = tempofhouse;
 const imageaccess =  document.querySelector('.profile-style-profile');

 let removepghouse = document.querySelectorAll('.removepg');

 for(let i=0;i<removepghouse.length;i++){
  removepghouse[i].addEventListener('click',function(){
    removepghouses(this);
   
  });
}

// Break Points


 let removeflathouse = document.querySelectorAll('.removeflat');

 for(let i=0;i<removeflathouse.length;i++){
  removeflathouse[i].addEventListener('click',function(){
    removeflathouses(this);
  });
}
// Break Point
 let removefullhouse = document.querySelectorAll('.removefull');

 for(let i=0;i<removefullhouse.length;i++){
  removefullhouse[i].addEventListener('click',function(){
    removefullhouses(this);
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

 
 function removefullhouses(access){
  alert( "<?php echo($_SESSION['userid']); ?>");
  let productid = access.dataset.productId;
  let modeofhouse = access.dataset.modeofHouse;
  let userid =  "<?php echo($_SESSION['userid']); ?>";
  let formData = {
    userid:userid,
    productid:productid,
    modeofhouse:modeofhouse
  };
  
  fetch('../backendhouses/backendremovehouse.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
          if(response.ok){
            alert("Choice Removed Successfuly");
            access.closest('.specific-main-container').remove();
         
          }
          else{
            alert("Dear Customer Some Thing Went Wrong Please Try To Remove Later");
          }
        })
        .catch(error => {
            console.error('Error:', error);
        });

  
 }
 function removeflathouses(access){
  let productid = access.dataset.productId;
  let modeofhouse = access.dataset.modeofHouse;
  let userid =  "<?php echo($_SESSION['userid']); ?>";
  let formData = {
    userid:userid,
    productid:productid,
    modeofhouse:modeofhouse
  };
  
  fetch('../backendhouses/backendremovehouse.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
          if(response.ok){
            alert("Your House Removed Successfuly");
            access.closest('.specific-main-container').remove();
          }
          else{
            alert("Dear Customer Some Thing Went Wrong Please Try To Remove Later");
          }
        })
        .catch(error => {
            console.error('Error:', error);
        });

 }







 function removepghouses(access){
  let productid = access.dataset.productId;
  let userid ="<?php echo($_SESSION['userid']); ?>";
  let modeofhouse = access.dataset.modeofHouse;
  let formData = {
    userid:userid,
    productid:productid,
    modeofhouse:modeofhouse
  };
  
  fetch('../backendhouses/backendremovehouse.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
          if(response.ok){
            alert("Choice Removed Successfuly");
            access.closest('.specific-main-container').remove();
          }
          else{
            alert("Dear Customer Some Thing Went Wrong Please Try To Remove Later");
          }
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