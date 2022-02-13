<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;

class PaymentController extends ApiController
{

    /**
     * @throws JsonException
     */
    public function store(): JsonResponse
    {
        $api = $_ENV['API_KEY'];
        $amount = "10000";
        $mobile = "شماره موبایل";
        $factorNumber = "شماره فاکتور";
        $description = "توضیحات";
        $redirect = $_ENV['CALLBACK_URL'];
        $result = $this->sendRequest($api, $amount, $redirect, $mobile, $factorNumber, $description);
        $result = json_decode($result, false, 512, JSON_THROW_ON_ERROR);
        if ($result->status) {
            $go = "https://pay.ir/pg/$result->token";
            return $this->successResponse(200, ['url' => $go,]);
        }
        // for error to payment
        return $this->errorResponse(422, $result->errorMessage);
    }

    /**
     * @throws JsonException
     */
    public function sendRequest($api, $amount, $redirect, $mobile = null, $factorNumber = null, $description = null)
    {
        return $this->curl_post('https://pay.ir/pg/send', [
            'api' => $api,
            'amount' => $amount,
            'redirect' => $redirect,
            'mobile' => $mobile,
            'factorNumber' => $factorNumber,
            'description' => $description,
        ]);
    }

    /**
     * @throws JsonException
     */
    public function verifyRequest($api, $token)
    {
        return $this->curl_post('https://pay.ir/pg/verify', [
            'api' => $api,
            'token' => $token,
        ]);
    }

    /**
     * @throws JsonException
     */
    public function verify(Request $request): JsonResponse
    {
        // $api = $_ENV['API_KEY'];
        $api = "test";
        $token = $request->get('token');
        $result = json_decode($this->verifyRequest($api, $token), false, 512, JSON_THROW_ON_ERROR);
        // return response()->json($result);
        // response()->json($result);
        if (isset($result->status)) {
            if ((int)$result->status === 1) {
                return $this->successResponse(200, response()->json($result), "تراکنش با موفقیت انجام شد");
                // echo "<h1>تراکنش با موفقیت انجام شد</h1>";
            }
            // for error to payment
            return $this->errorResponse(422, "<h1>تراکنش با خطا مواجه شد</h1>");
            // echo "<h1>تراکنش با خطا مواجه شد</h1>";
        }
        /** @noinspection PhpIfWithCommonPartsInspection */
        if ((int)$_GET['status'] === 0) {
            return $this->errorResponse(422, "<h1>تراکنش با خطا مواجه شد</h1>");
            // echo "<h1>تراکنش با خطا مواجه شد</h1>";
        }
        return $this->errorResponse(422, "<h1>تراکنش با خطا مواجه شد</h1>");
    }

    /** @noinspection PhpComposerExtensionStubsInspection
     * @noinspection CurlSslServerSpoofingInspection
     * @throws JsonException
     */
    public function curl_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, JSON_THROW_ON_ERROR));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

}
