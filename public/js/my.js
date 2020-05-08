$( document ).ready(function() {


    $('#template_trigger').change(function(){
        $('#template_input').val( $(this).val() );
        $('#tempate_form_go').submit();
    });
///

    $('.save-me-btn').click(function () {
        $('.save_input').show();
    });

    $('#account_select222').change(function(){
        $('.put-me').val( $(this).val() );
    });

     $('.gogobut').click(function(){
         var v = $('#account_select222').val()
         $('.put-me').val(v);

         //alert(val( $('#account_select222').val());
     });


    $('#account_select').change(function(){
        $('#account_select_form').submit();
    });

    $('.from_radio').click(function(){
        if( $(this).prop("checked") ){
            var id_from = $(this).attr('data-id');
            $('#from_bill_field').val(id_from);
        }
    });

    $('#make_payment_button').click(function () {

        if( $('#from_bill_field').val() == '' ){
                alert('Выбирите счет с которого нужно сделать перевод');
            return ;
        }

        if( $('#to_bill_field').val() == '' ){
                alert('Выбирите счет на который нужно сделать перевод');
            return ;
        }

        if($('#from_bill_field').val() == $('#to_bill_field').val()){
            alert('Выбирите разные счета');
            return ;
        }

        $("#go_btn").trigger('click');;
        //$('#between_form').submit();

    });

    $('.to_radio').click(function(){
        if( $(this).prop("checked") ){
            let id_to = $(this).attr('data-id');
            $('#to_bill_field').val(id_to);
        }
    });


    $('.account_details_class').click(function(){

        $('#acc_data_field').val( $(this).attr('account_data') );
        $('#account_form_go').submit();
    });



    $('.clicker').click(function () {
        $('.clicker').prop("checked", false);
        $(this).prop("checked", true);
        $('#num_id').val( $(this).attr('data-val') );
    });

    $('#op_go').click(function (e) {
        e.preventDefault();
        if( $('#num_id').val() != '' ){
            location.href="/transactions/info/" + $('#num_id').val();
        }
    });


    $('#ren').click(function (e) {
        e.preventDefault();
        $('#sec').text(59);
        $('#min').text(9);

        var left = parseInt( $('#timeline').css('left', 0 + 'px') );

    });

    setInterval(function(){
        var s = parseInt($('#sec').text());
        var m = parseInt($('#min').text())
        s = s - 1;

        if( m == 0 && s == 0 ){
            return window.location='/logout';
        }

        if(s == 0){
            s = 59;
            m = $('#min').text();
            m = m - 1;
            $('#min').text(m);
        }

        iii = m * 60 + s;

        if(iii % 4 == 0){
            iii = 4;
            var left = parseInt( $('#timeline').css('left') );
            left = left - 1;
            $('#timeline').css('left', left + 'px');
        }


        if(s < 10){
            s = '0' + s;
        }

        $('#sec').text(s);


    },1000);



    var uri = window.location.pathname;
    $('a[href="'+uri+'"]').addClass('active');



    });
