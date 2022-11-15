<?php

namespace App\Services;

use SendinBlue\Client\ApiException;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailAttachment;
use SendinBlue\Client\Model\SendSmtpEmailSender;

class Sendinblue
{

    /**
     * @param int $templateId
     * @param array $to
     * @param object $params
     * @param string|null $attachmentContent
     * @return void
     * @throws ApiException
     */
    public static function send(int $templateId,array $to,object $params,string $attachmentContent = null): void
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', ENV('SENDINBLUE'));
        $apiInstance = new \SendinBlue\Client\Api\TransactionalEmailsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail["sender"] = new SendSmtpEmailSender(["name"=>env("SENDINBLUE_NAME"), "email"=>env("SENDINBLUE_EMAIL")]);
        $sendSmtpEmail["to"] = [new \SendinBlue\Client\Model\SendSmtpEmailTo($to)];
        $sendSmtpEmail["templateId"] = $templateId;
        $sendSmtpEmail["params"] = $params;
        if($attachmentContent !== null){
            //$attachment = new SendSmtpEmailAttachment();
            $attachment['name'] = "rapport.pdf";
            $attachment['content'] = $attachmentContent;
            //$attachmentParams = array("content" => $attachmentContent, "name" => "rapport.pdf");
            $sendSmtpEmail["attachment"] = array($attachment);
        }

        $sendSmtpEmail["replyTo"] = new \SendinBlue\Client\Model\SendSmtpEmailReplyTo(["email"=> env("SENDINBLUE_EMAIL")]);
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    }

}
