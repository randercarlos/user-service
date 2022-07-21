<?php

namespace UserServicePackage;

use Illuminate\Support\Facades\Http;

abstract class ApiService {
    protected string $endpoint;

    public function request($method, $path, $data = []) {

        try {
            $response = Http::acceptJson()
                ->retry(2, 100)
                ->withToken(request()->cookie('jwt') ?? request()->bearerToken() ?? null)
                ->$method("{$this->endpoint}/{$path}", $data);

//            abort_if($response->failed(), $response->status(), optional($response->json())['message']);

            return $response->json();
        } catch(\Throwable $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }

    public function post($path, $data) {
        return $this->request('post', $path, $data);
    }

    public function get($path) {
        return $this->request('get', $path);
    }

    public function put($path, $data) {
        return $this->request('put', $path, $data);
    }

    public function delete($path) {
        return $this->request('delete', $path);
    }

    public function patch($path, $data) {
        return $this->request('patch', $path, $data);
    }
}
