<div style="position: fixed;bottom: 0px;width: 100%; background: #eee; border-top: black 1px solid;">
    <?php
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
        $url = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        foreach (get_headers($url) as $k => $header):
    ?>
         <div style="float: left;">
             <?php echo $header; ?>
         </div>
    <?php
        endforeach;
    ?>
</div>