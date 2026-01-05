<?php   
    
    get_header();

    while(have_posts()) {
        the_post();
        
        // Get slide data with fallbacks
        $slideTitle = '';
        $slideSubtitle = '';
        $slideBgImage = '';
        
        if (function_exists('get_field')) {
            $slideTitle = get_field('slide_title');
            $slideSubtitle = get_field('slide_subtitle');
            $slideBgImage = get_field('slide_background_image');
        }
        
        // Fallback to WP title if ACF title is empty
        if (!$slideTitle) {
            $slideTitle = get_the_title();
        }
        
        // Use slide background image or default
        $bannerPhoto = $slideBgImage ? $slideBgImage : get_theme_file_uri('/images/ocean.jpg');
        
        pageBanner(array(
            'title' => $slideTitle,
            'subtitle' => $slideSubtitle,
            'photo' => $bannerPhoto
        ));
        ?>

        <div class="container container--narrow page-section">
             <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('homepage_slide'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Slides</a> <span class="metabox__main"><?php echo esc_html($slideTitle); ?></span>
                </p>
            </div>
            <div class="generic-content"><?php the_content(); ?></div>
        </div>

        <?php }

    get_footer();
?>

