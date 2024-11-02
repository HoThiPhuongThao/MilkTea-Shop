<?php
require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <title>Document</title>
    <style> 
        body{
    background: #fee4e0;
    font-family: "Poppins";

}
.content{
    height: 65vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #ff90b3;
    margin-top: 120px; /* Thêm khoảng cách phía trên */
    margin-bottom: 120px; /* Thêm khoảng cách phía dưới */
    
}
.card{
    background:   #f8f3ea;
    width: 300px;
    height: 400px;
    border-radius: 10px;
    text-align: center;
    overflow: hidden;
    margin: 0 20px;
}
img{
    object-fit: cover;
    width: 100%;
    height: 100%;
    object-position: center;
}
.card__img{
    width: 120px;
    height: 120px;
    border: 4px solid #ff90b3;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto;
    transform: translateY(25px);
    transition: 0.5s;
    font-family: 'Poppins', sans-serif;
}
.card h2{
    margin-top: 35px;
}

.card p{
    color: #ff90b3;
}
.card__social{
    margin: 25px 0;
}
.card__social a{
    color: black;
    margin: 25px 20px;
    font-size: 20px;
}
.card__social a:hover{
    color: var(--primary-color);
}
.card button{
    width: 150px;
    height: 40px;
    border: 1px solid var(--primary-color);
    background: transparent;
    color: black;
    border-radius: 10px;
    transition: 0.5s;
}
.card button:hover{
    background: var(--primary-color);
}
.card__img:hover{
    width: 100%;
    height: 100%;
    border-radius: unset;
    transform: unset;
    border: none;
}
.nhap{
    margin-top: 20px;
    text-align: center;
}
.nhap a{
    text-decoration: none;
    color: grey;
    
}

.canchinh{
    display: flex;
}
.canchinh a{
    color: #333;
	text-decoration: none;
}
.loading{
    width: 100%;
    height: 100%;
    background: white;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100000000;
    display: block;
    overflow: hidden;
    opacity: 0.9; /*mờ màn hình*/
  }
  .loading img{
    width: 150px;
    height: 150px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -75px;
    margin-left: -75px;
  }
#backtop{
    width: 50px;
    height: 50px;

    color: #ff2190;
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    bottom: 40px;
    right: 20px;
    cursor: pointer;
}



    </style>
</head>
<body class="preloading">
</div>

    <div class="content">
      
        <div class="card">
            <div class="card__img">
                <img src="../admin/images/PT.JPG" alt="">
            </div>
            <h2>Hồ Thị Phương Thảo</h2>
            <p>Leader</p>
            <div class="card__social">
                <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
                <a href=""><ion-icon name="logo-instagram"></ion-icon></a>
                <a href=""><ion-icon name="logo-github"></ion-icon></a>
            </div>
            <button>Contact me</button>
        </div>
    <br>
    </div>
    <div id="backtop">
      <i class="fas fa-chevron-up fa-2x"></i>
    </div>
    
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(window).on('load', function(event){
        $('body').removeClass('preloading');
        $('.loading').delay(1500).fadeOut('fast');
    });
</script>
<script>
  $(document).ready(function(){
    $(window).scroll(function(){
      if($(this).scrollTop()){
        $('#backtop').fadeIn();
      }else{
        $('#backtop').fadeOut();
      }
    });
    $("#backtop").click(function(){
      $('html, body').animate({scrollTop: 0}, 500)
    });
  });
</script>
</body>
</html>
<?php
require('footer1.php');
?>