    <div class="row">
      <?php while(have_rows('staff_members')): the_row(); ?>
        <?php if(get_sub_field('staff_department') == 'board members'): ?>
          <div class="col-12 col-sm-6 col-md-3 w-100">
            <div class="staff-member square">
              <div class="staff-member-details">
                <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
                <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>

              </div>
              <div class="staff-member-email"><?php echo get_sub_field('staff_member_email') ?></div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>

<?php /*

    <div class="staff-member-details">
      <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
      <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>

    </div>
    <div class="staff-member-email"><?php echo get_sub_field('staff_member_email') ?></div>

    */ ?>
