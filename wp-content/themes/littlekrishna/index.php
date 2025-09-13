<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LittleKrishna
 */

get_header();
?>

<!-- Form Section with Background -->
<section class="form-section">
  <div class="container">
    <div class="form-overlay">
      <h2 class="mb-4 text-center">Hindu Baby Name Generator</h2>
      <form class="row g-3" action="http://localhost/wordpress/hindu-baby-name-by-nakshatra-birth-star/" method="POST">
        <div class="col-md-3">
          <label class="form-label">Gender</label>
          <select name="gender" id="gender" class="form-select" required>
            <option value="">Select Gender</option>
            <option value="Boy">Boy</option>
            <option value="Girl">Girl</option>
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Nakshatra</label>
          <select id="nakshatra-dropdown" name="nakshatra_name" class="form-select">
            <option selected disabled>Select Nakshatra</option>
          </select>

        </div>


        <div class="col-md-3">
          <label class="form-label">Alphabet</label>
          <select id="syllable-dropdown" name="syllables_name" class="form-select mt-2">
            <option selected disabled>Select Syllable</option>
          </select>

        </div>

        <div class="col-md-3">
          <label class="form-label">Traditional/Modern Names</label>
          <select id="nt-dropdown" name="name_type" class="form-select mt-2">
            <option value="Traditional">Traditional Names</option>
            <option value="Modern">Modern Names</option>
          </select>

        </div>

        <div class="col-12 text-center gnt-btn">
          <button type="submit" class="btn btn-primary mt-3">Generate Names</button>
        </div>
      </form>
    </div>
  </div>
</section>



<!-- Popular Baby Names Section -->
<section class="popular-section">
  <div class="container">
    <h2>🔥 Popular Baby Names</h2>
    <div class="table-responsive baby-names-table">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Meaning</th>
            <th>Favorite</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Aarav</td>
            <td>Boy</td>
            <td>Peaceful and wise</td>
            <td><i class="fas fa-heart heart-icon"></i></td>
          </tr>
          <tr>
            <td>Anaya</td>
            <td>Girl</td>
            <td>Caring and compassionate</td>
            <td><i class="fas fa-heart heart-icon"></i></td>
          </tr>
          <tr>
            <td>Vivaan</td>
            <td>Boy</td>
            <td>Full of life</td>
            <td><i class="fas fa-heart heart-icon"></i></td>
          </tr>
          <tr>
            <td>Ishita</td>
            <td>Girl</td>
            <td>Desire, greatness</td>
            <td><i class="fas fa-heart heart-icon"></i></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>


<!-- Blog Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">📚 Latest Blog Posts</h2>
    <div class="row g-4">
      <div class="container my-5">
  <div class="row">
    <?php
      $latest_posts = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'category_name'  => 'blog'
      ) );

      if ( $latest_posts->have_posts() ) :
        while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
          
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top' ) ); ?>
                </a>
              <?php endif; ?>
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted"><?php echo get_the_date(); ?></small>
                 </div>   
                  <h5 class="card-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h5>
                  <p class="card-text text-muted">
                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                  </p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
              </div>
              <div class="card-footer d-flex align-items-center">
                <?php echo get_avatar( get_the_author_meta('ID'), 50, '', '', array( 'class' => 'rounded-circle me-2' ) );?>
                <small class="text-muted"><?php the_author(); ?></small>
              </div>
            </div>
          </div>
        <?php endwhile;
        wp_reset_postdata();
      else :
        echo '<p>No posts found.</p>';
      endif;
    ?>
  </div>
</div>


    </div>
  </div>
</section>

<?php
get_footer();