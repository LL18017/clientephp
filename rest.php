<?php
function findRange($url, $start, $end) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . "?first=$start&max=$end");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Error en la solicitud cURL: ' . curl_error($ch);
        return null;
    }
    curl_close($ch);

    return json_decode($response, true);
}

function create($url, $registro) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $registro);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($registro)
    ]);

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($response === false) {
        echo 'Error en la solicitud cURL: ' . curl_error($ch);
        return ['status' => $statusCode, 'data' => null];
    }
    curl_close($ch);

    return ['status' => $statusCode, 'data' => json_decode($response, true)];
}

function update($url, $registro) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $registro);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($registro)
    ]);

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($response === false) {
        echo 'Error en la solicitud cURL: ' . curl_error($ch);
        return ['status' => $statusCode, 'data' => null];
    }
    curl_close($ch);

    return ['status' => $statusCode, 'data' => json_decode($response, true)];
}

function delete($url, $registro) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $registro);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($registro)
    ]);

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($response === false) {
        echo 'Error en la solicitud cURL: ' . curl_error($ch);
        return ['status' => $statusCode, 'data' => null];
    }
    curl_close($ch);

    return ['status' => $statusCode, 'data' => json_decode($response, true)];
}
?>
