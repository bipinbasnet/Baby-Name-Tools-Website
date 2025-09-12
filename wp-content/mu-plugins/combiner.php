<?php
/*
Plugin Name: Perfect Baby Name Generator
Description: Generate realistic Hindu/Nepali baby names using father’s and mother’s names with phonetic rules.
Version: 3.0
Author: Your Name
*/

function pbn_shortcode() {
    ob_start(); ?>
    <div class="pbn-form" style="max-width:420px;padding:15px;border:1px solid #ddd;border-radius:8px;">
        <label>Father's Name:</label><br>
        <input type="text" id="father_name" style="width:100%;padding:6px;margin:6px 0;"><br>
        <label>Mother's Name:</label><br>
        <input type="text" id="mother_name" style="width:100%;padding:6px;margin:6px 0;"><br>
        <button id="generate_name" style="padding:8px 12px;background:#4CAF50;color:#fff;border:none;border-radius:5px;cursor:pointer;">
            Generate Baby Names
        </button>
        <div id="baby_name_results" style="margin-top:15px;"></div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("generate_name").addEventListener("click", function(){
            let father = document.getElementById("father_name").value.trim();
            let mother = document.getElementById("mother_name").value.trim();
            if(father=="" || mother=="") {
                alert("Please enter both names");
                return;
            }

            function capitalize(word){
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }

            function cleanMerge(a, b) {
                // Avoid double vowels
                if(/[aeiou]$/i.test(a) && /^[aeiou]/i.test(b)) {
                    return a + b.substring(1);
                }
                // Avoid double consonants
                if(!/[aeiou]$/i.test(a) && !/^[aeiou]/i.test(b)) {
                    return a + "a" + b;
                }
                return a + b;
            }

            function generateNames(father, mother) {
                let resultsBoy = [];
                let resultsGirl = [];

                let fStart = father.substring(0,3);
                let fEnd   = father.slice(-3);
                let mStart = mother.substring(0,3);
                let mEnd   = mother.slice(-3);

                // Boy suffixes
                let boySuffixes = ["esh","an","raj","dev","kant","lal","nath","indra"];
                // Girl suffixes
                let girlSuffixes = ["ita","ika","mala","shree","ya","ini","lata","priya"];

                // Base merges
                resultsBoy.push(cleanMerge(fStart, mEnd));
                resultsBoy.push(cleanMerge(mStart, fEnd));
                resultsGirl.push(cleanMerge(fStart, mEnd));
                resultsGirl.push(cleanMerge(mStart, fEnd));

                // Add cultural suffixes
                boySuffixes.forEach(suf => {
                    resultsBoy.push(cleanMerge(fStart, suf));
                    resultsBoy.push(cleanMerge(mStart, suf));
                });
                girlSuffixes.forEach(suf => {
                    resultsGirl.push(cleanMerge(fStart, suf));
                    resultsGirl.push(cleanMerge(mStart, suf));
                });

                // Cleanup
                resultsBoy = resultsBoy.map(n => capitalize(n));
                resultsGirl = resultsGirl.map(n => capitalize(n));
                resultsBoy = [...new Set(resultsBoy)].filter(n => n.length >= 4);
                resultsGirl = [...new Set(resultsGirl)].filter(n => n.length >= 4);

                return {boys: resultsBoy.slice(0,8), girls: resultsGirl.slice(0,8)};
            }

            let names = generateNames(father, mother);
            let html = "<h3>Suggested Baby Names</h3>";
            html += "<strong>Boys:</strong><ul style='list-style:disc;padding-left:18px;'>";
            names.boys.forEach(n => html += "<li>" + n + "</li>");
            html += "</ul>";
            html += "<strong>Girls:</strong><ul style='list-style:disc;padding-left:18px;'>";
            names.girls.forEach(n => html += "<li>" + n + "</li>");
            html += "</ul>";
            document.getElementById("baby_name_results").innerHTML = html;
        });
    });
    </script>
    <?php return ob_get_clean();
}
add_shortcode('perfect_baby_name_generator', 'pbn_shortcode');
