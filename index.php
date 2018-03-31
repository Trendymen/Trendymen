
   <?php
   include "webtop.php";
   ?>
 <!--菜单栏和图片轮播-->
<div style="margin-left: auto;margin-right: auto;margin-top: 20px;width: 1323px;height:462px;">
    <!--菜单栏-->
    <div style="float: left;width: 318px;height: 462px;">
       <div   class="menu" onclick="window.open('search_result.php?search=上装');"  >
        <img src="images/index/T.svg" height="70" width="70" style="float: left;margin-top:20px;margin-left:30px;"/>
        <p style=";margin-left:30px;color:#333333;">上装</p>
    </div>
        <div class="hr"></div>
    <div class="menu" onclick="window.open('search_result.php?search=下装');" >
        <img src="images/index/裤子.svg" height="70" width="70" style=" float:left;margin-top:20px;;margin-left:30px;"/>
        <p style="margin-left:30px;color:#333333;">下装</p>
    </div>
        <div class="hr"></div>
    <div class="menu" onclick="window.open('search_result.php?search=鞋品');" >
        <img src="images/index/shoes.svg" height="70" width="70" style=" float:left;margin-top:20px;margin-left:30px;"/>
        <p style="margin-left:30px;color:#333333;">鞋品</p>
    </div>
        <div class="hr"></div>
    <div class="menu" onclick="window.open('search_result.php?search=配饰');" >
        <img src="images/index/配饰.svg" height="70" width="70" style=" float:left;margin-top:20px;margin-left:30px;"/>
        <p style="margin-left:30px;color:#333333;">配饰</p>
    </div>
    </div>

    <!--图片轮播-->
    <div id="jquery-script-menu"  > </div>
    <div class="slider" >
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="slide"> <a href="#">
                    <img src="images/index/Z.jpg"/>
                     </a></div>
                <div class="slide"> <a href="#">
                    <img src="images/index/2Q==.jpg"/></a> </div>
                <div class="slide"> <a href="#">
                    <img src="images/index/AzT1cPNBOfPfAAAAAElFTkSuQmCC.png" /></a> </div>

            </div>
        </div>
    </div>
    <script src="src/js/jquery-1.8.3.min.js"></script>
    <script src="src/js/slider.js"></script>
    <script type="text/javascript">
        (function() {
            Slider.init({
                target: $('.slider'),
                time: 6000
            });
        })();
    </script>
    </div>
      

   </div>
<div class="productspromote">
    <?php include ("index_result.php");?>
    <div class="boder"></div>
    <div class="title">
        Trendymen推荐
    </div>
    <div class="boder"></div>
    <!--商品推荐上装-->
    <div style="clear:both; width: 1323px;height: 360px;margin-left: auto;margin-right: auto;position: relative;">
        <p style="width: 1318px;height: 28px; background: linear-gradient(to right,gainsboro,#f6f6f6);font-size: 20px;font-family: 微软雅黑,serif;font-weight: bold;color: #333333;
padding-left: 5px;margin: 0;border-top-left-radius: 8px">
            上装
        </p>

     <?php
     $PPYF=new index_exhibition("上装");//调用类里面的这个函数，显示出HTML
     ?>
    </div>

    <!--商品推荐下装-->
    <div style="clear:both; width: 1323px;height: 360px;margin-left: auto;margin-right: auto;position: relative;top:20px;">
        <p style="width: 1318px;height: 28px; background: linear-gradient(to right,#6633CC,#f6f6f6);font-size: 20px;font-family: 微软雅黑,serif;font-weight: bold;color: #FFFFFF;
padding-left: 5px;margin-bottom: 0;border-top-left-radius: 8px">
            下装
        </p>
        <?php
        $PPXZ=new index_exhibition("下装");//调用类里面的这个函数，显示出HTML
        ?>

    </div>

    <!--商品推荐鞋品-->
    <div style="clear:both; width: 1323px;height: 360px;margin-left: auto;margin-right: auto;position: relative;top:20px;">
        <p style="width: 1318px;height: 28px; background: linear-gradient(to right,#3366CC,#f6f6f6);font-size: 20px;font-family: 微软雅黑,serif;font-weight: bold;color: black;
padding-left: 5px;margin-bottom: 0;border-top-left-radius: 8px">
            鞋品
        </p>
        <?php
        $PPXP=new index_exhibition("鞋品");//调用类里面的这个函数，显示出HTML
        ?>
    </div>

    <!--商品推荐配饰-->
    <div style="clear:both; width: 1323px;height: 360px;margin-left: auto;margin-right: auto;position: relative;top:20px;">
        <p style="width: 1318px;height: 28px; background: linear-gradient(to right,black,#f6f6f6);font-size: 20px;font-family: 微软雅黑,serif;font-weight: bold;color: #ffffff;
padding-left: 5px;margin-bottom: 0;border-top-left-radius: 8px">
            配饰
        </p>
        <?php
        $PPPS=new index_exhibition("配饰");//调用类里面的这个函数，显示出HTML
        ?>
    </div>
</div>
   <?php include ("bottom.html") ?>
  </body>
</html>
