<?php

namespace TioJobs\AsaasPhp\Endpoints\Charges\Pix;

use Illuminate\Support\Facades\Http;
use TioJobs\AsaasPhp\Concerns\HasClient;
use TioJobs\AsaasPhp\Concerns\HasMode;
use TioJobs\AsaasPhp\Concerns\HasToken;
use TioJobs\AsaasPhp\Contracts\Core\AsaasChargeInterface;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO;

class ChargeByDynamicPix implements AsaasChargeInterface
{
    use HasMode;
    use HasToken;

    public function __construct(
        public readonly string $apiKey,
        protected DynamicPixDTO $dynamicPixDTO,
    ) {
    }

    public function getPath(): string
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        return "{$endpoint}/payments";
    }

    /** @return array<string,mixed> */
    public function getData(): array
    {
        return [
            "customer" => $this->dynamicPixDTO->customerId,
            "billingType" => $this->dynamicPixDTO->billingType->value,
            "value" => $this->dynamicPixDTO->value,
            "dueDate" => $this->dynamicPixDTO->dueDate,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getPixPaymentData(array $response): array
    {
        $endpoint = config("asaas-php.mode.{$this->getMode()}.url");
        assert(is_string($endpoint));

        $response = Http::withHeader('access_token', $this->getToken())
        ->get("{$endpoint}/payments/{$response['id']}/pixQrCode")
        ->json();
        assert(is_array($response));

        if (!isset($response['success']) || $response['success'] !== true) {
            return [
                'success' => 'false',
                'message' => "There was an error obtaining the QRCode. Try again using the direct link with the PIX_ID: {$response['id']}",
            ];
        }

        return [
            'encoded_image' => $response['encodedImage'],
            'copy_paste_link' => $response['payload'],
            'expiration_date' => $response['expirationDate'],
        ];
    }
}
