<!--main content area-->
<section class="recipes-home-body inner-page">
    <div class="container">
        <div class="recipe-set">
            <h2>Our Locations</h2>
            <div class="contact-container">
                <div class="row">
                    <div class="col-md-4">
                        <section class="contact-option-single">
                            <h3>Customer Service</h3>
                            <ul class="contact-options">
                                <li class="phone"><span>Phone: </span>+62 812 9084 1234</li>
                                <li class="email"><span>Email: </span><a href="#">info@zetfood.com</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="contact-option-single">
                            <h3>Merchant Service</h3>
                            <ul class="contact-options">
                                <li class="phone"><span>Phone: </span>+62 812 9084 1234</li>
                                <li class="email"><span>Email: </span><a href="#">info@zetfood.com</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="contact-option-single">
                            <h3>Other Office</h3>
                            <p>
                                <?php echo $config['alamat'];?>
                            </p>
                            <ul class="contact-options">
                                <li class="phone"><span>Phone: </span>(0251) 8630 955</li>
                                <li class="email"><span>Email: </span><a href="#">zetfood@gmail.com</a></li>
                            </ul>
                        </section>
                    </div>
                </div>

                <div class="separator-post"></div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-option-single">
                            <h3>Quick Contact</h3>
                             <?php 
                                if($this->session->flashdata('sukses')) { 
                             ?>
                            <p class="alert green">
                            <?php echo $this->session->flashdata('sukses') ?>
                            <span class="close-alert"><i class="fa fa-close"></i></span></p>
                            <?php 
                                }if($this->session->flashdata('gagal')) { 
                             ?>
                            <p class="alert red">
                            <?php echo $this->session->flashdata('gagal') ?>
                            <span class="close-alert"><i class="fa fa-close"></i></span></p>
                            <?php } ?>

                            <fieldset>
                                <form action="<?php echo base_url('contact/sendemail');?>" id="contact-form" method="post" novalidate="novalidate">
                                    <input type="text" name="name" placeholder="Nama Lengkap" title="Nama Anda" required/>
                                    <input type="email" name="email" placeholder="Email" title="*enter valid email address" required/>
                                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Pesan Anda" title="*Pesan Anda" required></textarea>
                                    <button type="submit">Kirim Pesan</button>
                                </form>
                            </fieldset>
                            <div class="error-container"></div>
                            <div id="message-sent"></div>
                        </div>
                    </div>
                    <div class="col-md-6">


                        <!--google map-->
                        <div class="contact-option-single">
                            <h3>Find Location on Map</h3>
                            <div class="map-wrapper">
                                <div id="map_canvas"><?php echo $config['google_map'];?>
</div>
                            </div>
                        </div>
                        <!--google map ends-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--main content area-->