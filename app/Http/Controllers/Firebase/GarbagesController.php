<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Str;

class GarbagesController extends Controller
{

public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'garbage_bins';

    }

public function index()
    {
        $garbages = $this->database->getReference($this->tablename)->getValue();
        

        return view('firebase.garbages.index', compact('garbages'));
    }

public function create()
    {
        return view('firebase.garbages.add');
    }

public function store(Request $request)
    {

        $postData = [
            'location' => $request->location,
            'lat' => $request->lat,
            'long' => $request->long,
            ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef)
        {
            $postKey = $postRef->getKey();
            return redirect('garbages')->with('status', 'Garbage Bin Added successfully');
        }
        else
        {
            return redirect('garbages')->with('status', 'Oops! Garbage Bin is not Added');
        }
        
    }

public function edit($id) 
{
    $key = $id;
    $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();

    if($editdata)
        {
            return view('firebase.garbages.edit', compact('editdata','key'));
        }
    else
        {
            return redirect('garbages')->with('status', 'Oops! Grbage Bin is not found');
        }
        
}
public function update(Request $request, $id)
{
    $key = $id;
    $updateData = [
        'location' => $request->location,
        'lat' => $request->lat,
        'long' => $request->long,
    ];
    
    $res_updated = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

    if($res_updated)
        {
            return redirect('garbages')->with('status', 'Complaint Updated Successfully');
        }
    else
        {
            return redirect('garbages')->with('status', 'Oops! Not able to Update');
        }
        
}
  


}
