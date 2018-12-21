<section class="metro-boxes">
  <div class="container">
    <div class="row no-gutters row-eq-height">
    <?php while(have_rows('district_documents')): the_row(); ?>
      <div class="col-12 col-sm-6">
        <div class="metro-box-contents">
          <h2><?php echo get_sub_field('document_section_title') ?></h2>
          <?php echo get_sub_field('document_section_body') ?>
        </div>
      </div>
    <?php endwhile; ?>
    </div>
  </div>
</section>
