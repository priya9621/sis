$(document).ready(function(){
    $("#btnupdate").click(function(){
   
       // Staff validation
   
       if($("#staff").val()==""){
           alert("Please Enter Your Staff id!");
           $("#staff").val('');
           $("#staff").focus();
           return false;
       }
   
       // Name Validation
   
          if($("#name").val()==""){
           alert("Please enter your  Name!");
           $("#name").focus();
           return false;
       }
   
       // AlphaNumeric Validation
   
       if($.isNumeric($("#name").val())){
           alert("Please enter Alphanumeric Name!");
           $("#name").val('');
           $("#name").focus();
           return false;
       }
   
        // Length Validation 
   
        if($("#name").val().length<3){
           alert("Name Must have upto minimum 3 chars!");
           $("#name").val('');
           $("#name").focus();
           return false;
       }
   
       //Character Check
   
       if($("#name").val().match("[!@#$%^&*]")){
           alert("Special Symbol Not Allowed!");
           $("#name").val('');
           $("#name").focus();
           return false;
       }
   
       // Designation  Validation
   
          if($("#des").val()==""){
           alert("Please enter your Designation!");
           $("#des").focus();
           return false;
       }
   
       // AlphaNumeric Validation
   
       if($.isNumeric($("#des").val())){
           alert("Please enter Alphanumeric Designation!");
           $("#des").val('');
           $("#des").focus();
           return false;
       }
   
        // Length Validation
   
        if($("#des").val().length<3){
           alert("Designation Must have upto minimum 3 chars!");
           $("#des").val('');
           $("#des").focus();
           return false;
       }
   
       // Character Check
   
       if($("#des").val().match("[!@#$%^&*]")){
           alert("Special Symbol Not Allowed!");
           $("#des").val('');
           $("#des").focus();
           return false;
       }
   
       // Gender Validation 
   
        if($("#gen").val()==""){
           alert("Please Enter Select Your  Gender!");
           $("#gen").val('');
           $("#gen").focus();
           return false;
       }
   
       // Mobile No. Validation
   
       // empty validation
       if($("#mobno").val()==""){
           alert("Please enter your Mobile Number!");
           $("mobno").val('');
           $("#mobno").focus();
           return false;
       }
   
         //Length validation upper value
         if($("#mobno").val().length>10){
           alert("Mobile number must have 10 digit!");
           $("#mobno").val('');
           $("#mobno").focus();
           return false;
       }
   
       //Length validation Lower value
       if($("#mobno").val().length<10){
           alert("Mobile number must have 10 digit!");
           $("#mobno").val('');
           $("#mobno").focus();
           return false;
       }
   
       //Special Number validation
       if(!($("#mobno").val().charAt(0).match("[7,8,9]"))){
           alert("Please enter a valid Mobile number starting with 7, 8, or 9.");
           $("#mobno").val('');
           $("#mobno").focus();
           return false;
       }
   
        // email validaation
   
       //empty vaidation
   
       if($("#email").val()==""){
           alert("Please Enter Your Emaill");
           $("#email").focus();
           return false;
       }
               
       // length validation
   
       if($("#email").val().length<=2){
           alert("Email must have atleast 3 char");
           $("email").val('');
           $("#email").focus();
           return false;
       }
              
              
       //@ validation 
   
       if($("#email").val().indexOf("@")== -1){
           alert("Email must have @ char ");
           $("email").val('');
           $("#email").focus();
           return false;
       }
   
       // . validation
   
       if($("#email").val().indexOf(".")== -1){
           alert("Email must have . dout ");
           $("email").val('');
           $("#email").focus();
           return false;
       }
               
        //  School Name Validation
        if($("#school").val()==""){
           alert("Please enter your School Name!");
           $("#school").focus();
           return false;
       }
   
       // AlphaNumeric Validation
       if($.isNumeric($("#school").val())){
           alert("Please enter Alphanumeric School Name!");
           $("#school").val('');
           $("#school").focus();
           return false;
       }
   
        // Length Validation 
        if($("#school").val().length<3){
           alert("School Name Must have upto minimum 3 chars!");
           $("#school").val('');
           $("#school").focus();
           return false;
       }
   
       //Character Check
       if($("#school").val().match("[!@#$%^&*]")){
           alert("Special Symbol Not Allowed!");
           $("#school").val('');
           $("#school").focus();
           return false;
       }
   
       // Address Validation
   
       if($("#address").val()==""){
           alert("Please Enter Your Address!");
           $("#address").val('');
           $("#address").focus();
           return false;
       }
   
    });
   });