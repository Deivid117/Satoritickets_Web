<?php
ob_start();
?>
<html id="page_border">
    <head>
        <title>Ticket Report</title>
        <style>
            #page_border {
                margin: 15px;
                border:2px solid #1D8AB6;
                border-radius: 10px;
            }
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
                width: 120px;
            }
            #th_project {
                border: none;
            }
            #td_project {
                width: 362px;
                border: none;
            }
            .td_content {
                border: none;
                background-color: #ffffff;
                padding-right: 20px;
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
                padding: 15px;
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
                            <td>Android</td>
                            <th>Fecha:</th>
                            <td>12/09/2022</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th id="th_project">Proyecto: </th>
                            <td id="td_project">jelou</td>
                        </tr>
                    </table>
                </td>
                <td class="td_content">
                    <img src="{!! asset('assets/images/logo/satori_logo.png') !!}" alt="logo satori" style="height: 60px;" >
                </td>
            </tr>
        </table>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer neque sapien, cursus non tempor vel, pulvinar et massa. Donec dapibus mauris ex, eget tempor risus posuere id. In vehicula sollicitudin leo ut laoreet. Nulla facilisi. Etiam gravida risus fermentum nisl mollis rutrum. Praesent fringilla enim velit. Donec lorem enim, aliquet vel accumsan id, tincidunt id elit. Mauris eget tincidunt urna. Vivamus cursus varius velit id consequat. Duis interdum tellus vel diam ultrices, et fringilla nulla molestie. Praesent semper sem eget magna luctus vehicula. Quisque faucibus nisi eu orci aliquet fringilla.

            Mauris porta eu urna et egestas. Donec at fringilla quam. Duis lobortis lacinia mi, in auctor lorem ornare ut. In vestibulum ante magna, ac lobortis mauris facilisis nec. Phasellus lobortis non eros et elementum. Aliquam erat volutpat. Aliquam tempus mauris non facilisis scelerisque. Duis mi quam, porttitor nec consequat at, ullamcorper id orci. Etiam scelerisque sit amet sem eu luctus. Aenean elementum mauris non lorem rhoncus feugiat. Phasellus ornare dignissim feugiat. Cras nec quam sit amet felis maximus ultricies vitae et urna. Suspendisse sit amet eros tempor, congue nisi ut, placerat nisi.

            In quis sem eget purus luctus sodales ut quis eros. Sed faucibus augue et laoreet congue. Sed mollis hendrerit felis ac eleifend. Fusce eu porttitor risus. Morbi feugiat magna et felis fringilla, vitae facilisis quam hendrerit. Morbi ultricies vestibulum neque vitae tempor. Ut consequat rutrum est, vel laoreet risus. Quisque euismod odio eget ex feugiat fringilla. Sed ac justo sed nulla semper posuere. Sed at leo massa.

            Curabitur ultricies nisl at turpis vestibulum dictum. Nulla id varius lectus. Aliquam erat volutpat. Duis in est enim. Aenean id aliquet velit, at ultricies nisi. In ultricies mauris diam, et tempor est fermentum nec. Sed porta id urna quis consectetur. Phasellus vulputate euismod eleifend. Praesent vel tempor arcu. Quisque tincidunt volutpat nunc sit amet interdum. Ut viverra risus eget nunc dapibus mollis. Donec vel faucibus ante.

            Nullam finibus eleifend risus, sed tristique mi luctus ac. Ut mollis faucibus mauris, id dignissim massa varius id. Vivamus et eros et arcu placerat malesuada. Nullam dignissim dolor turpis, et congue ex scelerisque in. Sed urna felis, venenatis et lacinia at, fermentum eu velit. Etiam non tempus ante, eu venenatis mi. Phasellus bibendum porta sodales. Suspendisse vel elementum nibh. Proin ullamcorper cursus enim quis interdum. Donec fermentum ac arcu fermentum sagittis. Sed sagittis congue leo a vehicula. Integer cursus lorem non facilisis fermentum.
        </p>
    </Body>
</html>


<?php
$html = ob_get_clean();

use Dompdf\Dompdf;
$domPdf = new Dompdf();

$options = $domPdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$domPdf->setOptions($options);
//$domPdf = app('dompdf.wrapper');
$domPdf->loadHtml($html);

$domPdf->setPaper('letter');

$domPdf->render();

$domPdf->stream("ticket.pdf", array("Attachment" => false));
?>
