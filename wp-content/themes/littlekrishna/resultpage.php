<?php
/**
 * Template Name: Hindu Baby Name Result Page
 */

get_header();

// Get POST values from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';
    $selected_nakshatra = isset($_POST['nakshatra_name']) ? sanitize_text_field($_POST['nakshatra_name']) : '';
    $selected_syllables = isset($_POST['syllables_name']) ? sanitize_text_field($_POST['syllables_name']) : '';
    $name_type = isset($_POST['name_type']) ? sanitize_text_field($_POST['name_type']) : '';
} else {
    wp_redirect(home_url());
    exit;
}
?>

<section class="py-4 bg-light text-center">
  <div class="container">
    <h5>👶 Gender: <strong><?php echo esc_html($gender); ?></strong> | 🔠 Letter: <strong><?php echo esc_html($selected_syllables); ?></strong> | 🏷️ Type: <strong><?php echo esc_html($name_type); ?></strong></h5>
  </div>
</section>

<!-- Name Results -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Suggested Baby Names</h2>
    <div class="row g-4" id="nameCards">
      <!-- AJAX injected cards -->
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-4">
      <button id="loadMore" class="btn btn-outline-primary" style="display:none;">Load More</button>
    </div>

    <!-- Action Buttons -->
    <div class="text-center mt-5">
      <p id="selectedName" class="fw-bold text-primary"></p>
      <button class="btn btn-success me-2">Download as PDF</button>
      <a href="<?php echo home_url(); ?>"><button class="btn btn-outline-secondary">Try Again</button></a>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let offset = 0;
    const limit = 6;
    const nameCards = document.getElementById('nameCards');
    const loadMoreBtn = document.getElementById('loadMore');
    const selectedNameEl = document.getElementById('selectedName');

    function fetchNames() {
        const formData = new FormData();
        formData.append('action', 'fetch_baby_names');
        formData.append('syllables', '<?php echo esc_js($selected_syllables); ?>');
        formData.append('gender', '<?php echo esc_js($gender); ?>');
        formData.append('name_type', '<?php echo esc_js($name_type); ?>');
        formData.append('offset', offset);
        formData.append('limit', limit);

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (data.data.results.length > 0) {
                    data.data.results.forEach(item => {
                        const col = document.createElement('div');
                        col.className = 'col-md-6 col-lg-4';
                        col.innerHTML = `
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">${item.name}</h5>
                                    <p class="card-text text-muted">☀️Meaning of Name: ${item.meaning}</p>
                                    <p class="card-text"><strong>Type:</strong> ${item.name_type}</p>
                                    <span class="heart" style="cursor:pointer;"><i class="fas fa-heart"></i></span>
                                </div>
                            </div>
                        `;
                        nameCards.appendChild(col);
                    });

                    attachHeartListeners();

                    offset += limit;

                    // Show or hide Load More
                    if (data.data.has_more) {
                        loadMoreBtn.style.display = 'inline-block';
                    } else {
                        loadMoreBtn.style.display = 'none';
                    }
                } else {
                    if (offset === 0) {
                        nameCards.innerHTML = '<p class="text-center text-muted">No names found matching your criteria.</p>';
                    }
                    loadMoreBtn.style.display = 'none';
                }
            } else {
                console.error(data.data);
            }
        })
        .catch(err => console.error(err));
    }

    function attachHeartListeners() {
        const hearts = document.querySelectorAll(".heart");
        hearts.forEach(heart => {
            heart.onclick = () => {
                hearts.forEach(h => h.classList.remove("liked"));
                heart.classList.add("liked");
                const name = heart.parentElement.querySelector(".card-title").textContent;
                selectedNameEl.textContent = `You selected: ${name}`;
            };
        });
    }

    loadMoreBtn.addEventListener('click', fetchNames);

    // Initial Load
    fetchNames();
});
</script>

<?php
get_footer();
?>