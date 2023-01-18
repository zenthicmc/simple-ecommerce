<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Admin | Settings',
        ];
        return view('dashboard.setting', $data);
    }

    public function general_store(Request $request)
    {
        $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'discord' => ['required', 'string', 'max:255'],
            'instagram' => ['required', 'string', 'max:255'],
        ]);


        $this->changeEnvironmentVariable('APP_NAME', $request->app_name);
        $this->changeEnvironmentVariable('WHATSAPP', $request->whatsapp);
        $this->changeEnvironmentVariable('DISCORD', $request->discord);
        $this->changeEnvironmentVariable('INSTAGRAM', $request->instagram);

        return redirect()->route('setting')->with('success', 'General Settings updated successfully');
    }

    public function tripay_store(Request $request)
    {
        $request->validate([
            'merchant_code' => ['required', 'string', 'max:255'],
            'private_key' => ['required', 'string', 'max:255'],
            'api_key' => ['required', 'string', 'max:255'],
        ]);

        $this->changeEnvironmentVariable('TRIPAY_MERCHANT_CODE', $request->merchant_code);
        $this->changeEnvironmentVariable('TRIPAY_PRIVATE_KEY', $request->private_key);
        $this->changeEnvironmentVariable('TRIPAY_API_KEY', $request->api_key);

        return redirect()->route('setting')->with('success', 'Tripay Settings updated successfully');
    }

    
    public static function changeEnvironmentVariable($key,$value)
    {
        $path = base_path('.env');

        if(is_bool(env($key)))
        {
            $old = env($key)? 'true' : 'false';
        }
        else
        {
            $old = env($key);
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=".$old, "$key=".$value, file_get_contents($path)
            ));
        }
    }
}
