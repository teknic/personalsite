<div class="categories">
  <h2>Categories</h2>
  <ul>
  <?php foreach($terms as $term): ?>
    <?php echo '<li><a href="/taxonomy/term/' . $term->tid . '">' . $term->name . '<span>' . $term->used . '</span></a></li>'; ?>
  <?php endforeach; ?>
  </ul>
</div>
