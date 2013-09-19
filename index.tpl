{extends file="template.inc"}

{block name=head}
{*cc_include files="test.js,test.css"*}
{*cc_include files="img/favicon.ico,usps.css"*}
{/block}

{block name=body}
holly1

<script>
'use strict';
jQuery(document).ready(function ($) { // The '$' circumvents any "noConflict()" in effect


});
</script>
{/block}
