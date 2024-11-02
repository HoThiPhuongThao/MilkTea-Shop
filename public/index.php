<?php
require('header.php');
?>

<link rel="stylesheet" href="css/style_index.css">    

    <div class="slideshow-container">

      <div class="mySlides fade">
        <a href="#"><img src="img/banner1.jpg" style="width: 100%; max-height: 500%;"></a>
      </div>
      
      <div class="mySlides fade">
        <a href="#"><img src="img/banner2.jpg" style="width: 100%; max-height: 500%;"></a>
      </div>
      
      <div class="mySlides fade">
        <a href="#"><img src="img/banner3.jpg" style="width: 100%; max-height: 500%;"></a>
      </div>
      
      </div>
      <br> 
      
      <div style="text-align:center">
        <span class="dot"></span>   
        <span class="dot"></span> 
        <span class="dot"></span> 
      </div>
      
    <br><br>
    <table>
        <table class="hidden-table">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th><img src="img/nen2.jpg" alt="Ảnh" class="image2"></th>
                <th>&nbsp&nbsp&nbsp&nbsp</th>

                <th>
                    <h2>Hương Vị Ngọt Ngào Từ Châu Á</h2>
            <p>Trà sữa, một thức uống đã chinh phục trái tim của biết bao người, đặc biệt là giới trẻ. Xuất phát từ Đài Loan, 
                trà sữa là sự kết hợp hoàn hảo giữa trà thơm ngon và sữa béo ngậy, mang đến trải nghiệm vị giác tuyệt vời.<br>
                Mỗi ly trà sữa đều có hương vị riêng, từ trà đen đậm đà đến trà xanh thanh mát. 
                Đặc biệt, topping trân châu dai ngon hay thạch giòn sần sật làm cho mỗi ngụm trà thêm phần thú vị và hấp dẫn.
                Ngoài hương vị, trà sữa còn chứa nhiều chất chống oxy hóa từ trà và canxi từ sữa,
                mang lại những lợi ích cho sức khỏe khi thưởng thức đúng cách. </p>
                
                </th>
              </tr>
              <th>&nbsp&nbsp&nbsp&nbsp</th>
            </thead>
          </table>
          <br><br>
          <table class="hidden-table">
            <thead>
              <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                </th>
                <th>
                    <h2>ĐỘI NGŨ NHÂN VIÊN TRÀN ĐẦY NHIỆT HUYẾT</h2>
            <p>Tại quán trà sữa của chúng tôi, đội ngũ nhân viên không chỉ là người phục vụ mà còn là những người bạn thân thiện. 
                Họ luôn sẵn sàng tư vấn và giúp bạn tìm ra ly trà sữa ưng ý nhất. Được đào tạo bài bản, 
                nhân viên của chúng tôi chuyên nghiệp trong từng quy trình pha chế, từ chọn nguyên liệu đến kỹ thuật pha chế. 
                Họ cũng không ngừng sáng tạo để mang đến những công thức mới và topping độc đáo, khiến mỗi lần ghé thăm đều trở thành 
                trải nghiệm thú vị. Chúng tôi tự hào về đội ngũ nhân viên tận tâm, luôn nỗ lực để bạn có những khoảnh khắc đáng nhớ tại quán. 
                Hãy đến và cảm nhận sự nhiệt huyết của chúng tôi!</p>
                </th>
                <th><img src="img/nen1.jpg" alt="Ảnh" class="image5"></th>
              </tr>
            </thead>
          </table>
          <br><br><br>
    </table>
<div id="backtop">
  <i class="fas fa-chevron-up fa-2x"></i>
</div>
    <script>
      let slideIndex = 0;
      showSlides();
      
      function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 3000);
      }
      </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
<?php
require('footer1.php');
?>