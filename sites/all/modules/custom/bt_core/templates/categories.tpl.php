<div class="categories">
  <h2>Categories</h2>
  <?php foreach($terms as $term): ?>
    <?php echo '<a class="" href="/taxonomy/term/' . $term->tid . '">' . $term->name . '<span>' . $term->used . '</span></a>'; ?>
  <?php endforeach; ?>
</div>
