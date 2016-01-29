<!--main content area-->
<div class="wrapper-main-contents">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9">
<!--single post-->
<article class="post-single">
<div class="post-visuals">
    <a href="#">
        <img src="<?php echo base_url('assets/upload/image/thumbs/'.$about['gambar']) ?>"/>
    </a>
</div>
<div class="post-contents">
<div class="post-contents-inner">
<h2><a href="#"><?php echo $page_name;?> <?php echo $config['namaweb'];?></a></h2>
<p><?php echo $about['isi'];?>
<br/>
<br/>
</div>
</div>
</article>
<!--single post-->

</div>
<div class="col-md-4 col-lg-3">
    <!--sidebar-->
    <aside>
        <div class="side-bar">
          <div class="widget widget-get-social">
                                <h2>get social</h2>
                                <ul>
                                    <li class="facebook">
                                        <a href="<?php echo $config['facebook'];?>" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                            <span class="count-type">Likes</span>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="<?php echo $config['twitter'];?>" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                            <span class="count-type">Likes</span>
                                        </a>
                                    </li>
                                    <li class="google-plus">
                                        <a href="<?php echo $config['instagram'];?>" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                            <span class="count-type">Likes</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
        </div>
    </aside>
    <!--sidebar ends-->

</div>
</div>

</div>
</div>