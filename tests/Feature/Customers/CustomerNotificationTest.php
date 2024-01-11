<?php

test('check customer notifications', function () {

    $asaas= asaasPhp()->customer();

    $responseList = $asaas->list();
    $data = $responseList['data'][0] ?? [];

    $response = $asaas->notifications($data['id']);
    $notification = $response['data'][0] ?? [];

    expect(json_encode($response))
        ->json()
        ->object->toBe('list')
        ->and(json_encode($notification))
        ->json()
        ->object->toBe('notification')
        ->customer->toBe($data['id']);

});
