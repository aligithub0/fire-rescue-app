<?php
/**
 * AI Severity Prediction client.
 *
 * Thin helper used by storeimage.php to talk to the local Python service
 * (python-ai/app.py) and to map a predicted severity onto a recommended
 * number of fire engines.
 *
 * The whole feature is best-effort: if the service is down or returns an
 * error, ai_predict_severity() returns null and the complaint is still saved
 * with severity = 'unknown'.
 */

// Where the Python Flask service listens.
if (!defined('AI_SEVERITY_URL')) {
    define('AI_SEVERITY_URL', 'http://127.0.0.1:5000/predict');
}

/**
 * Ask the AI service to analyse an uploaded image.
 *
 * @param string $fileName  File name inside the project's upload/ folder.
 * @return array|null        Prediction array on success, null on any failure.
 */
function ai_predict_severity($fileName)
{
    $payload = json_encode(['filename' => $fileName]);

    $ch = curl_init(AI_SEVERITY_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_CONNECTTIMEOUT => 3,   // fail fast if the service isn't running
        CURLOPT_TIMEOUT        => 15,  // allow time for analysis
    ]);

    $response  = curl_exec($ch);
    $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false || $httpCode !== 200) {
        return null;
    }

    $data = json_decode($response, true);
    if (!is_array($data) || ($data['status'] ?? '') !== 'done') {
        return null;
    }

    return $data;
}

/**
 * Map a severity level to a recommended number of fire engines.
 * This mapping is deterministic and owned by PHP (not the AI), so the
 * dispatch recommendation is always predictable.
 *
 * @param string|null $severity  One of High / Medium / Low / None / unknown.
 * @return int                    Recommended engine count.
 */
function recommend_engines($severity)
{
    switch ($severity) {
        case 'High':   return 4;   // 3-4 engines + backup crew
        case 'Medium': return 2;   // 2 engines + tanker
        case 'Low':    return 1;   // 1 engine
        default:       return 0;   // None / unknown -> dispatcher decides
    }
}

/**
 * Bootstrap contextual colour for a severity level (used for badges/alerts).
 *
 * @param string|null $severity
 * @return string  One of: danger / warning / success / secondary.
 */
function severity_badge_class($severity)
{
    switch ($severity) {
        case 'High':   return 'danger';
        case 'Medium': return 'warning';
        case 'Low':    return 'success';
        default:       return 'secondary';  // None / unknown
    }
}
