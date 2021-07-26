function fn_combogrid()
{
    $(".cb_pegawai").combogrid({
        url: '/codeigniter/proses/get_data',
        debug: true,
        width: 500,
        table: 'pegawai',
        colModel: [{
            'columnName':'id_peg',
            'width':'10',
            'label':'id'
        }, {
            'columnName':'nama',
            'width':'45',
            'label':'nama'
        },{
            'columnName':'alamat',
            'width':'45',
            'label':'alamat'
        }],
        select: function( event, ui ) {
            $(this).val( ui.item.nama );
            return false;
        }
    });
    
    $(".cb_kendaraan").combogrid({
        url: '/codeigniter/proses/get_data',
        debug: true,
        width: 45,
        table: 'kendaraan',
        field: 'nopol',
        colModel: [{
            'columnName':'id_kend',
            'width':'10',
            'label':'id'
        }, {
            'columnName':'nopol',
            'width':'45',
            'label':'nopol'
        },{
            'columnName':'max_muatan',
            'width':'45',
            'label':'max muatan'
        }],
        select: function( event, ui ) {
            $(this).val( ui.item.nopol );
            return false;
        }
    });
}

