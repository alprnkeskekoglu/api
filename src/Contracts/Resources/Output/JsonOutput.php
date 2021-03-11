<?php

namespace Dawnstar\Api\Contracts\Resources\Output;

class JsonOutput extends BaseOutput
{
    public function output(array $data)
    {
        $response = [
            'status' => true,
            'language' => dawnstar()->language->code,
            'data' => $data,
        ];

        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');
    }
}
