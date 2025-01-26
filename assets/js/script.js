$(document).ready(function(){
    function preloader_start(loader_text){
        var perloader = $('.preeloader');
        perloader.find('h3').html(loader_text);
        perloader.removeClass('d-none').addClass('d-flex');
    }
    function preloader_end(){
        var perloader = $('.preeloader');
        perloader.find('h3').html('');
        perloader.removeClass('d-flex').addClass('d-none');
    }

    // Ajax Form Submit

    $('.form_submit').click(function(e){
        e.preventDefault();
        var target_form = $(this).data('target-form');
        var method = $(this).data('method');
        var form_action = $(this).data('form-action');

        var formElement = $(target_form)[0];

        if (!formElement.checkValidity()) {
            formElement.reportValidity(); 
            return;
        }
        
        var formData = new FormData(formElement);
        preloader_start('Please Wait...');
        $.ajax({
            url: form_action,  
            type: method,
            data: formData,
            contentType: false, 
            processData: false,
            success: function(response) {
                preloader_end();
                // console.log(response);
                var res_json = JSON.parse(response);
                if (res_json.status === 'error') {
                    $('.validation-error').remove();
                    $.each(res_json.errors, function(key, value) {
                        let parentDiv = $('#'+key).closest('.form-group');
                        parentDiv.append('<span class="validation-error text-danger mt-1 text-start fw-bold">' + value + '</span>');
                    });
                }else if(res_json.status === 'database_error'){
                    $(target_form).prepend("<div class='alert alert-danger'>"+res_json.msg+"</div>")
                }else if(res_json.status === 'redirect'){
                    window.location.href = res_json.url;
                }else if(res_json.status === 'registration_done'){
                    swal.fire({
                        icon:'success',
                        title:'Congratulations!',
                        text:'Your registration is completed now.',
                        confirmButtonText: 'Close',
                    }).then((result) => {
                        window.location.reload();
                    });
                }else{
                    $(target_form).prepend("<div class='alert alert-success'>"+res_json.msg+"</div>")
                    formElement.reset();
                }
                

            },
            error: function(resErrors) {
                preloader_end();
            }
        });
    });

    // Delete Data With Ajax
    $(document).on('click', '.delete-btn', function (e) {

        e.preventDefault(); 
        var target_table = $(this).data('target-table');
        var target_id = $(this).data('target-id');
        var target_msg = $(this).data('target-msg');
        var delete_img = $(this).data('delete-img');

        if (!confirm("Are you sure you want to delete this "+target_msg+"?")) {
            return;
        }
        preloader_start('Deleting...');
        $.ajax({
            url: '../core/data_delete.php',  
            type: 'GET',
            data: {
                'delete':true,
                target_table,
                target_id,
                delete_img
            },
            success: function(response) {
                $("#row-"+response).remove();
                alert(target_msg+" Deleted Successfully!");
                preloader_end();
            },
            error: function(resErrors) {
                preloader_end();
            }
        });
    });
    
});