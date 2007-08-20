<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$config_name} - {$LAN_6}</title>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<meta content="Copyright 2007 Cross Star Studios" name="copyright" />
<meta content="Ben Swanson and Dennis Berko" name="author" />
<link media="screen" type="text/css" href="../templates/Photine/admin/admin_main.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="../templates/Photine/admin/tempother.css" />
<!--

<rdf:RDF xmlns="http://web.resource.org/cc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Work rdf:about="">
   <license rdf:resource="http://creativecommons.org/licenses/GPL/2.0/" />
   <dc:type rdf:resource="http://purl.org/dc/dcmitype/Software" />
</Work>

<License rdf:about="http://creativecommons.org/licenses/GPL/2.0/">
<permits rdf:resource="http://web.resource.org/cc/Reproduction" />
   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
   <requires rdf:resource="http://web.resource.org/cc/Notice" />
   <permits rdf:resource="http://web.resource.org/cc/DerivativeWorks" />
   <requires rdf:resource="http://web.resource.org/cc/ShareAlike" />
   <requires rdf:resource="http://web.resource.org/cc/SourceCode" />
</License>

</rdf:RDF>

-->
</head>
<body>
<div id="admin-header">
  <h1>{$config_name} - {$LAN_6}</h1>
</div>

<ul id="admin-menu">
<li><a href="../index.php">{$LAN_41}</a></li><li {if $pag eq "vid"}class='selected'{/if}> <a href="admin_manage.php?pag=vid">{$LAN_68}s</a> </li><li {if $pag eq "options"}class='selected'{/if}><a href="options.php?pt=options&amp;pag=options">{$LAN_48}</a> </li><li><a href="logout.php">{$LAN_42}</a></li>
</ul>

<ul id="admin-submenu">
{if $pag eq "vid"}
<li {if $pagetype eq "all"}class='selected'{/if}><a href="admin_manage.php?pt=all&amp;pag=vid">{$LAN_43}</a></li>
<li {if $pagetype eq "feature"}class='selected'{/if}><a href="admin_manage.php?pt=feature&amp;pag=vid&amp;next=1">{$LAN_45}</a></li>
<li {if $pagetype eq "approve"}class='selected'{/if}><a href="admin_manage.php?pt=approve&amp;pag=vid&amp;next=1">{$LAN_44}</a></li>
<li {if $pagetype eq "rejected"}class='selected'{/if}><a href="admin_manage.php?pt=rejected&amp;pag=vid&amp;next=1">{$LAN_46}</a></li>
<li {if $pagetype eq "easyapprove"}class='selected'{/if}><a href="admin_videos.php?pt=easyapprove&amp;pag=vid">{$LAN_47}</a></li>
{/if}
{if $pag eq "options"}
<li {if $pagetype eq "options"}class='selected'{/if}><a href="options.php?pt=options&amp;pag=options">{$LAN_48}</a></li>
<li {if $pagetype eq "sources"}class='selected'{/if}><a href="sources.php?pt=sources&amp;pag=options">{$LAN_69}</a></li>
<li {if $pagetype eq "categories"}class='selected'{/if}><a href="categories.php?pt=categories&amp;pag=options">{$LAN_40}</a></li>
{/if}
</ul>
{if $message eq ""}{else}<p><h1 align="center">{$message1}</h1></p>{/if}