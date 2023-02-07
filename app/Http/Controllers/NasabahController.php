<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'data' => Nasabah::all(),
        ];
        return view('admin.nasabah.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nasabah.add_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'email' => 'required',
        ]);

        

        $alamat = [];
        for ($i=0; $i < count($request->kota); $i++) { 
            if($request->kota[$i] != ''){
                array_push($alamat, [
                    'alamat' => $request->alamat[$i],
                    'Kota'  => $request->kota[$i]
                ]);
            }
        }

        // cara 1
        // $data = array(
        //     'nama_lengkap' => $request->nama_lengkap,
        //     'email' => $request->email,
        //     'no_telp' => $request->no_telp,
        //     'alamat' => json_encode($alamat)
        // );
        // Nasabah::create($data);

        // cara 2
        $nasabah                    = new Nasabah();
        $nasabah->nama_lengkap      = $request->nama_lengkap;
        $nasabah->email             = $request->email;
        $nasabah->no_telp           = $request->no_telp;
        $nasabah->alamat            = json_encode($alamat);
        $nasabah->save();

        return redirect()->route('nasabah.index')->with('success', 'Your form has been submitted.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function show(Nasabah $nasabah)
    {
        print('oke');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function edit($nasabah)
    {
        $get_nasabah = Nasabah::find($nasabah);

        return view('admin.nasabah.edit', compact('get_nasabah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'email' => 'required',
        ]);

        $alamat = [];
        for ($i=0; $i < count($request->kota); $i++) { 
            if($request->kota[$i] != ''){
                array_push($alamat, [
                    'alamat' => $request->alamat[$i],
                    'Kota'  => $request->kota[$i]
                ]);
            }
        }

        $nasabah->nama_lengkap      = $request->nama_lengkap;
        $nasabah->email      = $request->email;
        $nasabah->no_telp      = $request->no_telp;
        $nasabah->alamat        = json_encode($alamat);
        $nasabah->save();

        return redirect()->route('nasabah.index')->with('success', 'Your form has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Your form has been deleted.');;
    }
}
