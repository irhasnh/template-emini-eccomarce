<!--main content area-->
<div class="wrapper-main-contents">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9">
<!--single post-->
<article class="post-single">
<div class="post-visuals">
    <a href="#">
    <style type="text/css">

    </style>
    </a>
</div>
<div class="post-contents">


    <div class="merch_row">
        <div class="merch_img">
            <img src="<?php echo base_url('assets/upload/image/'.$store['gambar']) ?>" style="width:auto; max-width:100%;"/>
        </div>
        <div class="merch_content">  
            <div class="merch_title">
                <div class="merch_name"><?php echo $store['nama_toko'];?></div>
                <p><?php echo $store['alamat'];?></p>
                <div class="view_map"><a href="<?php echo $store['google_map'];?>" target="_blank">View On Google Map</a></div>
            </div>        
        </div>
    </div>
       <div class="tabs-shortcodes">
            <div class="tab-container tab-shortcode">
                <ul class="tabs-nav clearfix">
                    <li class="active"><a href="#">Informasi Umum</a></li>
                    <li><a href="#">Deskripsi</a></li>
                    <li><a href="#">Kontak Toko </a></li>
                </ul>
                <div class="tabs-container">
                    <div class="tab-content">  
                    <h3>Informasi Tempat Usaha</h3><hr> 
                        <p><i class="fa fa-cutlery"></i> &nbsp; <strong>Nama Toko : </strong> <?php echo $store['nama_toko'];?></p>                
                        <p><i class="fa fa-cube"></i> &nbsp; <strong>Jenis Makanan : </strong> <?php echo $store['jenis_makanan'];?></p>                                                        
                        <p><i class="fa fa-paper-plane"></i> &nbsp; <strong>Order Makanan : </strong> <?php echo $store['order_makanan'];?></p>                                                        
                        <p><i class="fa fa-street-view"></i> &nbsp; <strong>Order Tempat : </strong> <?php echo $store['order_tempat'];?></p>
                    </div>
                    <div class="tab-content">
                    <h3>Sekilas Tentang Toko</h3><hr>
                    <p><?php echo $store['info_toko'];?></p>
                    </div>
                    <div class="tab-content">
                    <h3>Informasi Kontak Toko</h3><hr>
                        <p><i class="fa fa-child"></i> &nbsp; <strong>Alamat Toko : </strong><?php echo $store['alamat'];?></p>
                        <p><i class="fa fa-phone"></i> &nbsp; <strong>Telepon Toko : </strong><?php echo $store['telp_toko'];?></p>
                        <p><i class="fa fa-user"></i> &nbsp; <strong>Nama Pengelola : </strong> <?php echo $store['nama_pengelola'];?></p>
                        <p><i class="fa fa-mail-forward"></i> &nbsp; <strong>Email Pengelola : </strong><?php echo $store['email_pengelola'];?></p>
                        <p><i class="fa fa-phone"></i> &nbsp; <strong>Telepon Pengelola : </strong><?php echo $store['telp_pengelola'];?></p>
                        <p><a href="<?php echo $store['google_map'];?>" target="_blank">View On Google Map</a>
                    </div>
                </div>
            </div>
        </div>


<div class="separator-post"></div>
<div class="fb-follow" data-href="https://www.facebook.com/ZetFood-1532787353713972/" data-layout="standard" data-show-faces="true"></div>
<div class="fb-comments" data-width="742"></div>
</article>
<!--single post-->
</div>
<div class="col-md-4 col-lg-3">
    <!--sidebar-->
    <aside>
        <div class="side-bar">
            <!--widget archives ends-->
            <!--latest news widget-->
            <div class="widget latest-news-widget">
                <h2>Latest Store</h2>
                <?php foreach ($recent as $recent){?> 
                <ul>
                    <li>
                        <div class="thumb">
                            <a href="#">
                                <img src="<?php echo base_url('assets/upload/image/thumbs/'.$recent['gambar']) ?>" alt="thumbnail"/>
                            </a>
                        </div>
                        <div class="detail">
                            <a href="<?php echo base_url('store/read/'.$recent['slug_store']) ?>"><?php echo $recent['nama_toko'];?></a>
                            <p><?php echo substr(strip_tags($store['info_toko']),0,50);?></p>
                        </div>
                    </li>
                </ul>
                <?php } ?>
            </div>
            <!--latest news widget ends-->
        </aside>
</div>
</div>
</div>
</div>
