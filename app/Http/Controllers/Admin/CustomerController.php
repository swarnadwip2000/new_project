<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;
use App\Models\Shift;
use App\Models\Toll;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;
use File;

use function PHPUnit\Framework\fileExists;

class CustomerController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stuffs = User::Role('STUFF')->with(['toll', 'shift'])->get();
        // return $stuffs;
        return view('admin.stuff.list')->with(compact('stuffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tolls = Toll::get();
        $shifts = Shift::get();
        return view('admin.stuff.create')->with(compact('tolls','shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'toll' => 'required',
            'shift' => 'required',
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'status' => 'required'
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->shift_id = $request->shift;
        $data->toll_id = $request->toll;
        $data->status = $request->status;
        $data->stuff_id = $this->randomStuffId();
        $data->profile_picture = $this->imageUpload($request->file('profile_picture'), 'customer');
        $data->save();
        $data->assignRole('STUFF');
        $maildata = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => 'Stuff',
        ];

        // Mail::to($request->email)->send(new RegistrationMail($maildata));
        return redirect()->route('stuffs.index')->with('message', 'Stuff created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tolls = Toll::get();
        $shifts = Shift::get();
        $stuff = User::with(['toll', 'shift'])->findOrFail($id);
        return view('admin.stuff.edit')->with(compact('stuff', 'tolls', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'address' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'pincode' => 'required',
        ]);
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->status = $request->status;
        $data->city = $request->city;
        $data->country = $request->country;
        $data->pincode = $request->pincode;
        if ($request->password != null) {
            $request->validate([
                'password' => 'min:8',
                'confirm_password' => 'min:8|same:password',
            ]);
            $data->password = bcrypt($request->password);
        }
        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg',
            ]);
            if ($data->profile_picture) {
                $currentImageFilename = $data->profile_picture; // get current image name
                Storage::delete('app/'.$currentImageFilename);
            }
            $data->profile_picture = $this->imageUpload($request->file('profile_picture'), 'customer');
        }
        $data->save();
        return redirect()->route('stuffs.index')->with('message', 'Stuff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStuffStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('stuffs.index')->with('error', 'Stuff has been deleted successfully.');
    }

    public function randomStuffId()
    {
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = $codeAlphabet[rand(0, (strlen($codeAlphabet)-1))] . random_int(0000000000, 9999999999);
        return $string;
    }
}
