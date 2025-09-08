<?php
/**
 * Template Name: Baby Name Page
 */

get_header();
?>
<div class="babynames">
  <div class="container" style="text-align:center;">
  <h2>Find Baby Names</h2>

  <!-- Filter Form -->
  <div class="filters">
    <label for="gender">Gender</label>
    <select id="gender" required>
      <option value="" selected disabled>Select Gender</option>
      <option value="Boy">Boy</option>
      <option value="Girl">Girl</option>
    </select>

    <label for="alphabet">Alphabet</label>
    <select id="alphabet" required>
      <option value="" selected disabled>Select Alphabet</option>
      <?php foreach (range('A', 'Z') as $letter): ?>
        <option value="<?php echo $letter; ?>"><?php echo $letter; ?></option>
      <?php endforeach; ?>
    </select>

    <label for="nameType">Name Type</label>
    <select id="nameType">
      <option value="" selected disabled>Select Name Type</option>
      <option value="Modern">Modern</option>
      <option value="Traditional">Traditional</option>
    </select>
    <div class="actions">
      <button id="generateNamesBtn">Generate</button>
      <button id="resetBtn" type="button">Reset</button>
    </div>
  </div>

  <!-- Results Table -->
  <table border="1" style="margin:20px auto; width:80%; border-collapse:collapse;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Meaning</th>
        <th>Name Type</th>
        <th>Select Your Baby Name</th>
      </tr>
    </thead>
    <tbody id="nameTableBody">
      <tr><td colspan="3">Select filters and click "Generate".</td></tr>
    </tbody>
  </table>
  </div>
</div>
<script>
  renderTable(response.data);
attachHeart(); 

</script>
<?php
get_footer();
?>