<!--slider main-->
<style>
    .slick-list{
        width:100%;
        top: -10px;
    }
</style>
<section class="wrapper-home-slider variation-two">
    <div class="fluid-slider-var2">
        <div>
            <img src="<?php echo base_url()?>assets/images/temp-images/full-slide-1.jpg" alt="" />
            <div class="container custom-container-slide">
                <div class="slide-detail text-center">
                    <div class="slide-detail-inner">
                        <h2><a href="#"><?php echo $config['judul_1'];?></a></h2>
                        <div class="short-separator"></div>
                        <p><?php echo $config['pesan_1'];?></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <img src="<?php echo base_url()?>assets/images/temp-images/full-slide-2.jpg" alt=""/>
            <div class="container custom-container-slide">
                <div class="slide-detail text-center">
                    <div class="slide-detail-inner">
                        <h2><a href="#"><?php echo $config['judul_2'];?></a></h2>
                        <div class="short-separator"></div>
                        <p><?php echo $config['pesan_2'];?></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <img src="<?php echo base_url()?>assets/images/temp-images/full-slide-3.jpg" alt=""/>
            <div class="container custom-container-slide">
                <div class="slide-detail text-center">
                    <div class="slide-detail-inner">
                        <h2><a href="#"><?php echo $config['judul_3'];?></a></h2>
                            <div class="short-separator"></div>
                        <p><?php echo $config['pesan_3'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--slider main ends-->


<div class="recipes-home-body">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9">

            <!-- Breakfast -->
                <div class="body-contents">

                    <div class="recipe-set">
                        <h2><a href="<?php echo base_url('menu/main_course')?>">Main Course</a></h2>
                        <div class="boxed-recipes text-center">
                            <!--single recipe-->
                            <?php foreach ($ListMc as $ListMc){ ?>
                            <div class="recipe-single animated wow flipInY">
                                <div class="recipe-image">
                                    <a href="<?php echo base_url('blog/read/'.$ListMc['slug']) ?>"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$ListMc['gambar']) ?>" alt="image"/></a>
                                </div>
                                <div class="outer-detail">
                                    <div class="detail">
                                        <h3><a href="<?php echo base_url('blog/read/'.$ListMc['slug']) ?>"><?php echo $ListMc['judul'];?></a></h3>
                                        <p><?php echo substr(strip_tags($ListMc['isi']),0,50);?></p>
                                        <div class="short-separator"></div>
                                        <a class="read-more-bordered" href="<?php echo base_url('blog/read/'.$ListMc['slug']) ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!--single recipe ends-->
                        </div>
                    </div>
                </div>

            <!-- Appetizer -->
            <div class="body-contents">
                    <div class="recipe-set">
                        <h2><a href="<?php echo base_url('menu/starter');?>">Appetizer</a></h2>
                        <div class="boxed-recipes text-center">
                            <!--single recipe-->
                            <?php foreach ($ListAp as $ListAp){ ?>
                            <div class="recipe-single animated wow flipInY">
                                <div class="recipe-image">
                                    <a href="<?php echo base_url('blog/read/'.$ListAp['slug']) ?>"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$ListAp['gambar']) ?>" alt="image"/></a>
                                </div>
                                <div class="outer-detail">
                                    <div class="detail">
                                        <h3><a href="<?php echo base_url('blog/read/'.$ListAp['slug']) ?>"><?php echo $ListAp['judul'];?></a></h3>
                                        <p><?php echo substr(strip_tags($ListAp['isi']),0,50);?></p>
                                        <div class="short-separator"></div>
                                         <a class="read-more-bordered" href="<?php echo base_url('blog/read/'.$ListAp['slug']) ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!--single recipe ends-->
                        </div>
                    </div>
                </div>

                <!-- Dessert --> 

                <div class="body-contents">
                    <div class="recipe-set">
                        <h2><a href="<?php echo base_url('menu/dessert');?>">Dessert</h2>
                        <div class="boxed-recipes text-center">
                            <!--single recipe-->
                            <?php foreach ($ListDs as $ListDs){ ?>
                            <div class="recipe-single animated wow flipInY">
                                <div class="recipe-image">
                                    <a href="<?php echo base_url('blog/read/'.$ListDs['slug']) ?>"><img src="<?php echo base_url('assets/upload/image/thumbs/'.$ListDs['gambar']) ?>" alt="image"/></a>
                                </div>
                                <div class="outer-detail">
                                    <div class="detail">
                                        <h3><a href="<?php echo base_url('blog/read/'.$ListDs['slug']) ?>"><?php echo $ListDs['judul'];?></a></h3>
                                        <p><?php echo substr(strip_tags($ListDs['isi']),0,50);?></p>
                                        <div class="short-separator"></div>
                                        <a class="read-more-bordered" href="<?php echo base_url('blog/read/'.$ListDs['slug']) ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!--single recipe ends-->
                        </div>
                    </div>
                </div>
        <!-- Ends -->
        </div>
        <div class="col-md-4 col-lg-3">
                <aside>
                    <div class="side-bar-home">
                        <div class="side-bar">
                            <!--recipes search widget-->
                     <?php require_once(APPPATH.'views/pages/type.php');?>

                            <!--latest news widget-->
                            <div class="widget latest-news-widget">
                                <h2>Recent Blogs</h2>
                                <ul>
                                    <?php foreach ($recent as $recent){ ?>
                                    <li>
                                        <div class="thumb">
                                            <a href="#">
                                                <img src="<?php echo base_url('assets/upload/image/thumbs/'.$recent['gambar']) ?>" alt="thumbnail"/>
                                            </a>
                                        </div>
                                        <div class="detail">
                                            <a href="<?php echo base_url('blog/read/'.$recent['slug']) ?>"><?php echo $recent['judul'];?></a>
                                            <span class="post-date"><?php echo date('F d',strtotime($recent['tanggal'])) ?>, <?php echo date('Y',strtotime($recent['tanggal'])) ?></span>
                                            <p><?php echo substr(strip_tags($recent['isi']),0,50);?></p>
                                        </div>
                                    </li>
                                    <?php } ?>


                                </ul>
                            </div>
                            <!--latest news widget ends-->

                     <?php require_once(APPPATH.'views/pages/get_social.php');?>



                            <!--get twitter plugin-->
<div class="widget widget-get-social">
<a class="twitter-timeline" href="https://twitter.com/ZetFood" data-widget-id="686005208548118528">Tweets by @ZetFood</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<!-- ends-->
</div>
                        </div>

                    </div>
                </aside>
            </div>
        </div>
        </div>
        
    </div>
    
</div>
