$(document).ready(function(){
    $('#content').css('min-height', $(window).height() - 200);
    $(window).resize(function(){
        $('#content').css('min-height', $(window).height() - 200);        
    });

     
    $('.optional').change(function() {
        if ($(this).is(':checked')) {
            $('.form-hidden').show('slow');
        } else {
            $('.form-hidden').hide('slow');    
        }
    })
    
    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '2000:2020',
        dateFormat: 'yy-mm-dd'
    });
})

function format_number(pnumber,decimals){
    if (isNaN(pnumber)) 
        return 0;
    if (pnumber=='') 
        return 0;
    var snum = new String(pnumber);
    var sec = snum.split('.');
    var whole = parseFloat(sec[0]);
    var result = '';
    if(sec.length > 1){
        var dec = new String(sec[1]);
        dec = String(parseFloat(sec[1])/Math.pow(10,(dec.length - decimals)));
        dec = String(whole + Math.round(parseFloat(dec))/Math.pow(10,decimals));
        var dot = dec.indexOf('.');
        if(dot == -1){
            dec += '.';
            dot = dec.indexOf('.');
        }
        while(dec.length <= dot + decimals) {
            dec += '0';
        }
        result = dec;
    } else{
        var dot;
        var dec = new String(whole);
        dec += '.';
        dot = dec.indexOf('.');
        while(dec.length <= dot + decimals) {
            dec += '0';
        }
        result = dec;
    }
    return result;
}

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

