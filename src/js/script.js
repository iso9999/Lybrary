$(function() {
    $(document).on('click','#account',function (){
        $("#topbar-menu").toggleClass("show");
        $("#topbar-menu").toggleClass("hide");
        $(this).find('#ico-account').toggleClass('ion-chevron-down');
        $(this).find('#ico-account').toggleClass('ion-chevron-up');
    })
    $(document).on('click','.submenu',function (){
        $(this).find("#sub-content").toggleClass("show");
        $(this).find("#sub-content").toggleClass("hide");
        $(this).find('#icon').toggleClass('ion-chevron-right');
        $(this).find('#icon').toggleClass('ion-chevron-up');
    })
     
});
/*
var hiden=true;
function nav(f)
{
    var n=f.nextSibling;
    //var x=n.getAttribute('class');
    alert(n.tagName);
    //n.setAttribute("class", "sub-content show");
}*/
