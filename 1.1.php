<?php 
session_start()

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">

.header{
  width:100%;
  height:500px;
  margin:0 auto;
  border-top:2px solid ;
  border-bottom:2px solid ;
  text-align:center;
  line-height:100px;
  overflow: hidden;
}
.nav{
  flex:0 0 10%;
}
.showBox{

  height:1000px;
  
  width: 100%;

 }
.main{
  width:100%;
  height:1000px;
  margin:20px auto;
  border:2px solid ;
  overflow:hidden;
  display: flex;

}
.footer{
  width:100%;
  height:200px;
  border:2px solid;
  margin-bottom:-100px;
  text-align:center;
  background-color: #EEEEEE;
   margin-top:20px;
}

.fa-instagram:before {
  content: "\f16d";
}

.pagination{
  
  display: flex;
  justify-content: center;
  
}

a{
  color: white;
}



/*.collapseNav{
  width: 70px;
  height: 30px;
  position: fixed;
  text-align: center;
  z-index: 999;

}*/

body{
  padding:70px 0px;
}   

#navigation{
  list-style: none;
  border: 1px solid;
  width: 200px;
  height: 495px;
  position: fixed;
  left: 0;
  top:55%;
  transform: translateY(-50%); 
  border-radius: 10px;
  background-color: #FF9100;
  color: white;
} 

.menu{
  width: 60px;
  height: 30px
  border:1px solid;
  position: relative;
  left: 180px;
  top:220px;
  background-color: #00E676;
  border-radius: 2px;
  text-align: center;
  transform: rotate(90deg);

} 








  </style>
</head>
<body>


  
    <!--  <ul class="nav nav-pills">
    <li><a href="#">Log in</a></li>
    <li><a href="#">Log out</a></li>
  </ul> -->

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid"> 
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Healthy Diets ASAP</a>
    </div>

       

    <ul class="nav nav-pills navbar-nav navbar-right">
    <li><a href="#" ><span class="glyphicon glyphicon-user"></span>  Register</a></li>
    <li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"> Log in</a></li>
  </ul>




    <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">submit</button>
    </form>
    </div>
</nav>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" name="username" placeholder="username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" name="password" placeholder="password" required>
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted">! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

 
  
<div class="header">
  <div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>   
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="image/eat 4.jpg" style="width:100%;height:500px; " alt="First slide"  >
        </div>
        <div class="item">
            <img src="image/eat 5.jpg" style="width:100%;height:500px; " alt="Second slide">
        </div>
        <div class="item">
            <img src="image/eat 6.jpg" style="width:100%;height:500px; " alt="Third slide">
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

</div>


<!-- <div class="panel-group collapseNav" id="accordion">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" 
                href="#collapseTwo">
                Menu
            </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
            <ul class="nav nav-pills nav-stacked ">
          <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
          </ul>
        </div>
        </div>
    </div>
</div> -->
<div id="navigation">

<div class="menu" >
  Menu
</div>
<ul  class="affixMenu nav nav-pills nav-stacked ">
            <li><a href="1.1.php?home_page">Home Page</a></li>
            <li><a href="1.1.php?product_page">Produce Page</a></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            <li><!-- <a href="#"></a> --></li>
            
</ul>



</div>


<div class="main" id="showBox" >

<div class="showBox table-responsive" >
  <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Food</th>
      <th>Specific brand</th>
      <th>Your brand</th>
      <th>Specific size</th>
      <th>Your size</th>
      <th>Your cost</th>
      <th>Comments</th>
      <th>Price Promoted</th>
    </tr>
  </thead>

  <tbody id="table">
    <tr>
      <td></td>
      <td></td>
      
    </tr>
    <tr>
      <td></td>
      <td></td>
      
    </tr>
    <tr>
      <td></td>
      <td></td>
      
    </tr>
  </tbody>
    </table>

</div>


</div>

<div class="pagination-js" id="pagination">
  <ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul>
</div>

<div class="footer">


                      

                        
                      
</div>

<script type="text/javascript">
  $(function() {
                $('#navigation').stop().animate({'marginLeft':'-200px'},1000);

                $('#navigation').hover(
                    function () {
                        $(this).stop().animate({'marginLeft':'-2px'},200);
                    },
                    function () {
                        $(this).stop().animate({'marginLeft':'-200px'},200);
                    }
                );
        });

  if(window.location.search=="?product_page"){

   document.getElementsByClassName("header")[0].style.display="none";
    
  var table=document.getElementById("table").innerHTML;
  table="";
  var temp_table="";
  for(let i=0;i<60;i++){
    temp_table+="<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
  
  }
  table=temp_table;
  document.getElementById("table").innerHTML=table;
}

  if(window.location.search=="?home_page"||window.location.search==""){

    document.getElementById("showBox").style.display="none";
    document.getElementById("pagination").style.display="none";
  }


</script>

</body>
</html>