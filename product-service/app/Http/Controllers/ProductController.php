<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Product;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return Product::paginate();
    }

    public function show($productId)
    {
        return Product::find($productId);
    }

    static function stackTrace() {
        $stack = debug_backtrace();
        $output = '';

        $stackLen = count($stack);
        for ($i = 1; $i < $stackLen; $i++) {
            $entry = $stack[$i];

            $func = $entry['function'] . '(';
            $argsLen = count($entry['args']);
            for ($j = 0; $j < $argsLen; $j++) {
                $my_entry = $entry['args'][$j];
                if (is_string($my_entry)) {
                    $func .= $my_entry;
                }
                if ($j < $argsLen - 1) $func .= ', ';
            }
            $func .= ')';

            $entry_file = 'NO_FILE';
            if (array_key_exists('file', $entry)) {
                $entry_file = $entry['file'];
            }
            $entry_line = 'NO_LINE';
            if (array_key_exists('line', $entry)) {
                $entry_line = $entry['line'];
            }
            $output .= $entry_file . ':' . $entry_line . ' - ' . $func . PHP_EOL;
        }
        return $output;
    }

    public function store(Request $request)
    {
        Log::info('XXXXX request');
//        Log::info(self::stackTrace());
        Log::info($request);
        return Product::create([
            'name' => $request->input('name')
        ]);
    }
    
    public function update(Request $request, $id)
    {

    }
}
