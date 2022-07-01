<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Str;

class ComplaintsController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'complaints';
    }

    public function index()
    {
        $complaints = $this->database->getReference($this->tablename)->getValue();
        if ($complaints != NULL) {
            return view('firebase.complaints.index', compact('complaints'));
        } else {
            return view('firebase.complaints.index')->with('status', 'Currently No Complaints Found');
        }
    }

    public function create()
    {
        return view('firebase.complaints.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fileName' => 'required|mimes:jpg,jpeg,png,bmp,gif,pdf|max:2048',
        ]);
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        $image = $request->file('fileName');
        $name = (string) Str::uuid() . "." . $image->getClientOriginalExtension();
        $pathName = $image->getPathName();
        $file = fopen($pathName, 'r');
        $object = $defaultBucket->upload($file, [
            'name' => $name,
            'predefinedAcl' => 'publicRead'
        ]);
        $image_url = 'https://storage.googleapis.com/' . env('FIREBASE_PROJECT_ID') . '.appspot.com/' . $name;

        $postData = [
            'title' => $request->title,
            'phone_no' => $request->phone_no,
            'description' => $request->description,
            'device_info' => $request->device_info,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
            'fileName' => $image_url,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if ($postRef) {
            $postKey = $postRef->getKey();
            return redirect('complaints')->with('status', 'Complaint successfully submitted and Complain ID is: ' . $postKey);
        } else {
            return redirect('complaints')->with('status', 'Oops! Complaint is not submitted');
        }
    }

    public function edit($id)
    {
        $key = $id;
        $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();

        if ($editdata) {
            return view('firebase.complaints.edit', compact('editdata', 'key'));
        } else {
            return redirect('complaints')->with('status', 'Oops! Complaint ID is not found');
        }
    }
    public function update(Request $request, $id)
    {
        $key = $id;
        $updateData = [
            'title' => $request->title,
            'phone_no' => $request->phone_no,
            'description' => $request->description,
            'device_info' => $request->device_info,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,

        ];
        $res_updated = $this->database->getReference($this->tablename . '/' . $key)->update($updateData);

        if ($res_updated) {
            return redirect('complaints')->with('status', 'Complaint Updated Successfully');
        } else {
            return redirect('complaints')->with('status', 'Oops! Not able to Update');
        }
    }

    public function destroy($id)
    {
        $key = $id;
        $del_Data = $this->database->getReference($this->tablename . '/' . $key)->remove();

        if ($del_Data) {
            return redirect('complaints')->with('status', 'Complaint Deleted Successfully');
        } else {
            return redirect('complaints')->with('status', 'Oops! Not able to Delete Complaint');
        }
    }
}