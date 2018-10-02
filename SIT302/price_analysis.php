<?php 
	require_once "include.php";
	if (!isset($_COOKIE['username'])){
		echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
		exit;
	}
?>
<!DOCTYPE php>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Global Obesity Program</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
  <script
  src="https://code.jquery.com/jquery-2.1.1.min.js"
  integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ="
  crossorigin="anonymous"></script>
  <script src="http://d3js.org/d3.v3.min.js"></script>
  <link rel="stylesheet" href="asset.css">
<style type="text/css">
  .header{
    width:50%;
    height:500px;
    margin:0 auto;
    border-radius:10px;
    border-bottom:2px solid ;
    text-align:center;
    line-height:100px;
    overflow: hidden;
  }
  .nav{
    flex:0 0 10%;
  }
  .showBox{


    width: 100%;

   }
  .main{
    width:100%;
    
    margin:20px auto;
    border:2px solid darkgray ;
    overflow:hidden;
    display: flex;

  }

  .button_line{
    width: 100%;
  }

  .Input_button{
    width: 100px;
    float: right;
    position: relative;
    right:20px;
  }

  path {
      stroke: #ccc;
      stroke-width: 2;
      fill: none;
  }

  .axis path,
  .axis line {
      fill: none;
      stroke: grey;
      stroke-width: 1;
      shape-rendering: crispEdges;
  }

  #legendContainer{
    position:absolute;
    top:340px;
    left:20px;
    overflow: auto;
    height:490px;
    width:330px;
  }

  #legend{
    width:330px;
    height:480px;
  }

  .legend {
      font-size: 12px;
      font-weight: normal;
      text-anchor: left;
  }

  .legendcheckbox{
    cursor: pointer;
  }

  input{
    border-radius:5px;
    padding:5px 10px;
    background:#999;
    border:0;
    color:#fff;
  }

  #d3js {
  	text-align: center;
  	display: inline-block;
  	/*margin-left:auto;
  	margin-right:auto;*/
  }
</style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid"> 
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="color:white">Healthy Diet Affordability Evaluator</a>
    </div>
    <div id="user" >
      <?php
          if (isset($_COOKIE["username"])){
             echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="account_setting.php" style="color:white"><span ></span>'.ucfirst($_COOKIE["username"]).'</a></li>
                  <li><a href="logout.php" style="color:white">Log out</a></li></ul>';
          }else{
            echo  '<ul class="nav nav-pills navbar-nav navbar-right"> <li><a href="register.php" style="color:white"><span class="glyphicon glyphicon-user"></span>  Register</a></li>
                  <li><a href="login.php" style="color:white"><span class="glyphicon glyphicon-log-in"> Log in</a></li></ul>';
          }   
      ?>
    </div>
  </div>
</nav>

<div id="page">
  <div id="header">
    <div>
      <a href="index.php"><img src="images/image_GlobalObesity.jpg" alt="Logo" /></a>
    </div>
          
    <ul> 
        <li><a href="index.php"><span>Home</span></a></li>
        <?php  
      		if(isset($_COOKIE["username"])){
      			 echo '<li><a href="account_setting.php"><span>My Account</span></a></li><li><a href="product_detail.php"><span>Product input</span></a></li><li class="current"><a href="price_analysis.php"><span>Price Analysis</span></a></li><li><a href="product_information.php"><span>Products</span></a></li><li><a href="productBasket.php"><span>Basket Analysis</span></a></li>';
      		}
      	?>
      	<li><a href="about.php"><span>About Us</span></a></li>
      	<li><a href="contactus.php"><span>Contact Us</span></a></li>
                 
      	<?php
      		$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
      		$sql = 'SELECT isAdmin FROM users WHERE username = "'.$_COOKIE["username"].'"';
      		$result = $conn->query($sql);
      		if($result->num_rows > 0){
      			$row = $result->fetch_assoc();
      			if($row["isAdmin"] == 1){
      				echo '<li><a href="admin.php"><span>Admin Panel</span></a></li>';
      			}
      		}	
      	?>
    </ul>          
  </div>
</div> 

<div id="jump" class="search_form">    
  <div class="navbar-form search_box" role="search">
    <div class="form-group">
      <input type="text" id="search_input" name="name" class="form-control search_input" placeholder="Search">
    </div>
  </div>    
</div>

<div class="d3js" id="d3js" style="display:none;">
  <div id="legendContainer" class="legendContainer">
    <svg id="legend"></svg>
  </div>
  <script>
    // Set the dimensions of the canvas / graph
    var margin = {top: 50, right: 300, bottom: 30, left: 300},
        width = screen.width - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    // Parse the date / time
    var parseDate = d3.time.format("%Y-%m-%d").parse;

    // Set the ranges
    var x = d3.time.scale().range([0, width]);
    var y = d3.scale.linear().range([height, 0]);

    // Define the axes
    var xAxis = d3.svg.axis().scale(x)
        .orient("bottom").ticks(5)

    var yAxis = d3.svg.axis().scale(y)
        .orient("left").ticks(10);

    // Define the line
    var foodNameline = d3.svg.line()
        .interpolate("cardinal")
        .x(function(d) { return x(d.collectionDate); })
        .y(function(d) { return y(d.price); });

    // Adds the svg canvas
    var svg = d3.select("#d3js")
        .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
        .append("g")
            .attr("transform",
                  "translate(" + margin.left + "," + margin.top + ")");
    var data;

    var color = d3.scale.category10();
  </script>
</div>

<div class="main" id="showBox" >
  <div class="showBox table-responsive"  >
    <table class="table table-bordered table-hover">
      <tbody id="table1" style="overflow-x: auto; height:200px; display: block;">
    		<?php 
          $foodName=array();
    			$sql="select * from foodDetails ORDER BY foodName";
    			$conn=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
    			$results=$conn->query($sql);
          $i=0;
    			while($row=$results->fetch_assoc()){
            array_push($foodName, $row["foodName"]);
            $i++;

      			if($i%5==1){
      			  echo '<tr>';
      			}

      			if($row["foodName"][0]!='"')
      			{
      			  echo '<td><input type="checkbox" name="product" value="'.$row["foodName"].'">'.$row["foodName"].'</td>';
      			}
      			else if($row["foodName"][0]=='"'){
      			  echo '<td><input type="checkbox" name="product" value='.$row["foodName"].' >'.$row["foodName"].'</td>';
      			}

      			if($i%5==0){
      			  echo '</tr>';
      			}
    			}	
    		?>
    	</tbody>
    </table>

    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Start Date</th>
          <th>End Date</th>
        </tr>
      </thead>

      <tbody id="table2">
      	<tr>
      		<?php
      			$sql = "SELECT MIN(collectionDate), MAX(collectionDate) FROM main";
      			$result = $conn->query($sql);
      			while ($row=$result->fetch_assoc()){
      				echo '<td><input type="date" id="start" name="start" min="'.$row["MIN(collectionDate)"].'" max="'.$row["MAX(collectionDate)"].'" value="'.$row["MIN(collectionDate)"].'" required></td>';
      			}
      			$sql = "SELECT MIN(collectionDate), MAX(collectionDate) FROM main";
      			$result = $conn->query($sql);
      			while ($row=$result->fetch_assoc()){
      				echo '<td><input type="date" id="end" name="end" min="'.$row["MIN(collectionDate)"].'" max="'.$row["MAX(collectionDate)"].'" value="'.$row["MAX(collectionDate)"].'" required></td>';
      			}
      		?>
      	</tr>
      </tbody>
    </table>
    <button class="Input_button" id="product_submit" onclick="toggleVisibility()"> Input </button>
  </div>
</div>
      
<div id="footer">
  <div>
    <p class="connect">Join us on <a href="http://facebook.com/" target="_blank">Facebook</a> &amp; <a href="http://twitter.com/" target="_blank">Twitter</a></p>
    <p class="footnote">Copyright &copy; Deakin University. All right reserved.</p>
  </div>
</div>


<script type="text/javascript">
  var button=document.getElementById("product_submit");
  var startDate;
  var endDate;
  var originalSelectValue=["Apples, red, loose"];

	$("#start").change(function(){
	    $("#start").attr("value",$(this).val()); //赋值
	    startDate=$("#start").val();
	});

	$("#end").change(function(){
		$("#end").attr("value",$(this).val()); //赋值
		endDate=$("#end").val();
		if(endDate<startDate){
			alert("endDate must later than startDate");
			button.disabled=true;
		}
	});

  button.addEventListener("click",function(){
    var selectProduct = '';
    $('input:checkbox[name="product"]:checked').each(function(k){
      if(k == 0){
          selectProduct = $(this).val();
      }else{
          selectProduct += "', '"+$(this).val();
      }
    });

    var sql="SELECT b.foodName, a.collectionDate, a.price FROM main AS a, foodDetails AS b WHERE a.foodID  IN (SELECT foodID FROM foodDetails WHERE foodName IN ('"+selectProduct+"')) AND a.foodID = b.foodID AND a.collectionDate BETWEEN '"+start.value+"' AND '"+end.value+"'";
    getJSON(sql);
    window.location.href="price_analysis.php#jump";
  });

	$("#search_input").on("keyup",function(){
		var search_input=$("#search_input").val().toString();
		var result=filterArray(foodName,search_input);
		document.getElementById("table1").innerHTML="";
		var updateTable;
		for(let i=0;i<result.length;i++){
		  if((i+1)%5==1){
		    updateTable+='<tr>';
		  }
		  if(result[i][0]=='"')
		  {
		    updateTable+='<td><input type="checkbox" name="product"  value=';
		    updateTable+=result[i];
		    if(originalSelectValue.indexOf(result[i].slice(1,-1))>-1){
		      updateTable+=' checked="checked">';  
		    }else{
		       updateTable+='>';  
		    }
		  }
		  else{
		    updateTable+='<td><input type="checkbox" name="product" value="';
		    updateTable+=result[i];
		    if(originalSelectValue.indexOf(result[i])>-1){
		      updateTable+='" checked="checked">';  
		    }else{
		       updateTable+='" >';  
		    }
		  }
		  updateTable+=result[i];
		  updateTable+='</td>';
		  if((i+1)%5==0){
		   updateTable+="</tr>";
		  }

		}
	    document.getElementById("table1").innerHTML=updateTable;
	    document.getElementById("pagination").innerHTML="";
	});

 function filterArray(array,clue){
    var resultArray=[];
    for(let i=0;i<array.length;i++){
        var testString=array[i].toLowerCase();
        if(testString.indexOf(clue)>-1){
          resultArray.push(array[i]);
        } 
    }
    return resultArray;
  }

  function toggleVisibility() {
    var x = document.getElementById("d3js");
    if (x.style.display === "none") {
        x.style.display = "block";
    }
  } 

  $("#table1").on("click",function(e){
      var temp=[];
      var e=e||window.event;
      var target=e.target;
      $('input:checkbox[name="product"]:checked').each(function(k){
          if(temp.indexOf($(this).val())==-1){
            temp.push($(this).val());
          }
      });
      //alert(temp);
      originalSelectValue=(JSON.stringify(originalSelectValue) == JSON.stringify(temp))?originalSelectValue:temp;
      
      //alert(originalSelectValue);
      //originalSelectValue.push(selectValue);
  });

  function updateGraph(data) {
    

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.collectionDate; }));
    y.domain([0, d3.max(data, function(d) { return d.price; })]);


    // Nest the entries by foodName
    dataNest = d3.nest()
        .key(function(d) {return d.foodName;})
        .entries(data);


    var result = dataNest;
        
        
    var foodName = svg.selectAll(".line")
      .data(result, function(d){return d.key});

    foodName.enter().append("path")
      .attr("class", "line");

    foodName.transition()
      .style("stroke", function(d,i) { return d.color = color(d.key); })
      .attr("id", function(d){ return 'tag'+d.key.replace(/\s+/g, '');}) // assign ID
      .attr("d", function(d){
    
        return foodNameline(d.values)
      });

    foodName.exit().remove();

    var legend = d3.select("#legend")
      .selectAll("text")
      .data(dataNest, function(d){return d.key});

    //checkboxes
    legend.enter().append("rect")
      .attr("width", 10)
      .attr("height", 10)
      .attr("x", 0)
      .attr("y", function (d, i) { return 0 +i*15; })  // spacing
      .attr("fill",function(d) { 
        return color(d.key);
        
      })
      .attr("class", function(d,i){return "legendcheckbox " + d.key})
      .on("click", function(d){
        d.active = !d.active;
        
        d3.select(this).attr("fill", function(d){
          if(d3.select(this).attr("fill")  == "#ccc"){
            return color(d.key);
          }else {
            return "#ccc";
          }
        })
        
        

      
       // Hide or show the lines based on the ID
       svg.selectAll(".line").data(result, function(d){return d.key})
         .enter()
         .append("path")
         .attr("class", "line")
         .style("stroke", function(d,i) { return d.color = color(d.key); })
        .attr("d", function(d){
                return foodNameline(d.values);
         });
 
      svg.selectAll(".line").data(result, function(d){return d.key}).exit().remove()  
          
      })
            
    // Add the Legend text
    legend.enter().append("text")
      .attr("x", 15)
      .attr("y", function(d,i){return 10 +i*15;})
      .attr("class", "legend");

    legend.transition()
      .style("fill", "#777" )
      .text(function(d){return d.key;});

    legend.exit().remove();

    svg.selectAll(".axis").remove();

    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis.tickFormat(d3.format("$")));
  };

  function filterJSON(json, key, value) {
    var result = [];
    json.forEach(function(val,idx,arr){
        result.push(val)
    })
    return result;
  }

  function getJSON(input){
    $.ajax({
      url: "getdata.php",
      type: "GET",
      data: {
          query: input
      },
      dataType: "json",
      success: function (jsonData) {
        jsonData.forEach(function(d) {
          d.price = +d.price;
          d.collectionDate = parseDate(d.collectionDate);
        });
        updateGraph(jsonData);
      },
      error: function (error) {
        console.log(error);
      }
    });
  }
</script>
</body>
</html>