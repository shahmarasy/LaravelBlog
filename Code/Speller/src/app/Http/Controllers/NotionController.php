<?php

namespace App\Http\Controllers;

use AlbertCht\NotionAi\NotionAi;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotionController extends Controller
{
    private string $api = "v02%3Auser_token_or_cookies%3AZUBnyn8u1N3OKomoLRcl0m2DTA9QjzbLbqGDPkjKhWjhDI-7apfbhYS9OVg6BA00PFTkNkuT5HNS4rmfYJzB7W8bHfSwDawy5eAxtEYpGGzEl7_wkftY9B4rBGwPhM8gWpPE";

    public function fix(Request $request): JsonResponse
    {

        $notion = new NotionAi($this->api, '6a7ce389-6550-45d9-916a-bb5d60b8d4f6');
        $client = new Client();
        $notion->setClient($client);

        $text = array(
            "language" => $request->language,
            "text" => $request->text
        );
        $text = json_encode($text, JSON_UNESCAPED_UNICODE);
        $res = $notion->fixSpellingGrammar($text);
        $result = array(
            "text" => json_decode($res)->text
        );

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function hashtag(Request $request): JsonResponse
    {
        $notion = new NotionAi($this->api, '6a7ce389-6550-45d9-916a-bb5d60b8d4f6');
        $client = new Client();
        $notion->setClient($client);
        $Prompt = 'Bu metinden 8 adet hashtag önerisi ver: ';

        $res = $notion->helpMeWrite($Prompt,$request->text);
        $result = array(
            "text" => $res
        );

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);

    }


}
