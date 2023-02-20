<?php
    $ticket = json_decode($documentWS);
?>
<html>
    <head>
        <title>Ticket PDF</title>
    </head>
    <Body>
        <embed src="{!!asset('documents/'.$ticket->{'team'}.'/'.$ticket->{'pdf'})!!}" type="application/pdf" width="100%" height="100%" frameborder="0"/>
    </Body>
</html>

