<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
USE App\Models\Nasabah;

class PDFController extends Controller
{
    public function generatePDF()
    {
  
        /**
         * download 
         */
        $data = [
            'title' => 'App Laravel',
            'date' => date('m/d/Y'),
        ]; 

        $nasabah = Nasabah::find(1);

        $dataNasabah = [
            'nama nasabah' => $nasabah->nama_lengkap,
            'suamiistri' => $nasabah->suamiIstri->id != null ? ['nama' => $nasabah->suamiIstri->nama] : [],
            'emergency_contact' => count($nasabah->emergencyCall) > 0 ? $nasabah->emergencyCall : []
        ];

        // dd($dataNasabah);

        echo "<pre>"; 
        print_r($dataNasabah);
        echo"</pre><br><br><br>";

        /**
         * tampil emergency contact
         */
        foreach ($dataNasabah['emergency_contact'] as $key => $value) {
            echo $value->nama . ' - ' . $value->no_telp . ' - ' . $value->alamat .' <br>';
        }
        

        // if(count($dataNasabah['suamiistri']) > 0){
        //     foreach ($dataNasabah['suamiistri'] as  $value) {
        //         echo $value;
        //     }
        // } else {
        //     echo "<button>Tambahkan Data Suami Istri</button>";
        // }
            
        // $pdf = PDF::loadView('surat', $data);
     
        // return $pdf->download('test.pdf');

        /**
         * show
         */

        //  return view('surat');
    }
}
