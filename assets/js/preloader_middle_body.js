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