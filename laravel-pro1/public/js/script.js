$(document).ready(function(){
    $("#addSubject").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "{{route('addSubject')}}",
            type: "post",
            data: formData,
            success: function(data){
                if(data.success==true){
                    location.reload();
                }
                else{
                    console.log(data.msg);
                }
            }
        });
    });
    $(".ediButton").click(function(){
        var sub_id=$(this).attr('data-id');
        var sub_subject=$(this).attr('data-subject')
        $('#edit_Subject').val(sub_subject);
        $('#edit_subject_id').val(sub_id);
    })
    $("#editSubject").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "{{route('editSubject')}}",
            type: "post",
            data: formData,
            success: function(data){
                if(data.success==true){
                    location.reload();
                }
                else{
                    console.log(data.msg);
                }
            }
        });
    });

    // delete subject()
    $('.deleteButton').click(function(){
        var sub_id=$(this).attr('data-id');

        $('#delete_subject_id').val(sub_id);
    })
    $("#deleteSubject").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "{{route('deleteSubject')}}",
            type: "post",
            data: formData,
            success: function(data){
                if(data.success==true){
                    location.reload();
                }
                else{
                    console.log(data.msg);
                }
            }
        });
    });

});