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

<!-- How It Works Section -->
<!-- How It Works Section -->
<section class="how-it-works py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold"><i class="bi bi-gear-fill text-primary me-2"></i>How It Works?</h2>
      <p class="text-muted">Follow these simple steps to generate the perfect Hindu baby name</p>
    </div>
    
    <div class="row g-4 text-center">

      <!-- Step 1: Select Gender -->
      <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-3">
          <div class="icon mb-3">
            <i class="bi bi-gender-ambiguous fs-1 text-primary"></i>
          </div>
          <h5 class="fw-bold">Step 1: Select Gender</h5>
          <p class="text-muted">Choose whether the baby is a Boy or Girl to generate suitable names.</p>
        </div>
      </div>

      <!-- Step 2: Select Nakshatra -->
      <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-3">
          <div class="icon mb-3">
            <i class="bi bi-stars fs-1 text-warning"></i>
          </div>
          <h5 class="fw-bold">Step 2: Select Nakshatra</h5>
          <p class="text-muted">Pick the baby’s Nakshatra (birth star) to get names aligned with Vedic traditions.</p>
        </div>
      </div>

      <!-- Step 3: Select Alphabet Syllables -->
      <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-3">
          <div class="icon mb-3">
            <i class="bi bi-fonts fs-1 text-success"></i>
          </div>
          <h5 class="fw-bold">Step 3: Select Syllables</h5>
          <p class="text-muted">Choose starting syllables based on the Nakshatra selected for meaningful name suggestions.</p>
        </div>
      </div>

      <!-- Step 4: Select Name Type -->
      <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm p-4 rounded-3">
          <div class="icon mb-3">
            <i class="bi bi-bookmarks fs-1 text-danger"></i>
          </div>
          <h5 class="fw-bold">Step 4: Select Name Type</h5>
          <p class="text-muted">Pick whether you want Traditional or Modern Hindu names for the baby.</p>
        </div>
      </div>

    </div>
  </div>
</section>
<!--how it works ends here-->

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

<!--FAQs Section-->
<section id="faq" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold"><i class="fa fa-question-circle" aria-hidden="true"></i>Frequently Asked Questions</h2>
      <p class="text-muted">Find answers about our Hindu Baby Name Generator Tool</p>
    </div>

    <div class="accordion" id="faqAccordion">
      <!-- FAQ Item 1 -->
      <div class="accordion-item mb-3 shadow-sm rounded">
        <h2 class="accordion-header" id="faqHeadingOne">
          <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
            How does the Hindu Baby Name Generator work?
          </button>
        </h2>
        <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Our tool generates meaningful Hindu baby names based on <strong>Nakshatra, syllables, and cultural traditions</strong>. Just select your preferences and get a list of unique names instantly.
          </div>
        </div>
      </div>

      <!-- FAQ Item 2 -->
      <div class="accordion-item mb-3 shadow-sm rounded">
        <h2 class="accordion-header" id="faqHeadingTwo">
          <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
            Are the names based on Hindu astrology?
          </button>
        </h2>
        <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Yes ✅. The names are generated using traditional Hindu <strong>Nakshatra syllables</strong> and cultural practices, making them authentic and meaningful.
          </div>
        </div>
      </div>

      <!-- FAQ Item 3 -->
      <div class="accordion-item mb-3 shadow-sm rounded">
        <h2 class="accordion-header" id="faqHeadingThree">
          <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
            Can I find both modern and traditional names?
          </button>
        </h2>
        <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Absolutely 🙌. The tool suggests a mix of <strong>traditional Sanskrit names</strong> as well as <strong>modern, trendy names</strong> that still hold deep cultural meaning.
          </div>
        </div>
      </div>

      <!-- FAQ Item 4 -->
      <div class="accordion-item mb-3 shadow-sm rounded">
        <h2 class="accordion-header" id="faqHeadingFour">
          <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
            Is this tool free to use?
          </button>
        </h2>
        <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Yes 🎉. The Hindu Baby Name Generator is <strong>100% free to use</strong>. You can search unlimited times without any restrictions.
          </div>
        </div>
      </div>

      <!-- FAQ Item 5 -->
      <div class="accordion-item mb-3 shadow-sm rounded">
        <h2 class="accordion-header" id="faqHeadingFive">
          <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
            How often is the name database updated?
          </button>
        </h2>
        <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            We regularly update the database to include <strong>new, culturally relevant Hindu names</strong> so you always get fresh and authentic suggestions.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--FAQs Section ends here-->
<?php
get_footer();