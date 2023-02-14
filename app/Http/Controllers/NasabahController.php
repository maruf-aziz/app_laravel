<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facade\Auth;
use DataTables;

class NasabahController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:nasabah-list|nasabah-create|nasabah-edit|nasabah-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:nasabah-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:nasabah-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:nasabah-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\auth()->user()->can('nasabah-list')){
            $data = [
                'data' => Nasabah::all(),
            ];
            return view('admin.nasabah.view', $data);
        } else {
            echo "<script>alert('permission denied !!!')</script>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\auth()->user()->can('nasabah-create')){
            return view('admin.nasabah.add_new');
        } else {
            echo "<script>alert('permission denied !!!')</script>";
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\auth()->user()->can('nasabah-create')){
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

        } else {
            echo "<script>alert('permission denied !!!')</script>";
        }
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
        if(\auth()->user()->can('nasabah-edit')){
            $get_nasabah = Nasabah::find($nasabah);

            return view('admin.nasabah.edit', compact('get_nasabah'));
        } else {
            echo "<script>alert('permission denied !!!')</script>";
        }
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
        if(\auth()->user()->can('nasabah-edit')){
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
        } else {
            echo "<script>alert('permission denied !!!')</script>";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nasabah $nasabah)
    {
        if(\auth()->user()->can('nasabah-delete')){
            $nasabah->delete();
            return redirect()->route('nasabah.index')->with('success', 'Your form has been deleted.');;
        } else {
            echo "<script>alert('permission denied !!!')</script>";
        }
        
    }

    public function sendmail(){
        $data = [
            'nama' => 'maruf',
            'link' => 'https://stackoverflow.com/questions/37498657/how-to-attach-a-laravel-blade-view-in-mail'
        ];
        $message = view('email', $data)->render();
    
        $messageData = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'safmira59@gmail.com',
                        'Name' => 'PT. GITS',
                    ],
                    'To' => [
                        [
                            'Email' => 'wisemajor99@gmail.com',
                            'Name' => 'maruf',
                        ],
                    ],
                    'Subject' => 'Test Email',
                    'TextPart' => 'body email message',
                    'HTMLPart' => $message,
                ],
            ],
        ];
    
        $api_key = 'b9cbace0aa79a3e53b3f9604e6181c0e';
        $secret = 'fa157628530d7b7e8a7af75deb4ac710';
    
        $jsonData = json_encode($messageData);
        $ch = curl_init('https://api.mailjet.com/v3.1/send');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_USERPWD, "{$api_key}:{$secret}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($jsonData)]);
        $response = json_decode(curl_exec($ch));
    
        return $response;
    }

    public function getNasabah(Request $request)
    {
        if ($request->ajax()) {
            $data = Nasabah::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('alamat', function($row){
                    $output = '';

                    $output .= '
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop'.$row->id.'">
                                Lihat Alamat
                            </button>';

                    $output .= '<br>';

                    $output .= '
                    <div class="modal fade" id="staticBackdrop'.$row->id.'" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Alamat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">'.$row->alamat.'</div>
                            </div>
                        </div>
                    </div>';

                    return $output;
                })
                ->addColumn('action', function($row){

                    $action = '';

                    if(\auth()->user()->can('nasabah-edit')){
                        $action .= '
                            <a href="'.route('nasabah.edit', $row->id).'" class="btn btn-success li-modal">Edit</a>
                        ';
                    }

                    if(\auth()->user()->can('nasabah-delete')){
                        $action .= '
                            <form action="'.route('nasabah.destroy', $row->id).'" method="post">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger"
                                    onclick="return confirm("Apakah Anda Yakin?")">Delete</button>
                            </form>
                        ';
                    }

                    return $action;
                })
                ->rawColumns(['action', 'alamat'])
                ->make(true);
        }
    }
}
