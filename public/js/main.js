//$( document ).ready(function(){
//
////var hash = $(this).attr('href').split('#')[1];
//var hash = window.location.hash;
//if (hash){
//    $('#menu li').removeClass('active');
//    var a = $('#menu li:has(a[href="'+hash+'"])');
//    a.addClass('active');
//    changeSection(hash);
//} else {
//    changeSection('#home')
//}
//
//
//});
////===========================
//// open new section
////===========================
//
//function changeSection(sectionid){
//    $('section').fadeOut(100);
//
//    setTimeout(function(){
//        $(sectionid).fadeIn(400, function(){
//            $('#menu a').attr('dis','false');
//        });
//    },150);
//
//}
//
//
////===========================
//// Change button view(enable/disable). Also blocks multiclicking.
////===========================
//$('#menu a').click(function(){
//    if($(this).hasClass('active')) return;
//    if ($(this).attr('dis') == 'true') return;
//    $('#menu a').attr('dis','true');
//    $('#menu li').removeClass('active');
//    $(this).parent($('li')).addClass('active');
//    var sectionid =$(this).attr('href');
//    changeSection(sectionid);
//});







//================================================
//make Step3 block equal to list
//================================================
$( document ).ready(function(){
    resultsEqualHeight()
});

$(window).resize(function(){
    resultsEqualHeight()
});

function resultsEqualHeight(){
    $('.search-area__results').css('min-height', 'initial');
    if ($(window).width() < 740 ) return;
    $('.search-area__results').css('min-height',$('.search-area__filterList').height()+'px');

    $('.search-area').each(function () {
        var h = $(this).find($('.search-area__filterList')).height();
        //console.log(h);
        $(this).find($('.search-area__results')).css('min-height', h+'px');
    })
}
//=============================





//================================================
//Tooltips with info about Employee
//================================================
//$(document).ready(function() {
//    $('.tooltip').tooltipster();
//});







/* ---------------------------------------------- /*
 * E-mail validation
 /* ---------------------------------------------- */

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};


/* ---------------------------------------------- /*
 * Contact form ajax
 /* ---------------------------------------------- */

$("#contactForm, #contactForm_report").submit(function(e) {
    
    if ($(this).attr('id')=='contactForm_report'){
        var phpSrc = "js/contactForm_report.php"
    } else{
        var phpSrc = "js/contactForm.php"
    }

    e.preventDefault();

    var c_name,c_email,c_subject,c_message ='';

    c_name = $("#c_name").val();
    c_email = $("#c_email").val();
    c_subject = $("#c_subject").val();
    c_message = $("#c_message ").val();
    responseMessage = $('.ajax-response');

    if (( c_name== "" || c_email == "" || c_message == "") || (!isValidEmailAddress(c_email) )) {
        responseMessage.fadeIn(500);
        responseMessage.html('<i class="fa fa-warning"></i> Check all fields.');
    }

    else {
        $.ajax({
            type: "POST",
            url: phpSrc,
            dataType: 'json',
            data: {
                c_email: c_email,
                c_name: c_name,
                c_subject: c_subject,
                c_message: c_message
            },
            beforeSend: function(result) {
                $('#contact-form button').empty();
                $('#contact-form button').append('<i class="fa fa-cog fa-spin"></i> Wait...');
            },
            success: function(result) {
                if(result.sendstatus == 1) {
                    responseMessage.html(result.message);
                    responseMessage.fadeIn(500);
                    $('#contactForm, #contactForm_report').fadeOut(500);
                } else {
                    $('#contact-form button').empty();
                    $('#contact-form button').append('<i class="fa fa-retweet"></i> Try again.');
                    responseMessage.html(result.message);
                    responseMessage.fadeIn(1000);
                }
            }
        });
    }

    return false;

});


