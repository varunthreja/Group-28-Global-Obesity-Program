<?php 
 require_once "include.php" ;
 error_reporting(0);
?>
<!DOCTYPE php>
<php>
<head>
	<meta charset="UTF-8" />
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<link rel="stylesheet" href="asset.css">
</head>
<body>
	<?php include("header.php");?>
	<div id="body">
    <!-- New code -->
		<div class="container">
<div class="contact-section">
<h2 class="ct-section-head" style="color:#7CDEDC">
   CONTACT US 
</h2>
<div class="row contact-fields">
<div class="col-md-8 left-form">
   <form method="post" action="">
      <div class="form-group">
         <label class="sr-only" for="fname">First Name *</label>
         <input class="required form-control" id="fname" name="fname" placeholder="First Name&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="lname">Last Name *</label>
         <input class="required form-control" id="lname" name="lname" placeholder="Last Name&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contactEmail">Email *</label>
         <input class="required form-control h5-email" id="contactEmail" name="contactEmail" placeholder="Email&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contactPhone">Phone *</label>
         <input class="required form-control h5-phone" id="contactPhone" name="contactPhone" placeholder="Phone&nbsp;*" type="text">
      </div>
      <div class="form-group">
         <label class="sr-only" for="comment">Type your message here</label>
         <textarea class="required form-control" id="comment" name="comment" placeholder="Type your message here&nbsp;*" rows="6"></textarea>
      </div>
      <button class="button btn btn-accent" type="submit">Submit</button>  
   </form>
</div>
<div class="col-md-4 contact-info">
<div class="phone" style="color:#7CDEDC">
   <h2>Call</h2>
   <a href="tel:+4046872730" style="color:white">0300000000</a>
</div>
<div class="email" style="color:#7CDEDC">
   <h2>Email</h2>
   <a href="mailto:info@decidedekalb.com" style="color:white">kathryn@deakin.edu.au</a>
</div>
<div class="location" >
   <h2 style="color:#7CDEDC">Visit</h2>
   <p style="color:white">Global Obesity Center </br>
      Deakin University </br>
      Burwood </br>
      VIC 3125
      <br>
     
   </p>
</div>
   
<?php include ("footer.php");?>

</body>
</php>