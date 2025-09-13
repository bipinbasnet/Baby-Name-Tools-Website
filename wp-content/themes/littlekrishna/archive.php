<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LittleKrishna
 */

get_header();
?>

<?php if (function_exists('custom_breadcrumb')) custom_breadcrumb(); ?>
		
<div class="container my-5" id="archive">
	<h2 class="text-center mb-5 archive-title">📚 Blogs</h2>
  <div class="row g-4">

    <?php
    // WP_Query for latest 6 posts
    $args = array(
      'post_type'      => 'post',
      'posts_per_page' => 6
    );
    $query = new WP_Query($args);

    if ($query->have_posts()):
      while ($query->have_posts()): $query->the_post();
        $categories = get_the_category();
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
        $read_time = ceil(str_word_count(strip_tags(get_the_content())) / 200); // ~200 words/min
    ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <?php if (has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top']); ?>
              </a>
            <?php endif; ?>
            <div class="card-body">
            	<div class="d-flex justify-content-between mb-2">
                    <small class="text-muted"><?php echo get_the_date(); ?></small>
                 </div> 
              	<h5 class="card-title">
                	<a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                  		<?php the_title(); ?>
                	</a>
              	</h5>
              <p class="text-primary mb-1"><?php echo $category_name; ?></p>
              <p class="text-muted small mb-0">
                <i class="bi bi-clock"></i> <?php echo $read_time; ?> min read
              </p>
            </div>
            <div class="card-footer d-flex align-items-center">
                <?php echo get_avatar( get_the_author_meta('ID'), 50, '', '', array( 'class' => 'rounded-circle me-2' ) );?>
                <small class="text-muted"><?php the_author(); ?></small>
              </div>
          </div>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    else:
      echo '<p>No posts found.</p>';
    endif;
    ?>

  </div>
</div>



<?php
//get_sidebar();
get_footer();
