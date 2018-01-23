/**
 * Created by xcc on 10/23/2016.
 */

$('#login>h1').remove();
var formLogo = '<div id="owl-login"><div class="hand"></div><div class="hand hand-r"></div><div class="arms"> <div class="arm"></div> <div class="arm arm-r"></div> </div> </div>';
$('#login').prepend(formLogo);
$(function() {
    $('#login #user_pass').focus(function() {
        $('#owl-login').addClass('password');
    }).blur(function() {
        $('#owl-login').removeClass('password');
    });
});