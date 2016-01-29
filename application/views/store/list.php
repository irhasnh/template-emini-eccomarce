<!--banner ends-->
<div class="recipes-home-body inner-page">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9">
<div class="recipe-set">
<h2>Store</h2>
<div class="listing-buttons">
    <span class="grid "><i class="fa fa-th-large"></i></span>
    <span class="list current"><i class="fa fa-bars"></i></span>
</div>


<div class="recipe-listing listing-list">

<?php foreach ($store as $berita) { ?>
<div class="listing">
    <div class="image">
        <a href="<?php echo base_url('store/read/'.$berita['slug_store']) ?>">
            <img src="<?php echo base_url('assets/upload/image/'.$berita['gambar']) ?>" width="100%;" alt="image"/>
        </a>
    </div>
    <div class="detail">
        <h4><a href="<?php echo base_url('store/read/'.$berita['slug_store']) ?>"><?php echo $berita['nama_toko'];?></a></h4>
        <p><?php echo  substr (strip_tags($berita['info_toko']),0,150);?></p>
        <div class="meta-listing">
            <ul class="post-meta">
                <i class="fa fa-street-view"></i> <?php echo $berita['alamat'];?> -
                <i class="fa fa-phone"></i> <?php echo $berita['telp_toko'];?>
            </ul>
            <a class="read-more-bordered" href="<?php echo base_url('store/read/'.$berita['slug_store']) ?>">View Store</a>
        </div>
    </div>
</div>
<?php } ?>
</div>
<div class="paging">
     <?php if(isset($pagin)) { echo $pagin; } ?>    
</div>
</div>
</div>
<div class="col-md-4 col-lg-3">
<aside>
<div class="side-bar">
<!--latest news widget-->
            <div class="widget latest-news-widget">
                <h2>Latest Store</h2>
                <ul>
                <?php foreach ($recent as $recent){?>
                    <li>
                        <div class="thumb">
                            <a href="#">
                                <img src="<?php echo base_url('assets/upload/image/thumbs/'.$recent['gambar']) ?>" alt="thumbnail"/>
                            </a>
                        </div>
                        <div class="detail">
                            <a href="<?php echo base_url('store/read/'.$berita['slug_store']) ?>"><?php echo $recent['nama_toko'];?></a>
                           <p><?php echo substr(strip_tags($recent['info_toko']),0,50);?></p>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
<!--latest news widget ends-->
<!--get social-->
                     <?php require_once(APPPATH.'views/pages/get_social.php');?>
<!--get social ends-->
</div>
</aside>
</div>
</div>

</div>
</div>