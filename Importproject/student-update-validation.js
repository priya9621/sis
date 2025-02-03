$(document).ready(function(){
    $("#btnupdate").click(function(){
     
       exit();
   
       //Roll No Validation
   
       if($("#rno").val()==""){
           alert("Please Enter Your Roll no!");
           $("#rno").val('');
           $("#rno").focus();
           return false;
       }
   
       // Student Name Validation
   
       if($("#name").val()==""){
           alert("Please Enter Your Name!");
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
   
       // Father Name Validation
   
       if($("#fname").val()==""){
           alert("Please enter your Father Name!");
           $("#fname").focus();
           return false;
       }
   
       // AlphaNumeric Validation
   
       if($.isNumeric($("#fname").val())){
           alert("Please enter Alphanumeric Father Name!");
           $("#fname").val('');
           $("#fname").focus();
           return false;
       }
   
       // Length Validation 
   
       if($("#fname").val().length<3){
           alert("Father Name Must have upto minimum 3 chars!");
           $("#fname").val('');
           $("#fname").focus();
           return false;
       }
   
       //Character Check
   
       if($("#fname").val().match("[!@#$%^&*]")){
           alert("Special Symbol Not Allowed!");
           $("#fname").val('');
           $("#fname").focus();
           return false;
       }
   
       // DOB validation
   
       // empty validation
   
       if($("#dob").val()==""){
           alert("Please Enter Your DOB..!");
           $("#dob").val('');
           $("#dob").focus();
           return false;
       }
   
       //Age Limit validation
   
       if(!($("#dob").val().substring(0,4)<=2004)){
           alert("Candidate must be upto 20 years!");
           $("#dob").val('');
           $("#dob").focus();
           return false;
       }
         
       //  Gender Validation 
   
       if($("#gen").val()==""){
           alert("Please Enter Select Your  Gender!");
           $("#gen").val('');
           $("#gen").focus();
           return false;
       }
   
       // Class Validation
   
       if($("#cls").val()==""){
           alert("Please Enter Your Class!");
           $("#cls").val('');
           $("#cls").focus();
           return false;
       }
   
       // Section Validation
   
       if($("#sec").val()==""){
           alert("Please Select Your Section!");
           $("#sec ").val('');
           $("#sec").focus();
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
   
       //  Teacher Name Validation
   
       if($("#tname").val()==""){
           alert("Please enter your Teacher Name!");
           $("#tname").focus();
           return false;
       }
   
       // AlphaNumeric Validation
   
       if($.isNumeric($("#tname").val())){
           alert("Please enter Alphanumeric Teacher Name!");
           $("#tname").val('');
           $("#tname").focus();
           return false;
       }
   
       // Length Validation
   
        if($("#tname").val().length<3){
           alert("Teacher Name Must have upto minimum 3 chars!");
           $("#tname").val('');
           $("#tname").focus();
           return false;
       }
   
       //Character Check
   
       if($("#tname").val().match("[!@#$%^&*]")){
           alert("Special Symbol Not Allowed!");
           $("#tname").val('');
           $("#tname").focus();
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

       // image 
       if($("#image").val()==""){
        alert("Please Enter Your Image!");
        $("#image").val('');
        $("#image").focus();
        return false;
    }
   
    });
   });