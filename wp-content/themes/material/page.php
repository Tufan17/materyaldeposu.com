<?php get_header(); ?>
<!-- **Main** -->
<div id="main">
    <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default" style="padding: 100px 0;">
        <div class="elementor-container">
            <div class="elementor-column elementor-col-100">
                <div class="wdt-heading-holder">
                    <h2 class="wdt-heading-title-wrapper wdt-heading-align-center wdt-heading-deco-wrapper">
                        <span class="wdt-heading-title"><?php the_title(); ?></span>
                    </h2>
                    <div class="wdt-heading-separator-wrapper">
                        <div class="wdt-heading-separator with-line"><div class="wdt-separator-line"></div></div>
                    </div>
                </div>
                
                <div style="margin-top: 50px; font-size: 16px; line-height: 1.8; color: #555;">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>
