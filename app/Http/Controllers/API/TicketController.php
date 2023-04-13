<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChangeRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public $successStatus = 200;
    use ImageTrait;

    public function createTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_number'    => 'required',
            'vehicle_category'    => 'required|exists:vehicle_categories',
            'amount' => 'required|numeric',
            'user_type' => 'required|in:entry,return',
            'paid_by'=> 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            $errors['status_code'] = 401;
            $errors['message'] = [];
            $data = explode(',', $validator->errors());

            for ($i = 0; $i < count($validator->errors()); $i++) {
                // return $data[$i];
                $dk = explode('["', $data[$i]);
                $ck = explode('"]', $dk[1]);
                $errors['message'][$i] = $ck[0];
            }
            return response()->json(['error' => $errors, 'status' => false], 401);
        }
            try {
                $ticket = new Ticket();
                $ticket->stuff_id = Auth::user()->id;
                $ticket->stuff_id = $request->vehicle_number;
                $ticket->ticket_number = Str::random(1).''.rand(0000,9999).''.Str::random(1).''.rand(000000000,999999999);
                $ticket->vehicle_category = $request->vehicle_category;
                $ticket->amount = $request->amount;
                $ticket->user_type = $request->user_type;
                $ticket->paid_by = $request->paid_by;
                $ticket->image = $this->imageUpload($request->file('image'), 'ticket');
                $ticket->save();
                return response()->json(['data' => $ticket, 'status' => true, 'message' => 'Ticket has been added successfully.'], $this->successStatus);
               
            } catch (Exception $e) {
                return response()->json(['message' => 'something went wrong' , 'status' => false], 401);
            }   
    }

    public function changeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'change_type'    => 'required',
        ]);

        if ($validator->fails()) {
            $errors['status_code'] = 401;
            $errors['message'] = [];
            $data = explode(',', $validator->errors());

            for ($i = 0; $i < count($validator->errors()); $i++) {
                // return $data[$i];
                $dk = explode('["', $data[$i]);
                $ck = explode('"]', $dk[1]);
                $errors['message'][$i] = $ck[0];
            }
            return response()->json(['error' => $errors, 'status' => false], 401);
        }
            try { 
                $changeRequest = new ChangeRequest();
                $changeRequest->stuff_id = Auth::user()->id;
                $changeRequest->change_type = $request->change_type;
                $changeRequest->save();
                return response()->json(['data' => $changeRequest, 'status' => true, 'message' => 'Request has been sent successfullty.'], $this->successStatus);
               
            } catch (Exception $e) {
                return response()->json(['message' => 'something went wrong' , 'status' => false], 401);
            }  
    }
}
