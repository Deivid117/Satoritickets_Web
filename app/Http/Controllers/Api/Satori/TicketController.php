<?php

namespace App\Http\Controllers\Api\Satori;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Satori\TicketWS;
use App\Models\User;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Http\Request;
use App\Models\Tickets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{
    public function getTickets($status){
        $userId = Auth::id();
        $user = User::find($userId);
        $typeUser = auth()->user()->type_user;
        $my_tickets = Tickets::class;

        if($status == "all") {
            if ($typeUser == 1) {
                $my_tickets = Tickets::all();
            } else {
                $my_tickets = Tickets::where('user_id', $user->id)->get();
            }
        }
        if($status == "attended"){
            if ($typeUser != 1) {
                $my_tickets = Tickets::where('status', 1)->where('user_id', $user->id)->get();
            } else {
                $my_tickets = Tickets::where('status', 1)->get();
            }
        }
        if($status == "pending"){
            if ($typeUser != 1) {
                $my_tickets = Tickets::where('status', 0)->where('user_id', $user->id)->get();
            } else {
                $my_tickets = Tickets::where('status', 0)->get();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'datos obtenidos correctamente',
            'data' => TicketWS::collection($my_tickets),
        ], 200);
    }

    public function addTicket(Request $request){
        try {
            DB::beginTransaction();
            $reg = new Tickets;

            $payload = json_decode($request->get('payload'), true);

            $reg->no_ticket = $payload['no_ticket'];
            $reg->project = $payload['project'];
            $reg->team = $payload['team'];
            $reg->date = $payload['date'];
            $reg->user_id = $payload['user_id'];
            $reg->creator_id = $payload['creator_id'];
            $reg->content = $payload['content'];
            if($request->hasFile('pdf')){
                $file = $request->file('pdf');
                $name = "".$reg->no_ticket."_".$reg->project."_".$reg->team.".".$file->guessClientExtension();
                if($reg->team == "Web"){
                    $file->move(public_path().'/documents/web', $name);
                } else if ($reg->team == "Android") {
                    $file->move(public_path().'/documents/android', $name);
                } else if ($reg->team == "iOS") {
                    $file->move(public_path().'/documents/ios', $name);
                }
                //$archivo->move(public_path().'/documents/', $name);
                $reg->pdf = $name; //$archivo->getClientOriginalName();
            }
            $reg->status = $payload['status'];
            $reg->saveOrFail();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        //$ticket = Tickets::create($request->all());

        return response() -> json([
            'success' => true,
            'message' => 'ticket creado correctamente',
            //'data' =>  $ticket,
        ], 200);
    }

    public function getTicketDetails(Tickets $ticket_id){
        $id = $ticket_id;
        $my_ticket = Tickets::where('id', $id->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'datos obtenidos correctamente',
            'data' => TicketWS::collection($my_ticket),
        ], 200);
    }

    public function getTicketPdf($idReporte){
        $data = $idReporte;
        $info = Tickets::whereId($idReporte)->first();
        $document = new TicketWS($info);
        $documentWS = $document->toJson();
        $view = View::make('TicketPdf.ticket_pdf', compact('data','documentWS'))->render();
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('reporte.pdf');
        //return $pdf->download('reporte.pdf');
    }

    public function getTicketPdf2($idReporte){
        $data = $idReporte;
        $info = Tickets::whereId($idReporte)->first();
        $document = new TicketWS($info);
        $documentWS = $document->toJson();
        $view = View::make('TicketPdf.ticket_pdf_2', compact('data','documentWS'))->render();
        return $view;
    }

    public function changeStatus(Tickets $ticket_id, $status){

        $id = $ticket_id;
        $my_ticket = Tickets::where('id', $id->id)->update(['status' => $status]);

        //$my_ticket->status = $request->status;

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado',
            //'ticket' => TicketWS::collection($my_ticket),
        ], 200);

       /* $id = $ticket_id;
        $my_ticket = Tickets::where('id', $id->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'datos obtenidos correctamente',
            'data' => TicketWS::collection($my_ticket),
        ], 200);*/
    }
}
