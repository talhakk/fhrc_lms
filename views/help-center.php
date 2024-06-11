<?php /* Template Name: Help Center */ ?>

<?php

get_header();
?>
<div class="dashboard-page">
    <section class="helpcenter">
        <div class="container">
            <div class="inner">
                <div class="head small flex-md-row flex-column align-items-start align-items-md-end">
                    <h2>Freedom House Help Center</h2>
                    <a href="">Go to my Support Requests</a>
                </div>
                <div class="details">
                    <p><strong>What is Freedom House Training system?</strong>Lorem ipsum dolor sit amet consectetur. Ipsum adipiscing in pulvinar eu nisi adipiscing tincidunt. Egestas neque interdum dignissim vitae sem elementum maecenas. Et ultrices faucibus lorem urna commodo in. Diam ipsum amet hendrerit et donec faucibus enim.</p>
                    <p>Lorem ipsum dolor sit amet consectetur. Ipsum adipiscing in
                        pulvinar eu nisi adipiscing tincidunt. Egestas neque interdum dignissim vitae sem elementum maecenas. Et ultrices faucibus lorem urna commodo in. Diam ipsum amet hendrerit
                        et donec faucibus enim.
                        Lorem ipsum dolor sit amet consectetur. Ipsum adipiscing in pulvinar eu nisi adipiscing tinc
                        idunt. Egestas neque interdum di</p>
                </div>
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="contact-us-wrapper">
                            <h3>Still need Help?</h3>
                            <p>We’re here to help. Send us your query and we will respond as soon as possible</p>
                            <a href="/support-submition-form" class="btn">Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="image">
                            <img class="w-100" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/need-help.png'); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
get_footer();
