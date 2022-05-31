<?php



namespace App\Imports;



use App\Models\Shop;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \Illuminate\Support\Facades\Storage;
use File;



class ShopImport implements ToCollection

{

    /**

     * @param array $row

     *

     * @return \Illuminate\Database\Eloquent\Model|null

     */

    public function collection(collection $row)

    {
        $i = 0;
        foreach ($row as $key => $value) {
            if ($i > 0) {
                $record = Shop::where('email', $value[3])->first();

                if ($record == '') {
                    $path = $value[1];


                    // else{
                    $name = '';
                    $file_headers = @get_headers($path);
                    if(isset($file_headers[0])){
                    if ($file_headers[0] == 'HTTP/1.0 404 Not Found') {
                        $name = '';
                    } else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found') {
                        $name = '';
                    } else {
                        $contents = file_get_contents($path);
                        $extention = explode('.', $path);
                        $name = time() . $i . '.' . end($extention);
                        Storage::disk('fileupload')->put($name, $contents);
                    }
                }
                    
                    $add = new Shop;
                    $add->shop_name = $value[0];
                    $add->image = $name;
                    $add->address = $value[2];
                    $add->email = $value[3];
                    $add->save();
                }
            }
            // dd($value);

            $i++;
        }
    }
}
