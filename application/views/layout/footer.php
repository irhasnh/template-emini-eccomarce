<div class="cd-overlay"></div>
    <nav class="cd-nav">
        <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
            <li><a href="<?php echo base_url('home');?>" class="<?php echo activate_menu('home'); ?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo base_url('blog');?>" class="<?php echo activate_menu('blog'); ?>" title="Blogs"><i class="fa fa-newspaper-o"></i> Blogs</a></li>
            <li><a href="<?php echo base_url('store');?>" class="<?php echo activate_menu('store'); ?>" title="Store"><i class="fa fa-cutlery"></i> Store</a></li>
            <li><a href="<?php echo base_url('contact');?>" class="<?php echo activate_menu('contact'); ?>" title="Contact"><i class="fa fa-phone"></i> Contact</a></li>                     
        </ul> <!-- primary-nav -->
    </nav> <!-- cd-nav -->
    <div id="cd-search" class="cd-search">
        <form action="<?php echo base_url('store/search');?>" method="post">
            <input type="search" name="cari" placeholder="Search...">
        </form>
    </div>


<!--footer-->
<div class="animate-footer footer footer-variant-two footer-fluid">
    <div class="container">
        <div class="footer-inner">
            <div class="subs-social-options">
                <div class="row">
                    <div class="col-md-4">
                        <div class="widget latest-news-widget">
                            <h2>Navigations</h2>
                            <ul>
                                <li><a href="<?php echo base_url('blog');?>">Blogs</a></li>
                                <li><a href="<?php echo base_url('gallery');?>">Gallery</a></li>
                                <li><a href="<?php echo base_url('about')?>">About Us</a></li>
                                <li><a href="<?php echo base_url('contact');?>">Contact Us</a></li>
                              </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget twitter-widget">
                            <h2>Little About ZetFood</h2>
                                <p><?php echo $site['tentang'];?>
                        </div>

                    </div>
                    <div class="col-md-4">


                        <div class="widget widget-footer news-letter-signup">
                            <h2>Newsletter Signup</h2>
                            <p>
                                Get notified eachtime we add our new recipe.
                            </p>
                            <form class="subs-form" action="#" method="post">
                                <div class="email-field">
                                    <input type="email" name="email" placeholder="Enter you email address"/>
                                    <button><i class="fa fa-paper-plane-o"></i></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


            </div>
            <div class="footer-copyright var1">
                <div class="row">
                    <div class="col-md-6 wow animated slideInLeft">
                        <p>&copy; Copyright <?php echo $site['namaweb'];?></p>

                    </div>
                    <div class="col-md-6 wow animated slideInRight">
                        <div class="footer-social-icons ">
                            <ul>
                                <li><a href="<?php echo $site['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?php echo $site['twitter'];?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?php echo $site['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer ends-->

<script src="<?php echo base_url()?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url()?>assets/js/slick.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.meanmenu.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.selectric.min.js"></script>
<script src="<?php echo base_url()?>assets/js/wow.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.swipebox.js"></script>
<script src="<?php echo base_url()?>assets/js/custom.js"></script>
<script src="<?php echo base_url()?>assets/js/main.js"></script>    
</body>
</html>