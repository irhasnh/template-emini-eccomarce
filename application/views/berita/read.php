<div class="wrapper-main-contents">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9">
<article class="post-single">
<div class="post-visuals">
<?php
// Session 
if($this->session->flashdata('sukses')) { 
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
} 
?>
    <a href="#">
        <img src="<?php echo base_url('assets/upload/image/thumbs/'.$berita['gambar']) ?>" alt="image"/>
    </a>
</div>
<div class="post-contents">
<div class="post-contents-inner">
<h2><?php echo $berita['judul'];?></h2>
<ul class="news-post-meta post-meta">
    <li><i class="fa fa-calendar"></i> <?php echo date('F d',strtotime($berita['tanggal'])) ?>, <?php echo date('Y',strtotime($berita['tanggal'])) ?></li>

   <li><a href="<?php echo base_url('store/read/'.$berita['slug_store']) ?>"><i class="fa fa-street-view"></i> <?php echo $berita['nama_toko'];?></a></li>
</ul>
<p><?php echo $berita['isi'];?></p>

<ul class="post-tags">
    <li>
        <a href="#">food</a>,
    </li>
    <li>
        <a href="#">potatos</a>,
    </li>
    <li>
        <a href="#">seasonal eats</a>
    </li>
</ul>



<div class="post-comments">
   




    <div class="separator-post"></div>

    <div class="comments-form">
<div class="fb-follow" data-href="https://www.facebook.com/ZetFood-1532787353713972/" data-layout="standard" data-show-faces="true"></div>
<div class="fb-comments" data-width="742"></div>

</div>
</div>
</div>
</article>
</div>
<div class="col-md-4 col-lg-3">
    <!--sidebar-->
    <aside>
        <div class="side-bar">

            <!--widget archives ends-->
            <!--latest news widget-->
            <div class="widget latest-news-widget">
                <h2>Latest News</h2>
                <?php foreach ($recent as $recent){ ?>
                <ul>
                    <li>
                        <div class="thumb">
                            <a href="#">
                                <img src="<?php echo base_url('assets/upload/image/thumbs/'.$recent['gambar']) ?>" alt="thumbnail"/>
                            </a>
                        </div>
                        <div class="detail">
                            <a href="<?php echo base_url('blog/read/'.$recent['slug']) ?>"><?php echo $recent['judul'];?></a>
                            <span class="post-date">March 21,2015</span>
                        </div>
                    </li>
                </ul>
                <?php } ?>
            </div>
            <!--latest news widget ends-->
        </div>
    </aside>
    <!--sidebar ends-->

</div>
</div>
</div>
</div>