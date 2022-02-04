var redirect;

$('body').on('click', '.btn-action-modal', function (e) {
    e.preventDefault();
  
    var me = $(this),
        title    = me.data('title'),
        url      = me.data('url'),
        btn      = me.hasClass('edit') ? 'Edit' : 'Save',
        modal    = $('#modal');

        $('.modal-btn-save').html('<i class="far fa-save"></i> ' + btn);
        modal.find('#loading').show();
        modal.find('.modal-header #title').text(title);
        modal.find('#content').load(url, function () {
            modal.find('#loading').hide();
          });

        modal.modal('show');
});


$('.btn-save').click(function(e) {
    let me = $(this),
        form = me.closest('#modal').find('form');

        insertOrUpdate(form, form.attr('action'));
});

function insertOrUpdate(form, url) {
  
    form.find('.invalid-feedback').remove();
    form.find('.is-invalid').removeClass('is-invalid');
    $('.loading').show();
    
    $.ajax({
        url :url,
        type : 'POST',
        contentType: false,
        cache: false,
        processData:false,
        data : new FormData(form[0]),
        success : function(response) {
            if (response.redirect) 
                redirect = response.redirect
            
            $('#modal').modal('hide');
            swall('success', 'Success', response.message);

            form.trigger('reset');
        },
        error: function(xhr) {
          $('#modal #loading').hide();
            var res =  xhr.responseJSON;
            swall('error', 'Woops!', res.message, false);
  
            if ($.isEmptyObject(res) == false) {
                if(res.errors) {
                    $.each(res.errors, (key ,value) => {
                        _input = $('#'+ key);
                            
                        _input.addClass('is-invalid');
                        _input.after('<small class="invalid-feedback"><strong>'+ value +'</strong></small>')
                    });
                }
            } 
        },
            complete: function () {
        }
    });
}

$('.delete').click(function() {
    var me  = $(this),
        url = me.data('url'),
        redirect = me.data('redirect'),
        title = me.data('title');
        
    Swal.fire({
        title: title || 'Delete this data?',
        text: "Contact programmer if you want to restore the data",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.value) {
            $('.loading').show();
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    "_token": token,
                    "_method": 'DELETE',
                },
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function (response) {
                    Swal.fire(
                        'Success!',
                        response.message,
                        'success'
                    ).then(() => {
                        window.location.href = response.redirect
                    })
                },
                complete: function() {
                    // $('.loading').hide();
                }
            });
        }
    })
});

function swall(type, title, text) {
    var swal_ = {
        type  : type,
        title : title,
        text  : text,
        timer : 2000
    };

    return Swal(swal_).then(response => {
      if (redirect) {
          window.location.href = redirect
      } else {
          $('.loading').hide();
      }
  });
  }

//show hide modal
function modal(modal, hide = true) {
    if (hide == true) {
        $(modal).modal({
            backdrop: 'static'
        }, 'show');
    } else {
        $(modal).modal('hide');
    }
}