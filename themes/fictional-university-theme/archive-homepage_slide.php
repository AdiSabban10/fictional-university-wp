<?php 

get_header(); 
pageBanner(array(
    'title' => 'All Slides',
    'subtitle' => 'Browse our featured homepage slides.'
));
?>

<div class="container container--narrow page-section">

<ul class="link-list min-list">

<?php 
    while(have_posts()) {
        the_post();
        
        // Get slide title with fallback
        $slideTitle = '';
        if (function_exists('get_field')) {
            $slideTitle = get_field('slide_title');
        }
        if (!$slideTitle) {
            $slideTitle = get_the_title();
        }
        ?>
        <li><a href="<?php the_permalink(); ?>"><?php echo esc_html($slideTitle); ?></a></li>
    <?php }
    echo paginate_links();
?>
</ul>

</div>

<?php get_footer();

?>

