<?php 
	require_once "include.php";
	if (!isset($_COOKIE['username'])){
		echo '<div class="cover"><h1>Unauthorized <small>Error 401</small></h1><p class="lead">The requested resource requires an authentication.</p><a href="index.php">Return to index</a></div>';
		exit;
	}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Global Obesity Program</title>
    <link rel="stylesheet" type="text/css" href="temp.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ="
        crossorigin="anonymous"></script>
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
          width:50%;
          margin:20px auto;
          border:2px solid darkgray ;
          overflow:hidden;
          display: flex;
          background: #fff;
          color: #000;
        }
        .Input_button{
          width: 100px;
          float: right;
          position: relative;
          right:20px;
        }
        .input{
          width: 100%;
          height: 30px;
        }
    </style>
</head>

<body>
    <?php include("header.php");?>
    <div class="search_form">
        <div class="navbar-form search_box" role="search">
            <div class="form-group">
                <input type="text" id="search_input" name="name" class="form-control search_input" placeholder="Search">
                <button id="search_btn" class="btn btn-default">submit</button>
            </div>


        </div>
    </div>

    <div class="main" id="showBox">

        <div class="showBox table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Food Name</th>
                    </tr>
                </thead>

                <?php
				  $foodName=array();
				  $sql="select * from products";
				  $connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
				  $result=$connect->query($sql);
				  while($row=$result->fetch_assoc()){
					 array_push($foodName, $row["productName"]);
				  }
				 ?>

                <tbody id="table">
                    <?php
						if (isset($_REQUEST['page'])){
							$page=$_REQUEST['page'];
						}else{
							$page=1;
						}
						
						$sql="SELECT productName FROM products ORDER BY productName LIMIT 50 OFFSET ".(($page - 1) * 50);
						$connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
						$result=$connect->query($sql);
						
						while($row=$result->fetch_assoc()){
							echo '<tr><td>'.$row["productName"].'</td></tr>';
						};
					?>
                </tbody>
            </table>


        </div>

    </div>

    <div id='pagination'>
        <?php
			// Need to get the number of pages
			// will be a division statement floored looking at all the products in the database
			$connect=new mysqli(DB_HOST, DB_USER, DB_PWD, DB_TABLENAME);
			$sql="SELECT COUNT(*) FROM products";
			$result=$connect->query($sql);
			while ($row=$result->fetch_assoc()){
				$productCount = $row["COUNT(*)"];
			}
			
			$maxPage = ceil($productCount / 50);
			
			if (!isset($_REQUEST["page"]) or $_REQUEST["page"] == 1){
				$page = 1;
				echo '<ul class="pagination">';
				echo '<li><a href="product_information.php?page=1">&laquo;</a></li>';
				echo '<li><a href="product_information.php?page='.$page.'">'.$page.'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
				echo '<li><a href="product_information.php?page='.ceil($productCount / 50).'">&raquo;</a></li>';
				echo '</ul>';
			}else if ($_REQUEST["page"] == 2){
				echo '<ul class="pagination">';
				echo '<li><a href="product_information.php?page=1">&laquo;</a></li>';
				echo '<li><a href="product_information.php?page='.$page.'">'.$page.'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
				echo '<li><a href="product_information.php?page='.ceil($productCount / 50).'">&raquo;</a></li>';
			}else if ($_REQUEST["page"] == $maxPage - 1){
				echo '<ul class="pagination">';
				echo '<li><a href="product_information.php?page=1">&laquo;</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 1).'">'.($page - 1).'</a></li>';				
				echo '<li><a href="product_information.php?page='.$page.'">'.$page.'</a></li>';
				echo '<li><a href="product_information.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
				echo '<li><a href="product_information.php?page='.ceil($productCount / 50).'">&raquo;</a></li>';
				echo '</ul>';
			}else if ($_REQUEST["page"] == $maxPage){
				echo '<ul class="pagination">';
				echo '<li><a href="product_information.php?page=1">&laquo;</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
				echo '<li><a href="product_information.php?page='.($page - 1).'">'.($page - 1).'</a></li>';				
				echo '<li><a href="product_information.php?page='.$page.'">'.$page.'</a></li>';
				//echo '<li><a href="product_information.php?page='.ceil($productCount / 50).'">&raquo;</a></li>';
				echo '</ul>';
			}else if ($_REQUEST["page"] >= 3){
				echo '<ul class="pagination">';
				echo '<li><a href="product_information.php?page=1">&laquo;</a></li>';
				echo '<li><a href="product_information.php?page='.($_REQUEST["page"] - 2).'">'.($_REQUEST["page"] - 2).'</a></li>';
				echo '<li><a href="product_information.php?page='.($_REQUEST["page"] - 1).'">'.($_REQUEST["page"] - 1).'</a></li>';
				echo '<li><a href="product_information.php?page='.$_REQUEST["page"].'">'.$_REQUEST["page"].'</a></li>';
				echo '<li><a href="product_information.php?page='.($_REQUEST["page"] + 1).'">'.($_REQUEST["page"] + 1).'</a></li>';
				echo '<li><a href="product_information.php?page='.($_REQUEST["page"] + 2).'">'.($_REQUEST["page"] + 2).'</a></li>';
				echo '<li><a href="product_information.php?page='.ceil($productCount / 50).'">&raquo;</a></li>';
				echo '</ul>';
			}
		?>
    </div>
    <?php include ("footer.php");?>
    </div>

    <script type="text/javascript">
        var productName = <?php echo json_encode($foodName) ?>; //php array => json 
        $("#search_input").on("keyup", function () {
            var search_input = $("#search_input").val().toString();
            var result = filterArray(productName, search_input);
            document.getElementById("table").innerHTML = "<tr><td>1<td></tr>";
            var updateTable;
            for (let i = 0; i < result.length; i++) {
                updateTable += '<tr><td>';
                updateTable += result[i];
                updateTable += '</td></tr>';
            }
            document.getElementById("table").innerHTML = updateTable;
            document.getElementById("pagination").innerHTML = "";
        });

        $("#search_btn").on("click", function () {
            var search_input = $("#search_input").val().toString();
            var result = filterArray(productName, search_input);
            document.getElementById("table").innerHTML = "<tr><td>1<td></tr>";
            var updateTable;
            for (let i = 0; i < result.length; i++) {
                updateTable += '<tr><td>';
                updateTable += result[i];
                updateTable += '</td></tr>';
            }
            document.getElementById("table").innerHTML = updateTable;
            document.getElementById("pagination").innerHTML = "";
        })

        function filterArray(array, clue) {
            var resultArray = [];
            for (let i = 0; i < array.length; i++) {
                var testString = array[i].toLowerCase();
                if (testString.indexOf(clue) > -1) {
                    resultArray.push(array[i]);
                }
            }
            return resultArray;
        }
    </script>

</body>

</html>