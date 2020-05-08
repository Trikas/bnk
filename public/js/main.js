$(document).ready(function () {

    $('.toggler-trigger').click(function (e) {
        e.preventDefault();
        $(this).closest('.toggler').toggleClass('active');
        $(this).closest('.toggler').find('.toggler__content').stop().slideToggle();
    });

    if ($('.select_js').length) {
        $('.select_js').select2({
            width: '100%',
            height: '100%',
            minimumResultsForSearch: -1
        });
    }
    /*$(".myInput").ionDatePicker({
        lang: "ru",                     // language
        sundayFirst: false,             // first week day
        years: "90",                    // years diapason
        format: "DD.MM.YYYY",           // date format
        onClick: function(date){        // click on day returns date
            console.log(date);
        }
    });*/
});


