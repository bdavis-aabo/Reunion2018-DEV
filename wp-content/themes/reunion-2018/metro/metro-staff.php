<?php
  $_colors = array('red','blue','gold');
?>

    <div class="row">
      <div class="col-12">
        <h2 class="member-heading">Board Members</h2>
      </div>
    </div>
    <div class="row">
      <?php while(have_rows('staff_members')): the_row(); $_rand = $_colors[array_rand($_colors)]; ?>
        <?php if(get_sub_field('staff_department') == 'board members'): ?>
          <div class="col-12 col-sm-6 col-md-3 w-100">
            <div class="staff-member square">
              <div class="staff-member-details">
                <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
                <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>
              </div>
              <div class="staff-member-email <?php echo $_rand . '-bg' ?>">
                <div class="staff-member-details">
                  <a href="mailto:<?php echo get_sub_field('staff_member_email') ?>"><?php echo get_sub_field('staff_member_email') ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>

    <div class="row">
      <div class="col-12">
        <h2 class="member-heading">Operations</h2>
      </div>
    </div>
    <div class="row">
      <?php while(have_rows('staff_members')): the_row(); $_rand = $_colors[array_rand($_colors)]; ?>
        <?php if(get_sub_field('staff_department') == 'operations'): ?>
          <div class="col-12 col-sm-6 col-md-3 w-100">
            <div class="staff-member square">
              <div class="staff-member-details">
                <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
                <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>
              </div>
              <div class="staff-member-email <?php echo $_rand . '-bg' ?>">
                <div class="staff-member-details">
                  <a href="mailto:<?php echo get_sub_field('staff_member_email') ?>"><?php echo get_sub_field('staff_member_email') ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>

    <div class="row">
      <div class="col-12">
        <h2 class="member-heading">Parks & Irrigation</h2>
      </div>
    </div>
    <div class="row">
      <?php while(have_rows('staff_members')): the_row(); $_rand = $_colors[array_rand($_colors)]; ?>
        <?php if(get_sub_field('staff_department') == 'parks'): ?>
          <div class="col-12 col-sm-6 col-md-3 w-100">
            <div class="staff-member square">
              <div class="staff-member-details">
                <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
                <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>
              </div>
              <div class="staff-member-email <?php echo $_rand . '-bg' ?>">
                <div class="staff-member-details">
                  <a href="mailto:<?php echo get_sub_field('staff_member_email') ?>"><?php echo get_sub_field('staff_member_email') ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>

    <div class="row">
      <div class="col-12">
        <h2 class="member-heading">Recreation</h2>
      </div>
    </div>
    <div class="row">
      <?php while(have_rows('staff_members')): the_row(); $_rand = $_colors[array_rand($_colors)]; ?>
        <?php if(get_sub_field('staff_department') == 'recreation'): ?>
          <div class="col-12 col-sm-6 col-md-3 w-100">
            <div class="staff-member square">
              <div class="staff-member-details">
                <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
                <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>

              </div>
              <div class="staff-member-email <?php echo $_rand . '-bg' ?>">
                <div class="staff-member-details">
                  <a href="mailto:<?php echo get_sub_field('staff_member_email') ?>"><?php echo get_sub_field('staff_member_email') ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>
