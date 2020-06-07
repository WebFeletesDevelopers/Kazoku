<?php

namespace WebFeletesDevelopers\Kazoku\Service\Mail;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Entity\Verification;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailArguments;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailUseCase;
use WebFeletesDevelopers\MailSail\Domain\EmailServer\BaseEmailServer;
use WebFeletesDevelopers\MailSail\Domain\EmailServer\CustomEmailServer;
use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;
use WebFeletesDevelopers\MailSail\Infrastructure\Email\PHPMailerEmailService;
use WebFeletesDevelopers\MailSail\Infrastructure\Logger\NullLogger;

class SendMailService
{
    private SendEmailUseCase $useCase;
    private BaseEmailServer $emailServer;

    public function __construct() {
        $this->emailServer = new CustomEmailServer(
            'smtp.dondominio.com',
            587,
            new SMTPLoginData(getenv('KAZOKU_MAIL_USER'), getenv('KAZOKU_MAIL_PASSWORD')),
            'tls'
        );
        $mailer = new PHPMailerEmailService(
            new PHPMailer(),
            new NullLogger()
        );
        $this->useCase = new SendEmailUseCase(
            $mailer
        );
    }

    /**
     * @param User $user
     * @param Verification $verification
     * @return bool
     * @throws Exception
     */
    public function sendRegisterMail(User $user, Verification $verification): bool {
        $preBody = _('<p>Bienvenido al club Kazoku, para confirmar su cuenta haga click <a href="%s">aquí</a>.<br />'
            . 'Si el enlace anterior no funciona, use este vínculo: <a href="%s">%s</a></p>');
        $body = sprintf($preBody, 'https://www.google.es', 'https://www.google.es', 'https://www.google.es');

        $arguments = new SendEmailArguments(
            getenv('KAZOKU_MAIL_USER'),
            $user->email(),
            _('Bienvenido al club Kazoku'),
            $body,
            $this->emailServer
        );

        $response = $this->useCase->handle($arguments);

        if ($error = $response->error()) {
            throw $error;
        }
        return $response->success();
    }
}
