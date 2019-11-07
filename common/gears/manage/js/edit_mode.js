$(document).ready(function() {




    $(".editable").fadeTo("fast", 9); // This sets the opacity of the thumbs to fade down to 60% when the page loads

    $(".editable").hover(function() {
        $(this).fadeTo("fast", 0.6); // This should set the opacity to 100% on hover
    }, function() {
        $(this).fadeTo("fast", 1); // This should set the opacity back to 60% on mouseout
    });

    $(".editable_image").fadeTo("fast", 9); // This sets the opacity of the thumbs to fade down to 60% when the page loads

    $(".editable_image").hover(function() {
        $(this).fadeTo("fast", 0.6); // This should set the opacity to 100% on hover
    }, function() {
        $(this).fadeTo("fast", 1); // This should set the opacity back to 60% on mouseout
    });

    $(".editable").click(function(e) {
        var part = $(this).attr("data-id");
        edit = $("." + part);
        var content = edit.html();
        var base_url = $("#BaseUrl").val();
        var statesdemo = {
            state0: {
                title: '',
                html: '<textarea name="edit" id="edit" class="edit-text-area">' + content + '</textarea>',
                buttons: {
                    Cancel: -1,
                    Save: 0
                },
                focus: 1,
                position: {
                    arrow: 'rm'
                },
                submit: function(e, v, m, f) {
                    if (v == 0) {
                       
                      $.ajax({
                            url: base_url + 'manage/saveEdit',
                            type: 'POST',
                            data: {
                                content: f.edit,
                                part: part
                            },
                            success: function(data) {


                                $(".notice").html(data).fadeIn(900).delay(3000).fadeOut(600);

                            }
                        });

                       $.prompt.close();

                    } else if (v == -1) {
                        $.prompt.close();
                    }


                }
            }
        };

        $.prompt(statesdemo);;

        $(".notice").html("You Can Start Editing. Save After Each Edit").fadeIn(900).delay(3000).fadeOut(600);

        return false;

    });


    $(".editable_image").click(function(e) {
        var btn = ".uploadform";
        $(btn).fadeOut(600);
        $(".notice").fadeOut(400);

        var id = $(this).attr("data-file");
        var imageWidth = $(this).attr("data-width");
        var imageHeight = $(this).attr("data-height");
        var folder = $(this).attr("data-folder");
        $(btn).fadeIn(600);
        var msg = "The Image Size Should'nt Be Below. " + imageWidth + " By " + imageHeight + " The Image Will Be Cropped To fit The Size If Crop Is Selected. <br/>Dont Crop Tranparent PNG Files ";
        $(".notice").html(msg).fadeIn(900).delay(3000).fadeOut(600);

        $("#uploadfilename").val(id);
        $("#uploadfolder").val(folder);
        $("#height").val(imageHeight);
        $("#width").val(imageWidth);
        e.stopPropagation();
        return false;
    });

    $('#close-options').click(function() {
        $('.options-panel').hide('normal', function() {
            $('.options-panel-closed').show('normal');
        });
        return false;
    });

    $('.options-panel-closed a').click(function() {
        $('.options-panel-closed').hide('normal', function() {
            $('.options-panel').show('normal');
        });
        return false;
    });

});
