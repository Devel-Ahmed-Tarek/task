<?php
namespace App\Helpers;

class HelperFunc
{
    public static function uploadFile($path, $file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $name      = time() . rand(100, 999) . '.' . $extension;
        return (string) $file->move('uploads/' . $path, $name);
    }

    public static function deleteFile($file)
    {
        if (file_exists(filename: $file) && is_file($file)) {
            unlink($file); // Delete the file
        }
    }

    public static function limit($limit = 10)
    {
        return $limit;
    }

    public static function sendResponse($code = 200, $msg = null, $data = [])
    {
        $response = [
            'status' => $code,
            'msg'    => $msg,
            'data'   => $data,
        ];
        return response()->json($response, $code);
    }

    public static function pagination($itme, $Resource)
    {
        if (count($itme) > 0) {

            $data = [
                'rows'            => $Resource,
                'paginationLinks' => [
                    'currentPages' => $itme->currentPage(),
                    'perPage'      => $itme->lastpage(),
                    'total'        => $itme->total(),
                    'links'        => [
                        'first' => $itme->url(1),
                        'last'  => $itme->url($itme->lastpage()),
                    ],
                ],
            ];

            return HelperFunc::sendResponse(200, 'Success', $data);
        }
        return HelperFunc::sendResponse(200, 'No data found', []);
    }

}