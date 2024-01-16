<?php

namespace TioJobs\AsaasPhp\Resource;

use TioJobs\AsaasPhp\DataTransferObjects\Charges\Billet\DirectBilletDTO;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\DirectCreditCardDTO;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\CreditCard\PartialCreditCardDTO;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\DynamicPixDTO;
use TioJobs\AsaasPhp\DataTransferObjects\Charges\Pix\StaticPixDTO;
use TioJobs\AsaasPhp\Endpoints\Charges\Billet\DirectChargeByBillet;
use TioJobs\AsaasPhp\Endpoints\Charges\CreditCard\DirectChargeByCreditCard;
use TioJobs\AsaasPhp\Endpoints\Charges\CreditCard\PartialChargeByCreditCard;
use TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeByDynamicPix;
use TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeByStaticPix;
use TioJobs\AsaasPhp\Endpoints\Charges\Pix\ChargeQrCodePix;
use TioJobs\AsaasPhp\Endpoints\Charges\Resources\DeleteCharge;
use TioJobs\AsaasPhp\Endpoints\Charges\Resources\DeleteUploadedChargeDocument;
use TioJobs\AsaasPhp\Endpoints\Charges\Resources\ListAllCharges;
use TioJobs\AsaasPhp\Endpoints\Charges\Resources\UpdateCharge;
use TioJobs\AsaasPhp\Endpoints\Charges\Resources\UploadChargeDocument;

class ChargeResource extends Resource
{
    /**
     * @return array<string, mixed>
     */
    public function directByBillet(DirectBilletDTO $DTO): array
    {
        return $this->asaas->post(new DirectChargeByBillet($DTO));
    }

    /**
     * @return array<string, mixed>
     */
    public function directByCreditCard(DirectCreditCardDTO $DTO): array
    {
        return $this->asaas->post(new DirectChargeByCreditCard($DTO));
    }

    /**
     * @return array<string, mixed>
     */
    public function partialCreditCard(PartialCreditCardDTO $DTO): array
    {
        return $this->asaas->post(new PartialChargeByCreditCard($DTO));
    }

    /**
     * @return array<string, mixed>
     */
    public function pixStatic(StaticPixDTO $DTO): array
    {
        return $this->asaas->post(new ChargeByStaticPix($DTO));
    }

    /**
     * @return array<string, mixed>
     */
    public function delete(string $id): array
    {
        return $this->asaas->delete(new DeleteCharge($id));
    }

    /**
     * @return array<string, mixed>
     */
    public function deleteDocument(string $id, string $document): array
    {
        return $this->asaas->delete(new DeleteUploadedChargeDocument($id, $document));
    }

    /**
     * @return array<string, mixed>
     */
    public function all(int $limit = 10, int $offset = 0): array
    {
        return $this->asaas->get(new ListAllCharges($limit, $offset));
    }

    /**
     * @return array<string, mixed>
     */
    public function update(string $id, array $data): array
    {
        return $this->asaas->post(new UpdateCharge($id, $data));
    }

    /**
     * @return array<string, mixed>
     */
    public function upload(string $id, array $data): array
    {
        return $this->asaas->upload(new UploadChargeDocument($id, $data));
    }

    /**
     * @return array<string, mixed>
     */
    public function pixDynamic(DynamicPixDTO $DTO): array
    {
        $pix = $this->asaas->post(new ChargeByDynamicPix($DTO));

        if (! isset($pix['id'])) {
            return [
                'success' => 'false',
                'message' => 'There was an error creating the PIX',
            ];
        }

        $response = $this->asaas->get(new ChargeQrCodePix($pix['id'])); //@phpstan-ignore-line

        if (! isset($response['success']) || $response['success'] !== true) {
            return [
                'success' => 'false',
                'message' => 'There was an error obtaining the QRCode',
            ];
        }

        return [
            'encoded_image' => $response['encodedImage'],
            'copy_paste_link' => $response['payload'],
            'expiration_date' => $response['expirationDate'],
        ];
    }

    /**
     * @param array<string,string> $response
     * @return string
     */
    public function getBilletUrl(array $response): string
    {
        return $response['bankSlipUrl'] ?? '';
    }
}
