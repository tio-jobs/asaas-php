<?php

test('restore a deleted customer', function () {
    // Found the first user
    $asaas = asaasPhp()->customer();

    $responseList = $asaas->list();
    $data = $responseList['data'][0] ?? [];



    $response = $asaas->delete($data['id']);

    expect(json_encode($response))
        ->json()
        ->deleted->toBeTrue()
        ->id->toBe($data['id']);


    $restoredResponse = $asaas->restore($response['id']);

    expect(json_encode($restoredResponse))
        ->json()
        ->object->toBe('customer')
        ->deleted->toBeFalse();
})->onlyWithSandboxApi();
