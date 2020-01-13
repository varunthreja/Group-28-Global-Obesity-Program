<?php 
 require_once "include.php" 
?>
<!DOCTYPE php>
<php>
<head>
	<meta charset="UTF-8" />
	<title>Global Obesity Program</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
	<link rel="stylesheet" href="asset.css">
<script>
 $('.menu-item a').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
    });
</script>
</head>
<body onload="alert_cookie()">
	<?php include("header.php")?>
	<div id="body">
            <ul>
                <li>
                    <h1><a href="https://www.globalobesity.com.au">Global Obesity Program</a></h1>
                    <div>
                        <img src="images/global3-360x240.jpeg" alt="Image"  Height= "238"  width= "286"/>
                    </div>
                    <span>Mission: To provide healthy diet under budget and eliminate obesity.</span>
                    <p>We aim to provide a healthy and affordable diet to each and every citizen of Australia.</p>
                    
                </li>
                <li>
                    <?php
                    	if (isset($_COOKIE["username"])){
                    		echo '<h1><a href="product_information.php">Search Products</h1>';
                    	}else{
                    		echo '<h1><a>Search Products</a></h1>';
                    	}
                    ?>
                    <div>
                        <img src="images/cbi2-360x240.jpeg" alt="Image" Height= "238"  width= "286" />
                    </div>
                    <span>Select from a wide range of products</span>
                    <p>Here you can choose from a wide variety of healthy products for yourself and your family.</p>
                   
                        </li>
                <li>
                	<?php
                		if (isset($_COOKIE["username"])){
                    		echo '<h1><a href="productBasket.php">Compare<br>Prices </a></h1>';
                		}else{
                			echo '<h1><a>Compare<br>Prices</a></h1>';
                		}
                    ?>
                    <div>
                        <img src="images/economics-360x240.jpeg" alt="Image"  Height= "238"  width= "286"/>
                    </div>
                    <span>Calculate an affordable price for your everyday diet</span>
                    <p>The data after price comparison is displayed in the form of graphs. You have the freedom to choose from several types of graphs for example, line graph, bar graph, pie-chart and so on.</p>
                    
                </li>
                
            </ul>
        </div>
    <?php include ("footer.php");?>
        </div>

</body>
</php>