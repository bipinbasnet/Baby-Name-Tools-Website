// Wait until the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
  // Step 1: Load Nakshatra data dynamically
  fetch(`${ajaxObject.ajax_url}?action=get_nakshatra`)
    .then(response => response.json())
    .then(data => {
      const dropdown = document.getElementById('nakshatra-dropdown');
      if (data.success && dropdown) {
        data.data.forEach(item => {
          const option = document.createElement('option');
          option.value = item.name.trim().toLowerCase(); // Normalized for matching
          option.textContent = item.name;
          dropdown.appendChild(option);
        });
      }
    })
    .catch(error => {
      console.error("Error loading Nakshatra JSON:", error);
    });
});

// Step 2: Use event delegation to handle dynamically loaded dropdown
document.addEventListener('change', function (e) {
  if (e.target && e.target.id === 'nakshatra-dropdown') {
    const selectedNakshatra = e.target.value.trim().toLowerCase();
    const syllableDropdown = document.getElementById('syllable-dropdown');
    console.log(selectedNakshatra);

    // Clear previous options
    syllableDropdown.innerHTML = '';

    // Fetch syllables JSON
    fetch(`${ajaxObject.ajax_url}?action=get_syllables`)
      .then(response => response.json())
      .then(data => {
        if (data.success && data.data[selectedNakshatra]) {
          const syllables = data.data[selectedNakshatra];

          syllables.forEach(syllable => {
            const option = document.createElement('option');
            option.value = syllable;
            option.textContent = syllable;
            syllableDropdown.appendChild(option);
          });
        } else {
          const option = document.createElement('option');
          option.textContent = 'No syllables found';
          syllableDropdown.appendChild(option);
        }
      })
      .catch(error => {
        console.error("Error loading syllables JSON:", error);
      });
  }
});
//load more and heart icon 
//heart listener function
document.addEventListener('DOMContentLoaded', function () {
    let itemsToShow = 6;
    const selectedNameEl = document.getElementById("selectedName");

    // Attach heart listeners
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

    // Load More functionality
    document.getElementById('loadMore').addEventListener('click', function () {
        itemsToShow += 6;
        document.querySelectorAll('.name-card').forEach(function (card) {
            if (parseInt(card.dataset.index) <= itemsToShow) {
                card.style.display = 'block';
            }
        });

        if (itemsToShow >= document.querySelectorAll('.name-card').length) {
            document.getElementById('loadMore').style.display = 'none';
        }

        attachHeartListeners(); // reattach for new visible items
    });

    // Run on first load
    attachHeartListeners();
});
//test result
