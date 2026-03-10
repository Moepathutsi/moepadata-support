/**
 * Script ( User )
 *
 * @author Shahzaib
 */

"use strict";

$(function () {
  // @version 2.5
  $('.take-field-val').on('click', function () {
    $('#content-ai').val($($(this).data('field-val')).val());
  });

  $('#ai-writer form').on('submit', function () {
    $('#ai-writer .output, #use-ai-response').addClass('d-none');
  });

  $(document).on('click', '.modal-button', function () {
    $('#modal-type').val($(this).data('modal-type'));
  });

  $('#use-ai-response').on('click', function () {
    let field = null;
    let writeFor = $('#where-to-push-ai').val();
    var modalType = $('#modal-type').val();

    if (modalType !== 'none') {
      field = `#${replaceUnderscoreWithDash(writeFor)}-${modalType}`;
    } else {
      let fieldElement = $(`[name='${writeFor}']`);

      if (fieldElement.length > 0) {
        field = `[name='${writeFor}']`;
      } else {
        fieldElement = $(`[data-output-field='${writeFor}']`);

        if (fieldElement.length > 0) {
          field = `[data-output-field='${writeFor}']`;
        }
      }
    }

    if (field) {
      const $field = $(field);

      if ($field.data('is-editor')) {
        $field.summernote('code', `<p>${$('#response-ai').val().replace(/\n/g, '<br>')}</p>`);
      } else {
        $field.val($('#response-ai').val());
      }
    }

    $('#ai-writer').modal('hide');
    $('#ai-writer .output, #use-ai-response').addClass('d-none');
    resetForm($('#ai-writer form'));
  });

  $('#ai-writer').on('hidden.bs.modal', function () {
    $('#ai-writer .output, #use-ai-response').addClass('d-none');
    resetForm($('#ai-writer form'));
  });


  // @version 2.3
  // When the header checkbox is clicked
  $('#checkboxes-toggler').on('change', function () {
    // Check or uncheck all checkboxes based on the header checkbox state
    $('.checkbox-item').prop('checked', $(this).prop('checked'));
    toggleActionBox();
  });

  // If any checkbox is unchecked, uncheck the header checkbox
  $('.checkbox-item').on('change', function () {
    if (!$(this).prop('checked')) {
      $('#checkboxes-toggler').prop('checked', false);
    } else {
      // If all checkboxes are checked, check the header checkbox
      if ($('.checkbox-item:checked').length === $('.checkbox-item').length) {
        $('#checkboxes-toggler').prop('checked', true);
      }
    }

    toggleActionBox();
  });

  $('.todo-checkbox').on('change', function () {
    makeCheckboxRequest($(this));
  });


  // Check for the new notifications:
  // @version 2.1
  $('#notifications-bell').on('click', function () {
    if (typeof limitedNotifications !== 'undefined' && typeof isLoggedIn !== 'undefined') {
      if (!$('.dropdown-notifications').hasClass('show') && isLoggedIn == 1) {
        $('#notifications-empty').removeClass('d-none');
        $('#limited-notifications').html('');

        $.ajax(
          {
            url: limitedNotifications,
            data: { z_csrf: csrfToken },
            method: 'POST',
            success: function (response) {
              response = jsonResponse(response);

              if (response.status === 'html') {
                $('#notifications-empty').addClass('d-none');
                $('#limited-notifications').html(response.value);
              }
              else if (response.status === 'jump') {
                window.location = response.value;
                return false;
              }
            }
          });
      }
    }
  });


  // Options management for the envato ticketing settings:
  // @version 2.0
  $('#ask-tickets-pc').on('change', function () {
    if (this.value === '1') {
      $('#ask-tickets-pc-child').addClass('d-block');
      $('#ask-tickets-pc-child').removeClass('d-none');
    }
    else {
      $('#ask-tickets-pc-child').addClass('d-none');
      $('#ask-tickets-pc-child').removeClass('d-block');
    }
  });

  $('#ask-chat-pc').on('change', function () {
    if (this.value === '1') {
      $('#ask-chat-pc-child').addClass('d-block');
      $('#ask-chat-pc-child').removeClass('d-none');
    }
    else {
      $('#ask-chat-pc-child').addClass('d-none');
      $('#ask-chat-pc-child').removeClass('d-block');
    }
  });


  // Alert box management for the guest ticketing option:
  // @version 1.6
  $('#guest-ticketing').on('change', function () {
    if (this.value === '1') {
      $('#guest-ticketing-alert').addClass('d-block');
      $('#guest-ticketing-alert').removeClass('d-none');
    }
    else {
      $('#guest-ticketing-alert').addClass('d-none');
      $('#guest-ticketing-alert').removeClass('d-block');
    }
  });


  // On the page load, move the scroll down of that box
  // where the chat messages are displayed:
  // @version 1.4
  chatScrollDown('#chat-box-body');


  if ($(window).width() < 768) {
    $('body').removeClass('layout-fixed layout-navbar-fixed');
  }


  // Manage modal ( get data ) by sending the ajax request:
  $('.z-table, .z-card').on('click', function (event) {
    var $element = $(event.target);
    var isFine = true;
    var source = '';

    /**
     * The element you want to use to send a request to read some data from the server,
     * must have a class "get-data-tool".
     *
     * If the requesting element is the child of "get-data-tool" class, add the
     * "get-data-tool-c" class also to the child element.
     *
     * The element that is having "get-data-tool" class, must have these attributes:
     * "data-id" Record ID
     *
     * "data-reference" Area/Controller name e.g. admin/tools
     * "data-requirement" Data requirement
     *
     * OR
     *
     * "data-source" Full URL
     */

    if ($element.hasClass('get-data-tool-c')) {
      $element = $element.parent('.get-data-tool');
    }
    else {
      if (!$element.hasClass('get-data-tool')) {
        isFine = false;
      }
    }

    if (isFine === true) {
      var dataSource = $element.attr('data-source');
      var dataID = $element.attr('data-id');


      if (!dataSource) {
        var dataReference = $element.attr('data-reference');
        var dataRequirement = $element.attr('data-requirement');

        /**
         * The request receiver controller must be inside the "actions/" directory.
         * The receiver controller must have a method called "read()".
         *
         * @global string baseURL ( with slash at the end )
         */
        source = baseURL + 'actions/' + dataReference + '/read/';
        source += dataRequirement;
      }
      else {
        source = $element.attr('data-source');
      }

      if (source !== '') {
        getRecord(dataID, source, $element);
      }
      else {
        console.log('Invalid Source');
      }
    }
  });


  // Tooltip:
  $('[data-toggle="tooltip"]').tooltip();


  // Popover:
  $('[data-toggle="popover"]').popover(
    {
      trigger: 'focus'
    });


  /**
   * jQuery Upload Preview
   *
   * @global string changeFile
   */
  var jupJson = {
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  };

  if (typeof changeFile !== 'undefined') {
    jupJson.label_selected = changeFile;
  }

  if (typeof chooseFile !== 'undefined') {
    jupJson.label_default = chooseFile;
  }

  $.uploadPreview(jupJson);


  // Prevent Checkbox to Mark as Checked:
  $('.prevent-cb').on('click', function (event) {
    if (!$(this).is(':checked')) {
      event.preventDefault();
    }
  });


  /**
   * Fields management for the email settings page.
   *
   * @global string eProtocol
   */
  if (typeof eProtocol !== 'undefined') {
    if (eProtocol === 'smtp') {
      $('.smtp-field').css('display', 'block');
    }
  }

  $('#protocol').on('change', function () {
    if (this.value === 'smtp') {
      $('.smtp-field').css('display', 'block');
    }
    else {
      $('.smtp-field').css('display', 'none');
    }
  });


  // Fields management for the departement modals:
  $(document).on('change', 'select.d-users-selection', function () {
    if (this.value == 1) {
      $('.select-users-wrapper').css('display', 'block');
    }
    else {
      $('.select-users-wrapper').css('display', 'none');
    }
  });


  // Get canned replies based on user selection:
  $(document).on('change', 'select#canned-reply', function () {
    $.ajax(
      {
        url: $(this).attr('data-action'),
        data: { z_csrf: csrfToken, reply_id: this.value },
        method: 'POST',
        success: function (response) {
          response = jsonResponse(response);

          if (response.status !== 'true') {
            if (response.status === 'jump') {
              window.location = response.value;
              return false;
            }

            showResponseMessage($('.add-reply-admin'), response.value, 0);
          }
          else {
            var yourReplyArea = $('textarea#your-reply');

            yourReplyArea.val(yourReplyArea.val() + response.value);
          }
        }
      });
  });


  // Manage the state (e.g. collapsed) of sidebar menu:
  if ($.isFunction($.cookie)) {
    $('.sidebar-toggle').on('click', function () {
      var collapsed = 1;

      if ($.cookie(sidebarCookie) == 1) collapsed = 0;

      $.cookie(sidebarCookie, collapsed, { expires: 365, path: '/' });
    });
  }


  // Take backup form behaviour management:
  $('#backup-action').on('change', function () {
    if (this.value == 1) {
      $('#take-backup-form').removeClass('form');
    }
    else {
      $('#take-backup-form').addClass('form');
    }
  });


  // Summernote:
  readySummernote();
});
