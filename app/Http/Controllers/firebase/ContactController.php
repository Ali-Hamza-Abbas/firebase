<?php

namespace App\Http\Controllers\firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ContactController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'contacts';
    }

    public function index()
    {
        $contacts = $this->database->getReference($this->tablename)->getValue();
        $total = $this->database->getReference($this->tablename)->getSnapshot()->numChildren();
        return view('firebase.contact.index', compact('contacts','total'));
    }

    public function create()
    {
        return view('firebase.contact.create');
    }

    public function store(Request $request)
    {
        $postData = [
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef)
        {
            return redirect('contacts')->with('status', 'Contact Added Successfully');
        } else {
            return redirect('contacts')->with('error', 'Contact Not Added');
        }
    }

    public function edit($id)
    {
        $key = $id;
        $contact = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if ($contact) {
            return view('firebase.contact.edit', compact('contact','key'));
        } else {
            return redirect('contacts')->with('error', 'Contact ID Not Found');
        }
    }

    public function update(Request $request ,$id)
    {
        $key = $id;
        $updateData = [
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $res_update = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

        if($res_update){
            return redirect('contacts')->with('status', 'Contact Edit Successfully');
        } else {
            return redirect('contacts')->with('error', 'Contact Not Updated Successfully');
        }
    }

    public function destroy($id){
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();

        if($del_data){
            return redirect('contacts')->with('status', 'Contact deleted Successfully');
        } else {
            return redirect('contacts')->with('error', 'Contact Not deleted Successfully');
        }

    }
}
