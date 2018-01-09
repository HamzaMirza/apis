$(document).ready(function()
{
 $("#Loginbtn").click(function(){
   showpopup();
 });
 
});

function showpopup()
{
 $("#LoginForm").fadeIn();
 $("#LoginForm").css({"visibility":"visible","display":"block"});
}
function hidepopup()
{
 $("#LoginForm").fadeOut();
 $("#LoginForm").css({"visibility":"hidden","display":"none"});
} 