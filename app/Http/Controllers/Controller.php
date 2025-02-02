<?php
namespace App\Http\Controllers;
//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
class Controller extends BaseController
{

 public function login(Request $request)
 {
    if ($request->isMethod('get')) {
        return view('auth.login'); // Tampilkan form login
    }

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $apiURL = 'http://localhost/pertemuan13/api/login';
    $response = Http::post($apiURL, [
        'email' => $request->email,
        'password' => $request->password
    ]);

    if ($response->failed()) {
        return back()->withErrors(['message' => 'Login gagal, periksa kembali email dan password.']);
    }

    $data = $response->json();

    if (!isset($data['access_token'])) {
        return back()->withErrors(['message' => 'Login gagal, token tidak ditemukan.']);
    }

    session(['token' => $data['access_token']]);
   
    return redirect('/dashboard'); // Pastikan tidak ada loop redirect ke /login
    //dd($responseBody);
    //echo "<pre>";
    //print_r($responseBody);
    //echo "<pre>";
    //echo($responseBody['access_token']);
    //session(['token' => $responseBody['access_token']]);
 }

 public function barangdata()
 {
    $apiURL = 'http://localhost/pertemuan13/api/barang';
    // $parameters = ['page' => 2];
    // $parameters = ['tglawal' => 2025-01-01,'tglakhir'=>2025-01-31];
        $parameters = [];
        $headers = [
        'X-header' => 'value',
        'Authorization' => 'Bearer '.session('token')
    ];
    $response = Http::withHeaders($headers)->get($apiURL, $parameters);
    $statusCode = $response->status();
    $responseBody = json_decode($response->getBody(), true);
    //dd($responseBody);
     echo "<pre>";
    print_r($responseBody);
    echo "</pre>";
    echo "<br>";
    print_r($responseBody['data'][0]['kode']);
    echo "<br>";
    echo (count($responseBody['data']));
 }

 public function baranginsert()
 {
    $apiURL = 'http://localhost/pertemuan13/api/simpanbarang';
    $postInput = [
        'kode' => 'p006',
        'nama' => 'produk 05',
        'satuan' => 'pcs',
        'hargabeli' => '2000',
        'hargajual' => '3000',
    ];
    $headers = [
        'X-header' => 'value',
        'Authorization' => 'Bearer '.session('token')
    ];
    $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    $statusCode = $response->status();
    $responseBody = json_decode($response->getBody(), true);
    //dd($responseBody);
    print_r($responseBody);
    }
    public function barangupdate()
    {
        $apiURL = 'http://localhost/pertemuan13/api/ubahbarang';
        $postInput = [
        'kode' => 'p006',
        'nama' => 'produk 06',
        'satuan' => 'pcs',
        'hargabeli' => '2000',
        'hargajual' => '3000',
        ];
        $headers = [
        'X-header' => 'value',
        'Authorization' => 'Bearer '.session('token')
        ];
 $response = Http::withHeaders($headers)->post($apiURL, $postInput);
 $statusCode = $response->status();
 $responseBody = json_decode($response->getBody(), true);
 //dd($responseBody);
 print_r($responseBody);
 }
 public function barangdelete()
 {
 $apiURL = 'http://localhost/pertemuan13/api/hapusbarang';
 $postInput = [
 'kode' => 'p006'
 ];
 $headers = [
 'X-header' => 'value',
 'Authorization' => 'Bearer '.session('token')
 ];
 $response = Http::withHeaders($headers)->post($apiURL, $postInput);
 $statusCode = $response->status();
 $responseBody = json_decode($response->getBody(), true);
 //dd($responseBody);
 print_r($responseBody);
 }


}