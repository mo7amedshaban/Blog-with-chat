<template lang="pug">
.container
  .row
    .col-md-3
      ul.nav.nav-pills.nav-stacked.admin-menu
        li.active
          a(href='' data-target-id='profile')
            i.glyphicon.glyphicon-user
            |  Profile
        li
          a(href='' data-target-id='change-password')
            i.glyphicon.glyphicon-lock
            |  Change Password
        li
          a(href='' data-target-id='settings')
            i.glyphicon.glyphicon-cog
            |  Settings
        li
          a(href='' data-target-id='logout')
            i.glyphicon.glyphicon-log-out
            |  Logout
    #profile.col-md-9.admin-content
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Name
        .panel-body
          | Ashish Patel
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Email
        .panel-body
          | ashishpatel0720@gmail.com
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Last Password Change
        .panel-body
          | 4 days Ago
    #settings.col-md-9.admin-content
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Notification
        .panel-body
          .label.label-success allowed
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Newsletter
        .panel-body
          .badge Monthly
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Admin
        .panel-body
          .label.label-success yes
    #change-password.col-md-9.admin-content
      form(action='/password' method='post')
        .panel.panel-info(style='margin: 1em;')
          .panel-heading
            h3.panel-title
              label.control-label.panel-title(for='new_password') New Password
          .panel-body
            .form-group
              .col-sm-10
                input#new_password.form-control(type='password' name='password')
        .panel.panel-info(style='margin: 1em;')
          .panel-heading
            h3.panel-title
              label.control-label.panel-title(for='confirm_password') Confirm password
          .panel-body
            .form-group
              .col-sm-10
                input#confirm_password.form-control(type='password' name='password_confirmation')
        .panel.panel-info.border(style='margin: 1em;')
          .panel-body
            .form-group
              .pull-left
                input#submit.form-control.btn.btn-primary(type='submit' name='submit')
    #settings.col-md-9.admin-content
    #logout.col-md-9.admin-content
      .panel.panel-info(style='margin: 1em;')
        .panel-heading
          h3.panel-title Confirm Logout
        .panel-body
          | Do you really want to logout ?  
          a.label.label-danger(href='#' onclick="event.preventDefault();\
          document.getElementById('logout-form').submit();")
            span    Yes   
          a.label.label-success(href='/account')
            span   No   
        form#logout-form(action='#' method='POST' style='display: none;')

</template>
<script>
      $(document).ready(function()
      {
        var navItems = $('.admin-menu li > a');
        var navListItems = $('.admin-menu li');
        var allWells = $('.admin-content');
        var allWellsExceptFirst = $('.admin-content:not(:first)');
        allWellsExceptFirst.hide();
        navItems.click(function(e)
        {
            e.preventDefault();
            navListItems.removeClass('active');
            $(this).closest('li').addClass('active');
            allWells.hide();
            var target = $(this).attr('data-target-id');
            $('#' + target).show();
        });
        });
</script>
<style scoped>

</style>
