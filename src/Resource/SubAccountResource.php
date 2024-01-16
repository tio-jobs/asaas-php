<?php

namespace TioJobs\AsaasPhp\Resource;

use TioJobs\AsaasPhp\DataTransferObjects\SubAccounts\SubAccountDTO;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\CheckPendingDocuments;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\CreateSubAccount;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\DeleteUploadedDocument;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\GetUploadedDocument;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\ListSubAccounts;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\UpdateUploadedDocument;
use TioJobs\AsaasPhp\Endpoints\SubAccounts\UploadDocument;
use TioJobs\AsaasPhp\Enums\FileDocumentTypeEnum;

class SubAccountResource extends Resource
{
    /**
     * @return array<string, mixed>
     */
    public function checkPendingDocuments(): array
    {
        return $this->asaas->get(new CheckPendingDocuments());
    }

    /**
     * @return array<string, mixed>
     */
    public function create(SubAccountDTO $DTO): array
    {
        return $this->asaas->post(new CreateSubAccount($DTO));
    }

    /**
     * @return array<string, mixed>
     */
    public function deleteDocument(string $documentId): array
    {
        return $this->asaas->delete(new DeleteUploadedDocument($documentId));
    }

    /**
     * @return array<string, mixed>
     */
    public function getDocument(string $documentId): array
    {
        return $this->asaas->get(new GetUploadedDocument($documentId));
    }

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $this->asaas->get(new ListSubAccounts());
    }

    /**
     * @return array<string, mixed>
     */
    public function updateDocument(string $documentId, array $documentFile): array
    {
        return $this->asaas->put(new UpdateUploadedDocument($documentId, $documentFile));
    }

    /**
     * @return array<string, mixed>
     */
    public function uploadDocument(string $documentId, FileDocumentTypeEnum $type, array $documentFile): array
    {
        return $this->asaas->upload(new UploadDocument($documentId, $type, $documentFile));
    }
}
