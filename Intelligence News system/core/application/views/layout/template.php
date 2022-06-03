<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?= base_url(); ?>"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MIS-DOI</title>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="assets/font/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <link href="assets/css/style-default.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" >
        
        
        <?php if(isset($style) and $style) { ?>
            <?php foreach ($style as $v_style) { ?>
                <link href="<?= $v_style; ?>" rel="stylesheet">
            <?php } ?>
        <?php } ?>

        <link href="assets/my_fonts/fonts.css" rel="stylesheet" >
        <link href="assets/css/custom.css" rel="stylesheet" >
        
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootswatch.js"></script>
        
        <?php if(isset($script) and $script) { ?>
            <?php foreach ($script as $v_script) { ?>
                <script src="<?= $v_script; ?>"></script>
            <?php } ?>
        <?php } ?>
        
        <script>

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-23019901-1']);
            _gaq.push(['_setDomainName', "bootswatch.com"]);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  // tracker methods like "setCustomDimension" should be called before "trackPageView"
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//164.115.41.161/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
<!-- Start Open Web Analytics Tracker -->
<script type="text/javascript">
//<![CDATA[
var owa_baseUrl = 'http://164.115.41.161/owa/';
var owa_cmds = owa_cmds || [];
owa_cmds.push(['setSiteId', '7ce5d8ac85928225c006265430cbadc6']);
owa_cmds.push(['trackPageView']);
owa_cmds.push(['trackClicks']);
owa_cmds.push(['trackDomStream']);

(function() {
	var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
	owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
	_owa.src = owa_baseUrl + 'modules/base/js/owa.tracker-combined-min.js';
	var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
}());
//]]>
</script>
<!-- End Open Web Analytics Code -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="lock">
        <?= $content_for_layout; ?>
    </body>
    <!-- END BODY -->
</html>