<?php
get_header();
?>

<?php if (have_posts()) : ?>
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="block">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php
get_footer();
?>