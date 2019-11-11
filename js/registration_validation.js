/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
function checkPassword(str)
  {
    //The string must contain at least 1 lowercase alphabetical character
    //The string must contain at least 1 uppercase alphabetical character
    //The string must be 6 characters or longer
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
    return re.test(str);
  }

  function checkForm(form)
  {
    //Regular Expression allowed
    re = /^\w+$/;
    if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
      if(!checkPassword(form.pwd1.value)) {
        alert("The password you have entered is not valid!");
        form.pwd1.focus();
        return false;
      }
    }
    if(form.pwd1.value == "" ) {
      alert("Error: Please check that you've entered your password!");
      form.pwd1.focus();
      return false;
    }
    if(form.pwd2.value == ""){
        alert("Error: Please check that you've entered your password!");
      form.pwd2.focus();
      return false;
    }
    if (form.pwd1.value !== form.pwd2.value)
    {
        alert("Check if you entered both passwords correctly")
        form.pwd2.focus();
        return false;
    }
    return true;
  }
function validateEmail(form) 
{
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!filter.test(form.email.value)) {
    alert('Please provide a valid email address');
    form.email.focus();
    return false;
  }
}
*/
function passwordCheck(){
    var errmessage = "";
    //Password regex
    var passcheck = /^[a-zA-Z0-9]+$/i;
    if (document.getElementById("password").disabled === true || document.getElementById("confirm-password").disabled === true){
        return true;
    }
    else{
        var password = document.forms["settings"]["pwd1"].value;
        if(passcheck.test(password) === false || password.length < 6)
        {
            errmessage += "- Password should be alphanumeric with at least 6 characters long\n";
        }
        var pwdcfm = document.forms["settings"]["pwd2"].value;
        if(pwdcfm !== password)
        {
            errmessage += "- Both passwords should be the same\n";
        }
            if (errmessage === "")
        {
            alert("Changing Password...");
            return true;
        }
        else
        {
            alert(errmessage);
            return false;
        }
    }

}
  function validate()
{ 
    //Error message to concat if any
    var errmessage = "";

    var dob = new Date($('#dob').val());
    var day = dob.getDate();
    var month = dob.getMonth() + 1;
    var year = dob.getFullYear();
    var mydate = new Date();
    mydate.setFullYear(year, month, day);
    //Age Restriction
    var ageRest = 18;
    var ageRest1 = 130;
    //Getting the current date
    var currdate = new Date();
    currdate.setFullYear(currdate.getFullYear() - ageRest);
    var currdate1 = new Date();
    currdate1.setFullYear(currdate1.getFullYear() - ageRest1);
    
    //Checking minimum age
    if((currdate - mydate) < 0)
    {
        errmessage += "- Only persons over the age of " + ageRest + " may enter this site\n"
    }
    //Checking maximum age
     if((mydate - currdate1) < -(ageRest1))
    {
        errmessage += "- No person over the age of " + ageRest1 + " is ever alive\n";
    }
    //Email regex
    var emailcheck = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = document.forms["register"]["email"].value;
    if(emailcheck.test(email) === false)
    {
        errmessage += "- Invalid email\n";
    }
    var incomeReg = /^\d+$/;
    var income = document.forms["register"]["income"].value;
    if(incomeReg.test(income) === false)
    {
        errmessage += "- Income should only contain digits\n"
    }
    
    //Password regex
    var passcheck = /^[a-zA-Z0-9]+$/i;
    var password = document.forms["register"]["pwd1"].value;
    if(passcheck.test(password) === false || password.length < 6)
    {
        errmessage += "- Password should be alphanumeric with at least 6 characters long\n";
    }
    var pwdcfm = document.forms["register"]["pwd2"].value;
    if(pwdcfm !== password)
    {
        errmessage += "- Both passwords should be the same\n";
    }
    if (errmessage === "")
    {
        alert("Thank you for registering with us");
        return true;
    }
    else
    {
        alert(errmessage);
        return false;
    }
    
}
//function validateNRIC(str) {
//    //NRIC should always be 9 characters long
//    if (str.length != 9) 
//        return false;
//
//    str = str.toUpperCase();
//
//    var i, 
//        icArray = [];
//    for(i = 0; i < 9; i++) {
//        icArray[i] = str.charAt(i);
//    }
//    //Formula using modulus 11
//    icArray[1] = parseInt(icArray[1], 10) * 2;
//    icArray[2] = parseInt(icArray[2], 10) * 7;
//    icArray[3] = parseInt(icArray[3], 10) * 6;
//    icArray[4] = parseInt(icArray[4], 10) * 5;
//    icArray[5] = parseInt(icArray[5], 10) * 4;
//    icArray[6] = parseInt(icArray[6], 10) * 3;
//    icArray[7] = parseInt(icArray[7], 10) * 2;
//
//    var weight = 0;
//    for(i = 1; i < 8; i++) {
//        weight += icArray[i];
//    }
//
//    var offset = (icArray[0] == "T" || icArray[0] == "G") ? 4:0;
//    var temp = (offset + weight) % 11;
//
//    var st = ["J","Z","I","H","G","F","E","D","C","B","A"];
//    var fg = ["X","W","U","T","R","Q","P","N","M","L","K"];
//
//    var theAlpha;
//    if (icArray[0] == "S" || icArray[0] == "T") { theAlpha = st[temp]; }
//    else if (icArray[0] == "F" || icArray[0] == "G") { theAlpha = fg[temp]; }
//
//    return (icArray[8] === theAlpha);
//}