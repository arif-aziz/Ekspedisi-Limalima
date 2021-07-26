<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        $meta = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'Sistem Informasi Ekspedisi'),
            array('name' => 'keywords', 'content' => 'ekspedisi, sistem informasi, SI'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        echo meta($meta);
        ?>
        <title>
            <? echo isset($title) ? $title . " | " : ""; ?>Sistem Informasi Ekspedisi
        </title>


        <script type="text/javascript">
            var base_url = '<?= base_url(); ?>';
            var base_path = '<?= $this->config->item('base_path'); ?>';
            var path_upload = '/ekspedisi/images/';
        </script>

        <?php
        //echo link_tag('css/reset.css');
        echo link_tag('css/theme.css');
        echo link_tag('css/style.css');
        echo link_tag('css/theme4.css');
        echo link_tag('css/jquery.window.css');
        echo link_tag('css/redmond/jquery-ui-1.8.17.custom.css');
        echo link_tag('css/combogrid/jquery.ui.combogrid.css');
        ?>

        <?php
        echo script_tag('js/libs/jquery-1.7.1.min.js');
        echo script_tag('js/libs/jquery-ui-1.8.9.custom.min.js');
        echo script_tag('js/libs/jquery.ui.combogrid-1.6.2.js');
        echo script_tag('js/jquery.window.min.js');
        echo script_tag('js/jquery.validate.min.js');
        echo script_tag('js/script.js');
        ?>

        <? if (isset($tinymce) && $tinymce == 1): ?>
            <script type="text/javascript" src="<?= base_url(); ?>js/libs/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>   
        <? endif; ?>

        <?
        if (isset($select) && $select == 1)
        {
            echo link_tag('css/selectlist.css');
            echo script_tag('js/libs/jquery.selectlist.js');
        }
        ?>

        <!--[if IE]>
        <?= link_tag('css/ie-sucks.css'); ?>
        <![endif]-->

        <script type="text/javascript">
        $().ready(function(){
           $("#no_sm").focus();
           $('form#muatanform').validate({
                rules : {
                        qty: {
                        required: true,
                        number: true,
                    },
                merk: "required",
                jenis_brg: "required",
                },
                messages : {
                    qty: {
                        required: "Banyak barang harus diisi",
                        number: "Tulis dengan angka" 
                    },
                    merk: "Merk harus diisi",
                    jenis_brg: "Jenis Barang harus diisi",
                },
                onkeyup: false
            })
            
            $('form#form').validate({
                rules : {
                    no_sm: {
                        required: true,
                        number: true,
                        remote: "muatan/cek_sm"
                    },
                    id_pengirim: "required",
                    nama_penerima: "required",
                    alamat_penerima: "required",
                    berat: {
                        required: "#radio-berat:checked"
                    },
                    harga: {
                        required: "#radio-berat:checked"
                    },
                    biaya: {
                        required: true,
                        number: true
                    }
                },
                messages : {
                    no_sm: {
                        required: "No SM harus diisi",
                        number: "Tulis dengan angka",
                        remote: "No. SM sudah ada"
                    },
                    id_pengirim: "Pengirim harus diisi",
                    nama_penerima: "Nama Penerima harus diisi",
                    alamat_penerima: "Alamat Penerima harus diisi",
                    berat: {
                        required: "Berat harus diisi"
                    },
                    harga: {
                        required: "Harga harus diisi"
                    },
                    biaya: {
                        required: "Biaya harus diisi",
                        number: "Tulis dengan angka"
                    }
                },
                onkeyup: false
            })
            
            $('input[name=type-biaya]').click(function(){
                if ($(this).val() == "1")
                {
                    $("#hide").show();
                }
                else
                {
                     $("#hide").hide();
                }
            });
            
            $("#tambah-button").click(function(){
                if($("form#muatanform").valid())
                {
                    $(".data-muatan").append("<tr><td class='qty'>" + $('#qty').val() + "</td><td class='merk'>" + $('#merk').val() + "</td><td class='jenis_brg'>" + $('#jenis_brg').val() + "</td><td align='center'>" + 
                        "<a class='deletemuatan' href='javascript:void(0)'><img src='" + base_url + "/img/icons/delete.png' width='16' height='16' alt='delete' /></td></tr>");
                    bersihkan();
                }
            })
            
            $("#simpan").live("click", function(){
                
                if($("form#form").valid())
                    {
                        var no_sm = $("#no_sm").val();
                        var nama_penerima = $("#nama_penerima").val();
                        var alamat_penerima = $("#alamat_penerima").val();
                        var tipe_biaya = $("form input[checked='checked']:radio").val();
                        var berat = $("#berat").val();
                        var harga = $("#harga").val();
                        var biaya = $("#biaya").val();
                        var id_pengirim = $("#id_pengirim").val();
                        var status = 0;
                        var hidden = 0;
                        var id_muatan = "";
                        
                        $.ajax({
                            type : 'POST',
                            url : base_url + "muatan/tambah", 
                            data : {
                                no_sm : no_sm,
                                nama_penerima : nama_penerima,
                                alamat_penerima : alamat_penerima,
                                tipe_biaya : tipe_biaya,
                                berat : berat,
                                harga : harga,
                                biaya : biaya,
                                id_pengirim : id_pengirim,
                                status : status,
                                hidden : hidden
                            },
                            async: false,
                            success: function(data)
                            {
                                id_muatan = data;
                            }
                        });
                        
                        $("#muatan tr").each(function(){
                            if ($(this).find('.qty').text() != "")
                            {
                                var qty = $(this).find('.qty').text();
                                var merk = $(this).find('.merk').text();
                                var jenis_brg = $(this).find('.jenis_brg').text();
                                $.ajax({
                                    type : 'POST',
                                    url : base_url + "muatan/tambah_dt", 
                                    data : {
                                        id_muatan : id_muatan,
                                        qty : qty,
                                        merk : merk,
                                        jenis_brg : jenis_brg
                                    },
                                    async: false
                                });
                            }
                        });
                        window.parent.closeWindow();
                    }
            })
            
            $(".deletemuatan").live("click", function(){
                $(this).parent().parent().remove();
            })
            
            $("#berat").keyup(function(){
                jumlah();
            })
            
            $("#harga").keyup(function(){
                jumlah();
            })
            
            $("#nama_pengirim").combogrid({
                url: base_url + 'proses/get_data',
                debug: true,
                width: 500,
                table: 'pengirim',
                showOn: true,
                resetButton : true,
                field: 'nama_pengirim',
                colModel: [{
                        'columnName':'id_pengirim',
                        'width':'10',
                        'label':'id'
                    }, {
                        'columnName':'nama_pengirim',
                        'width':'45',
                        'label':'nama'
                    },{
                        'columnName':'alamat',
                        'width':'45',
                        'label':'alamat'
                    }],
                select: function( event, ui ) {
                    $(this).val( ui.item.nama_pengirim );
                    $('#id_pengirim').val(ui.item.id_pengirim);
                    $("form#form").valid();
                    return false;
                }
            });
        })
        
        function jumlah()
        {
            $("#biaya").val($("#berat").val() * $("#harga").val());
        }
        
        function bersihkan()
        {
            $("#qty").val("");
            $("#merk").val("");
            $("#jenis_brg").val("");
            $('#qty').focus();
        }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <h3><?= $aksi ? "Edit" : "Tambah"; ?> Ekspedisi</h3>
                <form id="form" action="" method="post">
                    <fieldset id="personal">
                        <legend>EKSPEDISI</legend>
                        <label for="no_sm">No SM : </label> 
                        <input name="no_sm" id="no_sm" type="text" tabindex="1" size="20" value="<?= $aksi ? $ekspedisi['no_sm'] : ""; ?>" />
                        <br />
                        <label for="nama_pengirim">Pengirim : </label>
                        <input name="nama_pengirim" id="nama_pengirim" type="text" tabindex="2" size="20" value="<?= $aksi ? $ekspedisi['nama_pengirim'] : ""; ?>" />
                        <input name="id_pengirim" id="id_pengirim" type="hidden" size="20" value="<?= $aksi ? $ekspedisi['id_pengirim'] : ""; ?>" />
                        <br />
                        <label for="nama_penerima">Nama Penerima : </label>
                        <input name="nama_penerima" id="nama_penerima" type="text" tabindex="3" size="20" value="<?= $aksi ? $ekspedisi['nama_penerima'] : ""; ?>" />
                        <br />
                        <label for="alamat_penerima">Alamat : </label>
                        <input name="alamat_penerima" id="alamat_penerima" type="text" tabindex="4" size="20" value="<?= $aksi ? $ekspedisi['alamat_penerima'] : ""; ?>" />
                        <br />
                    </fieldset>
                    <fieldset>
                        <label for="type-biaya">Pilih Biaya : </label>
                        <input id="radio-berat" checked="checked" type="radio" name="type-biaya" value="1" />Berat&nbsp;&nbsp;&nbsp;&nbsp;<input id="radio-manual"  type="radio" name="type-biaya" value="2" />Manual
                        <br />
                        <label for="berat">Berat : </label>
                        <input name="berat" id="berat" type="text" checked="checked" tabindex="5" size="20" value="<?= $aksi ? $ekspedisi['berat'] : ""; ?>" />
                        <br />
                        <div id="hide">
                            <label for="harga">Tarif : </label>
                            <input name="harga" id="harga" type="text" tabindex="6" size="20" value="<?= $aksi ? $ekspedisi['biaya'] : ""; ?>" />
                            <br /> 
                        </div>
                        <label for="biaya">Biaya : </label>
                        <input name="biaya" id="biaya" type="text" tabindex="7" size="20" value="<?= $aksi ? $ekspedisi['biaya'] : ""; ?>" />
                        <br /> 
                    </fieldset>  
                </form>
                <form class="form" id="muatanform">
                    <fieldset id="personal">
                        <legend>MUATAN</legend>
                        <label for="qty">Banyak : </label>
                        <input name="qty" id="qty" type="text" tabindex="2" size="20" value="" />
                        <br />
                        <label for="merk">Merk : </label>
                        <input name="merk" id="merk" type="text" tabindex="2" size="30" value="" />
                        <br />
                        <label for="jenis_brg">Jenis Barang : </label>
                        <input name="jenis_brg" id="jenis_brg" type="text" tabindex="2" size="50" value="" />
                        <br />
                        <button id="tambah-button" type="button">tambah</button> 
                        <table id="muatan" width="100%">
                            <thead>
                                <tr>
                                    <th width="20">Banyak</th>
                                    <th width="50">Merk</th>
                                    <th width="250">Jenis Barang</th>
                                    <th width="50">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="data-muatan">

                            </tbody>
                        </table>
                    </fieldset>
                </form>
                <div align="center">
                    <button id="simpan" type="button">Simpan</button>
                </div>
            </div>

            <div id="footer">
                <div id="credits">
                    Template by <a href="http://www.bloganje.com">Bloganje</a>
                </div>
                <br />
            </div>
        </div>

    </body>
</html>

