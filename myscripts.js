//Validation function. Validates all input form fields
function validateFunction() {

document.getElementById("nameError").innerHTML = "";
document.getElementById("numError").innerHTML = "";
document.getElementById("numError").innerHTML = "";
document.getElementById("mailError").innerHTML = "";
document.getElementById("provError").innerHTML = "";
document.getElementById("cityError").innerHTML = "";

document.getElementById("nameError").style.display = "none";
document.getElementById("numError").style.display = "none";
document.getElementById("mailError").style.display = "none";
document.getElementById("provError").style.display = "none";
document.getElementById("cityError").style.display = "none";

var name, num, email, city, prov, numberLength;
var errorText = "This is a required field. Please make sure you enter your relevant details.";
var count = 0;
    
  name = document.getElementById("name").value;
  num = document.getElementById("number").value;
  email = document.getElementById("email").value;
  city = document.getElementById("city").value;
  prov = document.getElementById("province").value;
  numberLength = document.getElementById("number").value.length;

 var PROVS = {
    EC : {value: 0, name: "Eastern Cape"}, 
    FS: {value: 1, name: "Free State"},
    GT : {value: 2, name: "Gauteng"},
    KZN : {value: 3, name: "KwaZulu-Natal"},
    LM : {value: 4, name: "Limpopo"},
    MP : {value: 5, name: "Mpumalanga"},
    NC : {value: 6, name: "Northern Cape"},
    NW : {value: 7, name: "North West"},
    WC : {value: 8, name: "Western Cape"},
}
 
//Validation and Assign errors

      if (name == ""){
           document.getElementById("nameError").innerHTML = errorText;
           document.getElementById("nameError").style.display = "block";
           count++;
      }
      if (num == ""){
           document.getElementById("numError").innerHTML = errorText;
           document.getElementById("numError").style.display = "block";
           count++;
      }
      else if(num < 0 || isNaN(num) || numberLength != 10 || num[0] != 0){
            document.getElementById("numError").innerHTML = "Please enter a valid mobile number.";
            document.getElementById("numError").style.display = "block";
            count++;
      }

      if (email == ""){
           document.getElementById("mailError").innerHTML = errorText;
           document.getElementById("mailError").style.display = "block";
           count++;
      } 
      else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
      {
            document.getElementById("mailError").innerHTML = "Please enter a valid email address.";
            document.getElementById("mailError").style.display = "block";
            count++;
      }

      if (prov == ""){
           document.getElementById("provError").innerHTML = errorText;
           document.getElementById("provError").style.display = "block";
           count++;
      }
        else if (prov != PROVS.EC.name && prov != PROVS.FS.name && prov != PROVS.GT.name && prov != PROVS.KZN.name && 
        prov != PROVS.LM.name && prov != PROVS.MP.name && prov != PROVS.NC.name && prov != PROVS.NW.name && prov != PROVS.WC.name)//check that prov == 1 of the nine provinces
      {
            document.getElementById("provError").innerHTML = "Please select a valid Province.";
            document.getElementById("provError").style.display = "block";
            count++;
      }

      if (city == ""){
           document.getElementById("cityError").innerHTML = errorText;
           document.getElementById("cityError").style.display = "block";
           count++;
      }

   if (count > 0)
   {
    return false;
   }
   
}

//Length Function for mobile number input. Limits it at 10 digits
function lengthFunc(){
  var numLength = document.getElementById("number").value.length;
  var number = document.getElementById("number").value;
  if (numLength > 10){
    document.getElementById("number").value = number.slice(0, 10);
  }
}


  <!--//TO TOP BUTTON-->

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

<!--//TO TOP BUTTON-->