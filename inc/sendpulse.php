<?php
namespace GlpiPlugin\Tiao;

class Sendpulse {
    private $apiUserId;
    private $apiSecret;

    public function __construct($userId, $secret) {
        $this->apiUserId = $userId;
        $this->apiSecret = $secret;
    }

    /**
     * Send message via SendPulse API
     */
    public function sendMessage($phone, $message) {
        // TODO: Implement OAuth and cURL request to SendPulse
        return ['status' => 'stub'];
    }
}
