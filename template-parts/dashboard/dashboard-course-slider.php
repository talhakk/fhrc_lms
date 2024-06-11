<section class="dashboard-course-slider">
    <div class="container">
        <div class="inner">
            <div class="head small dashboard-h2">
                <h2>Let’s start learning</h2>
                <div class="swiper-btns">
                    <div class="swiper-button-prev">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="courses-slider-wrapper">
                <div class="swiper-courses-slider swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="course-slider-card">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" class="w-100" alt="">
                                <div class="content">
                                    <p>Reiki Level I, II and Master/Teacher
                                        Program</p>
                                        <h3>1. Introductions</h3>
                                </div>
                                <div class="cta-s">
                                    <a href="" class="pink-btn">Watch lecture</a>
                                    <p class="progress-text">
                                        <span>61%</span> Completed 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="course-slider-card">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" class="w-100" alt="">
                                <div class="content">
                                    <p>Reiki Level I, II and Master/Teacher
                                        Program</p>
                                        <h3>1. Introductions</h3>
                                </div>
                                <div class="cta-s">
                                    <a href="" class="pink-btn">Watch lecture</a>
                                    <p class="progress-text">
                                        <span>61%</span> Completed 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="course-slider-card watched">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" class="w-100" alt="">
                                <div class="content">
                                    <p>Reiki Level I, II and Master/Teacher
                                        Program</p>
                                        <h3>1. Introductions</h3>
                                </div>
                                <div class="cta-s">
                                    <a href="" class="pink-btn">Watch lecture</a>
                                    <p class="progress-text">
                                        <span>61%</span> Completed 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="course-slider-card playing">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" class="w-100" alt="">
                                <div class="content">
                                    <p>Reiki Level I, II and Master/Teacher
                                        Program</p>
                                        <h3>1. Introductions</h3>
                                </div>
                                <div class="cta-s">
                                    <a href="" class="pink-btn">Watch lecture</a>
                                    <p class="progress-text">
                                        <span>12%</span> Finished 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="course-slider-card">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" class="w-100" alt="">
                                <div class="content">
                                    <p>Reiki Level I, II and Master/Teacher
                                        Program</p>
                                        <h3>1. Introductions</h3>
                                </div>
                                <div class="cta-s">
                                    <a href="" class="pink-btn">Watch lecture</a>
                                    <p class="progress-text">
                                        <span>61%</span> Completed 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="course-slider-card">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" class="w-100" alt="">
                                <div class="content">
                                    <p>Reiki Level I, II and Master/Teacher
                                        Program</p>
                                        <h3>1. Introductions</h3>
                                </div>
                                <div class="cta-s">
                                    <a href="" class="pink-btn">Watch lecture</a>
                                    <p class="progress-text">
                                        <span>61%</span> Completed 
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const swiper = new Swiper('.swiper-courses-slider.swiper', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            480: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20
            }
        }
    });
</script>