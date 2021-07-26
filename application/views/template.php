<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    </head>

    <body>
        <div style="display: none;" id="dialog-confirm" title="Hapus Data Bengkel?">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Data Bengkel</p>
        </div>
        <div id="container">
            <div id="header">
                <h2>Sistem Informasi Ekspedisi</h2>
                <? $this->load->view('nav'); ?>
            </div>
            <? $this->load->view('subnav'); ?>
            <div id="wrapper">
                <div id="content">
                    <?= isset($content) ? $this->load->view($content) : ""; ?>
                </div>
                <div id="footer">
                    <div id="credits">
                        Template by <a href="http://www.bloganje.com">Bloganje</a>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </body>
</html>
