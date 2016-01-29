<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5&appId=1675223276055700";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="banner banner-blog">
    <div class="container ">
        <div class="main-heading">
            <h1><?php echo $page_name;?></h1>
        </div>

    </div>
</div>
<div class="recipes-home-body inner-page">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9">
<div class="recipe-set">
<div class="listing-buttons">
    <span class="grid "><i class="fa fa-th-large"></i></span>
    <span class="list current"><i class="fa fa-bars"></i></span>
</div>
<h2>Latest News <?php echo $page_name;?></h2>

<div class="recipe-listing listing-list">

<?php foreach ($galeri as $rowgal) { ?>
<div class="listing">
    <div class="image">
            <img src="<?php echo base_url('assets/upload/image/thumbs/'.$rowgal['gambar']) ?>" alt="image"/>
        </a>
    </div>
    <div class="detail">
        <h4><a href="#"><?php echo $rowgal['judul'];?></a></h4>
        <p><?php echo  substr (strip_tags($rowgal['keterangan']),0,250);?></p>
        <div class="meta-listing">
            <ul class="post-meta">
                <li class="calendar"><?php echo date('F d',strtotime($rowgal['tanggal'])) ?>, <?php echo date('Y',strtotime($rowgal['tanggal'])) ?></li>
            </ul>
        </div>
    </div>
</div>
<?php } ?>



<ul class="page-nav">
 <?php if(isset($pagin)) { echo $pagin; } ?>    

</ul>
</div>
</div>
</div>
<div class="col-md-4 col-lg-3">
<aside>
<div class="side-bar">
<div class="widget widget-get-social">
    <h2>get social</h2>
    <ul>
        <li class="facebook">
            <a href="<?php echo $config['facebook'];?>">
                <i class="fa fa-facebook"></i>
                <span class="count-type">Likes</span>
            </a>
        </li>
        <li class="twitter">
            <a href="<?php echo $config['twitter'];?>">
                <i class="fa fa-twitter"></i>
                <span class="count-type">Follow</span>
            </a>
        </li>
        <li class="google-plus">
            <a href="<?php echo $config['facebook'];?>">
                <i class="fa fa-instagram"></i>
                <span class="count-type">Follow</span>
            </a>
        </li>

    </ul>
</div>
<!--get social ends-->
</div>
</aside>
</div>
</div>

</div>
</div>