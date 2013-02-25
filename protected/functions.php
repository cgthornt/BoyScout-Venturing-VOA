<?php
function bbcHtml($html)
{
    $html = htmlentities($html);
    $html = nl2br($html);
    return $html;
}
?>