<?php /* Template Name: Page - FAQs */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php get_template_part('page/page-heroimage') ?>

  <section class="homepage-introduction page-introduction">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-sm-10 offset-sm-1">
          <div class="page-content">
            <?php while(have_posts()): the_post() ?>
              <?php the_content() ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if(is_page('community-faqs')): ?>
  <section class="page-faqs">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="faq-container">
          <?php $_c = 1; ?>
          <div class="accordion" id="faq-accordion">
          <?php while(have_rows('faqs')): the_row(); ?>
            <div class="card">
              <div class="card-header" id="<?php echo 'heading'.$_c ?>">

                <h5 class="mb-0">
                  <button class="btn btn-link <?php if($_c == 1): echo 'open'; endif; ?>" type="button" data-toggle="collapse" data-target="#<?php echo 'collapse'.$_c; ?>" aria-expanded="<?php if($_c == 1): echo 'true'; else: echo 'false'; endif; ?>" aria-controls="<?php echo 'collapse'.$_c; ?>">
                    <span class="indicator <?php if($_c == 1): echo 'active'; endif; ?>">
                      <i class="fas fa-plus"></i>
                    </span>
                    <?php echo get_sub_field('faq_question') ?>
                  </button>
                </h5>
              </div>

              <div id="<?php echo 'collapse'.$_c; ?>" class="collapse <?php if($_c == 1): ?>show<?php endif; ?>" aria-labelledby="<?php echo 'heading'.$_c; ?>" data-parent="#faq-accordion">
                <div class="card-body"><?php echo get_sub_field('faq_answer') ?></div>
              </div>
            </div>
          <?php $_c++; endwhile; ?>
          </div>




          </div>
        </div>
      </div>
    </div>
  </section>

  <?php endif; ?>

<?php get_footer() ?>
