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
//extract names based on alphabet
jQuery(document).ready(function ($) {
    // Ensure button exists before attaching
    const btn = $("#generateNamesBtn");
    if (btn.length) {
        btn.on("click", function () {
            $.ajax({
                url: baby_ajax.ajaxurl,
                type: "POST",
                data: {
                    action: "get_baby_names"
                },
                success: function (response) {
                    let tableBody = $("#nameTableBody");
                    tableBody.empty();

                    if (response.success && response.data.length > 0) {
                        $.each(response.data, function (index, item) {
                            let row = `
                                <tr>
                                    <td>${item.name}</td>
                                    <td>${item.meaning}</td>
                                    <td>${item.name_type}</td>
                                    <td>${item.gender}</td>
                                </tr>`;
                            tableBody.append(row);
                        });
                    } else {
                        tableBody.append("<tr><td colspan='4'>No names found.</td></tr>");
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX error:", xhr.responseText);
                }
            });
        });
    }
});
//baby name by alphabet
jQuery(document).ready(function ($) {
    $("#generateNamesBtn").on("click", function () {
        let gender = $("#gender").val();
        let alphabet = $("#alphabet").val();
        let nameType = $("#nameType").val();
        // ✅ Validate required fields
        if (!gender) {
            alert("Please select a Gender.");
            return;
        }
        if (!alphabet) {
            alert("Please select an Alphabet.");
            return;
        }

        $.ajax({
            url: baby_ajax.ajaxurl,
            type: "POST",
            data: {
                action: "get_filtered_names",
                gender: gender,
                alphabet: alphabet,
                name_type: nameType
            },
            success: function (response) {
                let tableBody = $("#nameTableBody");
                tableBody.empty();

                if (response.success && response.data.length > 0) {
                    $.each(response.data, function (index, item) {
                        tableBody.append(`
                            <tr>
                                <td>${item.name}</td>
                                <td>${item.meaning}</td>
                                <td>${item.name_type}</td>
                                <td><span class="heart" style="cursor:pointer;"><i class="fas fa-heart"></i></span></td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.append("<tr><td colspan='3'>No names found.</td></tr>");
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX error:", xhr.responseText);
            }
        });
    });
});
//reset button 
jQuery(function ($) {
  // Reset button click
  $("#resetBtn").on("click", function () {
    // Reset selects to default
    $("#gender").prop("selectedIndex", 0);
    $("#alphabet").prop("selectedIndex", 0);
    $("#nameType").prop("selectedIndex", 0);

    // Clear results table
    $("#nameTableBody").html("<tr><td colspan='4'>Select filters and click \"Generate\".</td></tr>");

    // Clear selected name text (if exists)
    $("#selectedName").text("");

    // Optional: Clear hearts if you want reset to remove favorites too
    $(".heart").removeClass("liked");
  });
});

//heat icon for baby names by alphabet page
 function attachHeart() {
    const hearts = document.querySelectorAll(".heart");
    hearts.forEach(heart => {
        heart.onclick = () => {
            // Remove "liked" from all
            hearts.forEach(h => h.classList.remove("liked"));

            // Add "liked" to clicked heart
            heart.classList.add("liked");

            // Get name from the same row (first cell in table row)
            const row = heart.closest("tr");
            const name = row.querySelector("td:first-child").textContent;
        };
    });
}