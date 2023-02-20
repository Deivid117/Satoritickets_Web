<?php
    $ticket = json_decode($documentWS);
?>
<html>
    <head>
        <title>Ticket Report</title>
        <style>
            table {
                border-collapse: collapse;
                text-align: center;
                vertical-align: middle;
                width: max-content;
            }
            th, td {
                border-bottom: 3px solid white;
                padding: 8px;
            }
            th {
                width: 90px;
            }
            td {
                width: 100px;
            }
            #th_project {
                border: none;
            }
            #td_project {
                width: 322px;
                border: none;
            }
            .td_content {
                border: none;
                background-color: #ffffff;
            }
            tbody th {
                background-color: #1D8AB6;
                color: #ffffff;
                text-align: left;
            }
            tbody tr:nth-child(odd) {
                background-color: #eee;
            }
            body {
                border:2px solid #1D8AB6;
                border-radius: 10px;
                font-family: sans-serif;
                padding: 10px;
            }
            img {
                align-items: end;
                float: right;
            }
            p {
                padding: 30px;
                text-align: justify;
            }
        </style>
    </head>
    <Body>
        <table>
            <tr>
                <td class="td_content">
                    <table>
                        <tr>
                            <th>Plataforma:</th>
                            <td> <?php echo $ticket->{'team'}?> </td>
                            <th>Fecha:</th>
                            <td> <?php echo $ticket->{'date'}?> </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th id="th_project">Proyecto: </th>
                            <td id="td_project"> <?php echo $ticket->{'project'}?> </td>
                        </tr>
                    </table>
                </td>
                <td class="td_content">
                    <img src="{!! asset('assets/images/logo/satori_logo.png') !!}" alt="logo satori" style="height: 58px;" >
                </td>
            </tr>
        </table>
        <p>
            <?php echo $ticket->{'content'}?>
        </p>
    </Body>
</html>
