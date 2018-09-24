<!DOCTYPE html>
<meta charset="utf-8">
<style> /* set the CSS */
 
body { font: 12px Arial;}
 
path { 
  stroke: steelblue;
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

.legend {
    font-size: 16px;
    font-weight: bold;
    text-anchor: middle;
}
 
</style>

<script>
	

</script>

<?php
$mysqli = mysqli_connect('localhost','root','','scrappertest');

/* check connection */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$query = /*"SELECT collectionDate,price,foodName FROM main AS M
JOIN collections AS C ON M.collectionDate = C.collectionDate
JOIN fooddetails AS F ON M.foodID = F.foodID";*/
'SELECT a.collectionDate, a.price , b.foodName FROM main as a, foodDetails as b WHERE a.foodName = "Bottled water, still" AND a.foodID = b.foodID';

if ($result = mysqli_query($mysqli, $query)) {
  $out = array();

  while ($row = $result->fetch_assoc()) {
    $out[] = $row;
  }

  mysqli_free_result($result);

}

/* close connection*/
$mysqli->close();
?>
<script>
  
  var data = <?php echo json_encode($out); ?>;

</script>


<body>
 

<!-- load the d3.js library -->	
<script src="http://d3js.org/d3.v3.min.js"></script>
 
<script>
 
// Set the dimensions of the canvas / graph
var	margin = {top: 30, right: 20, bottom: 70, left: 50},
	width = 1200 - margin.left - margin.right,
	height = 450 - margin.top - margin.bottom;
 
// Parse the date / time
var	parseDate = d3.time.format("%Y-%m-%d").parse;
 
// Set the ranges
var	x = d3.time.scale().range([0, width]);
var	y = d3.scale.linear().range([height, 0]);
 
// Define the axes
var	xAxis = d3.svg.axis().scale(x)
	.orient("bottom").ticks(5);
 
var	yAxis = d3.svg.axis().scale(y)
	.orient("left").ticks(5);
 
// Define the line
var	valueline = d3.svg.line()
	.x(function(d) { return x(d.collectionDate); })
	.y(function(d) { return y(d.price); });
    
// Adds the svg canvas
var	svg = d3.select("body")
	.append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
	.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
 
// Get the data

	data.forEach(function(d) {
		d.price = +d.price;
		d.collectionDate = parseDate(d.collectionDate);
		
	});

	var nest = d3.nest()
	  .key(function(d){
	    return d.foodName;
	  })
	  .entries(data)
 
	// Scale the range of the data
	x.domain(d3.extent(data, function(d) { return d.collectionDate; }));
	y.domain([0, d3.max(data, function(d) { return d.price; })]);
 
	var color = d3.scale.category10();

	// Add the valueline path.
	// Draw the line
	legendSpace = width/nest.length;

	 nest.forEach(function(d,i) {
	 	svg.append("path")
	      	.attr("class", "line")
	      	.style("stroke", function() { // Add dynamically
                return d.color = color(d.key); })
	      	.attr("id", 'tag'+d.key.replace(/\s+/g, ''))
	      	.attr("d", valueline(d.values));

	    svg.append("text")                                    // *******
            .attr("x", (legendSpace/2)+i*legendSpace) // spacing // ****
            .attr("y", height + (margin.bottom/2)+ 5)         // *******
            .attr("class", "legend")    // style the legend   // *******
            .style("fill", function() { // dynamic colours    // *******
                return d.color = color(d.key); })               
            .text(d.key);                
	 });

	// Add the X Axis
	svg.append("g")		
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis);
 
	// Add the Y Axis
	svg.append("g")		
		.attr("class", "y axis")
		.call(yAxis);


 
</script>
</body>