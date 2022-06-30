<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Str;

class CompostController extends Controller
{

public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'home_compost';

    }

public function index()
    {
        $composts = $this->database->getReference($this->tablename)->getValue();
        

        return view('firebase.composts.index', compact('composts'));
    }

public function create()
    {
        return view('firebase.composts.add');
    }

public function store(Request $request)
    {
        $request->validate([
                'fileName' => 'required|mimes:jpg,jpeg,png,bmp,gif,pdf|max:2048',
                ]);
                $storage = app('firebase.storage');
                $defaultBucket = $storage->getBucket();
                $image = $request->file('fileName');
                $name = (string) Str::uuid().".".$image->getClientOriginalExtension();
                $pathName = $image->getPathName();
                $file = fopen($pathName, 'r');
                $object = $defaultBucket->upload($file, [
                      'name' => $name,
                      'predefinedAcl' => 'publicRead'
                 ]);
                $image_url = 'https://storage.googleapis.com/'.env('FIREBASE_PROJECT_ID').'.appspot.com/'.$name;

        $postData = [
            'title' => $request->title,
            'phone_no' => $request->phone_no,
            'device_info' => $request->device_info,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
            'fileName' => $image_url
            ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef)
        {
            $postKey = $postRef->getKey();
            return redirect('composts')->with('status', 'Home Compost request successfully submitted and Reference ID is: '.$postKey);
        }
        else
        {
            return redirect('composts')->with('status', 'Home Compost request not Submitted');
        }
        
    }


}
