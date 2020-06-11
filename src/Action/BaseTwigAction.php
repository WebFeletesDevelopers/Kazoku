<?php

namespace WebFeletesDevelopers\Kazoku\Action;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig_Extensions_Extension_I18n;
use WebFeletesDevelopers\Kazoku\Model\ConnectionHelper;
use WebFeletesDevelopers\Kazoku\Model\Entity\User;
use WebFeletesDevelopers\Kazoku\Model\Exception\InvalidHashException;
use WebFeletesDevelopers\Kazoku\Model\Exception\QueryException;
use WebFeletesDevelopers\Kazoku\Model\UserModel;

/**
 * Class BaseTwigAction
 * @package WebFeletesDevelopers\Kazoku\Action
 */
abstract class BaseTwigAction
{
    private Environment $twig;
    protected ?User $loggedUser = null;

    /**
     * BaseTwigAction constructor.
     * This class is used to reduce boilerplate code in Twig actions.
     * @throws QueryException
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $this->twig = new Environment($loader);
        $this->twig->addExtension(new Twig_Extensions_Extension_I18n());
        //fixme esto es una ñapa
        $userModel = new UserModel(ConnectionHelper::getConnection());
        $this->loggedUser = $this->validateUserSession($userModel);

    }

    /**
     * Render a Twig template, automatically adding the extension for ease of use.
     * @param string $template
     * @param array $config
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function render(string $template, array $config = []): string
    {
        $template .= '.twig';
        $config = array_merge(['user' => $this->loggedUser], $config);
        return $this->twig->render($template, $config);
    }

    /**
     * @param UserModel $userModel
     * @return User|null
     * @throws QueryException
     */
    protected function validateUserSession(UserModel $userModel): ?User
    {
        $hash = $_COOKIE['hash'] ?? null;
        try {
            return $hash
                ? $userModel->findByHash($hash)
                : null;
        } catch (InvalidHashException $e) {
            setcookie('hash', null, -1);
            header('Location: /');
            die;
        }
    }

        /**
         * Gets the profile photo's url
         * @param User $loggedInUser
         * @return String|null
         */
    protected function getProfilePic(?User $loggedInUser): ?String
    {
        if($loggedInUser !== null) {
            $filename1 = '/img/profile/' . $loggedInUser->id() . '.jpg';
            $filename2 = '/img/profile/' . $loggedInUser->id() . '.jpg';
            $generic = "/img/profile/generic.png";

            if (file_exists($filename1)) {
                $fileRoute = $filename1;
            } elseif (file_exists($filename2)) {
                $fileRoute = $filename2;
            } else {
                $fileRoute = $generic;
            }
        } else {
            $generic = "/img/profile/generic.png";
            $fileRoute = $generic;
        }
        return $fileRoute;
    }

    /**
     * Get's the profile photo from the user but parsing only it's id
     * @param int|null $userId
     * @return String|null
     */
    protected function getProfilePicById(?int $userId): ?String
    {
        if($userId !== null) {
            $filename1 = '/img/profile' . $userId . '.jpg';
            $filename2 = '/img/profile' . $userId . '.jpg';
            $generic = "/img/profile/generic.png";

            if (file_exists($filename1)) {
                $fileRoute = $filename1;
            } elseif (file_exists($filename2)) {
                $fileRoute = $filename2;
            } else {
                $fileRoute = $generic;
            }
        } else {
            $generic = "/img/profile/generic.png";
            $fileRoute = $generic;
        }
        return $fileRoute;
    }
}
