<!--banner ends-->
<div class="recipes-home-body inner-page">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9">
<aside>
<div class="recipe-set">
<h2>Recent Recipes</h2>
<div class="listing-buttons">
    <span class="grid "><i class="fa fa-th-large"></i></span>
    <span class="list current"><i class="fa fa-bars"></i></span>
</div>


<div class="recipe-listing listing-list">

<?php foreach ($berita as $berita) { ?>
<div class="listing">
    <div class="image">
        <a href="<?php echo base_url('blog/read/'.$berita['slug']) ?>">
            <img src="<?php echo base_url('assets/upload/image/thumbs/'.$berita['gambar']) ?>" alt="image"/>
        </a>
    </div>
    <div class="detail">
        <h4><a href="#"><?php echo $berita['judul'];?></a></h4>
        <p><?php echo  substr (strip_tags($berita['isi']),0,150);?></p>
        <div class="meta-listing">
            <ul class="post-meta"> 
                <i class="fa fa-street-view"></i> <a href="<?php echo base_url('store/read/'.$berita['slug_store']) ?>"><?php echo $berita['nama_toko'];?></a> &nbsp;
                <li class="calendar"><?php echo date('F d',strtotime($berita['tanggal'])) ?>, <?php echo date('Y',strtotime($berita['tanggal'])) ?></li>
            
            </ul>
            <a class="read-more-bordered" href="<?php echo base_url('blog/read/'.$berita['slug']) ?>">Read More</a>
        </div>
    </div>
</div>
<?php } ?>



<div class="paging">
 <?php if(isset($pagin)) { echo $pagin; } ?>    

</div>
</div>
</div>
</aside>
</div>
<div class="col-md-4 col-lg-3">
<aside>
<div class="side-bar">
<!--recipes search widget-->
<?php require_once(APPPATH.'views/pages/type.php');?>
<!--recipes search widget ends-->

<!--latest news widget-->
            <div class="widget latest-news-widget">
                <h2>Latest News</h2>
                <ul>
                <?php foreach ($recent as $recent){?>
                    <li>
                        <div class="thumb">
                            <a href="#">
                                <img src="<?php echo base_url('assets/upload/image/thumbs/'.$recent['gambar']) ?>" alt="thumbnail"/>
                            </a>
                        </div>
                        <div class="detail">
                            <a href="#"><?php echo $recent['judul'];?></a>
                            <span class="post-date"><?php echo date('F d',strtotime($recent['tanggal'])) ?>, <?php echo date('Y',strtotime($recent['tanggal'])) ?></span>
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