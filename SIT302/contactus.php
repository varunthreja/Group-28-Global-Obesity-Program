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
		<div class="container" style="width: 960px">
      <div style="margin-left: auto; margin-right: auto;width:550px;">
        <div style="text-align: center;">
          <h3 style="font-family: Times New Roman, Times, serif; font-size: 32px; color: #7CDEDC;"><u>Contact Us</u></h3>
          <h3 style="font-family: Times New Roman, Times, serif; font-size: 24px; color: #7CDEDC;">Twitter: <a href="https://twitter.com/GLOBE_obesity" target="_blank">@GLOBE_obesity</a><br></h3>
          <h3 style="font-family: Times New Roman, Times, serif; font-size: 24px; color: #7CDEDC;">Website: <a href="https://www.globalobesity.com.au" target="_blank">Global Obesity Centre</a></h3>
        </div>
        <table style="width:500px; text-align: center;margin-left: auto; margin-right: auto">
          <tr>
            <td style="width: 400px;">
              <h3 style="font-family: Times New Roman, Times, serif; font-size: 29px; color: #7CDEDC;">GLOBE Geelong<br></h3>
              <p style="font-size: 16px; font-family: Times New Roman, Times, serif; color: #D8DC6A;">Deakin University<br>Waterfront Campus<br>
              1 Gheringhap St<br>
              Geelong VIC 3220</p>
            </td>
            <td style="width: 400px;">
              <h3 style="font-family: Times New Roman, Times, serif; font-size: 29px; color: #7CDEDC";>GLOBE Burwood</h3>
              <p style="font-size: 16px; font-family: Times New Roman, Times, serif; color: #D8DC6A;">Deakin University<br>Burwood Campus<br>
              221 Burwood Highway<br>
              Burwood Victoria 3125</p>
            </td>
          </tr>
        </table>
        <hr style="border-width: 3px">
        <form action="mailto:jgarbell@deakin.edu.au" method="post">
          <table style="width:500px; margin-left: auto; margin-right: auto;">
            <tr><td colspan="2" style="padding-left: 5px"><h3 style="font-family: Times New Roman, Times, serif; font-size: 29px; color: #7CDEDC;">General Enquiries:</h3><p style="font-size: 16px; font-family: Times New Roman, Times, serif; color: #D8DC6A;">Please feel free to contact us with any enquiries that you may have regarding our work.</p></td></tr>
            <tr>
              <td style="padding-left: 5px;padding-right: 5px"><input class="required form-control" id="fname" name="fname" placeholder="First Name&nbsp;*" type="text"></td>
              <td style="padding-left: 5px;padding-right: 5px"><input class="required form-control" id="lname" name="lname" placeholder="Last Name&nbsp;*" type="text"></td>
            </tr>
            <tr>
              <td style="padding-left: 5px;padding-right: 5px"><input class="required form-control h5-phone" id="contactPhone" name="contactPhone" placeholder="Phone&nbsp;*" type="text"></td>
              <td style="padding-left: 5px;padding-right: 5px"><input class="required form-control h5-email" id="contactEmail" name="contactEmail" placeholder="Email&nbsp;*" type="text"></td>
            </tr>
            <tr>
              <td style="padding-left: 5px;padding-right: 5px" colspan="2"><textarea class="required form-control" id="comment" name="comment" placeholder="Type your message here&nbsp;*" rows="6"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" style="text-align:right"><input type="reset" value="Reset"><input type="submit" value="Send"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
  <?php include ("footer.php");?>
</body>
</php>