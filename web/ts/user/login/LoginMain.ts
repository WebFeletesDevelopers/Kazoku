import { Login } from "./Login";
import { LoginRequest } from "./LoginRequest";
import { Cookie } from "../../util/Cookie";

export class LoginMain {
    public static handle(): void {
        const isLoginPage: boolean = !! document.querySelector('[data-action="login"]');

        if (isLoginPage) {
            LoginMain.handleLoginForm();
        }
    }

    private static handleLoginForm(): void {
        const loginContainer: HTMLDivElement = document.querySelector('div.login-form')
        const formElement: HTMLFormElement = loginContainer.querySelector('form');
        const userElement: HTMLInputElement = formElement.querySelector('input[name="username"]');
        const passwordElement: HTMLInputElement = formElement.querySelector('input[name="password"]');
        const loginButton: HTMLButtonElement = formElement.querySelector('button');

        const loginData: Login = new Login(
            userElement.value,
            passwordElement.value
        );

        loginContainer.addEventListener('animationend', e => {
            (e.target as HTMLDivElement).classList.remove('animate');
        });

        userElement.addEventListener('keyup', () => {
            loginData.username = userElement.value;
            loginContainer.classList.remove('kazoku-error-shadow');
        });
        passwordElement.addEventListener('keyup', () => {
            loginData.password = passwordElement.value;
            loginContainer.classList.remove('kazoku-error-shadow');
        })

        loginButton.addEventListener('click', e => {
            e.preventDefault();
            (e.target as HTMLButtonElement).disabled = true;
            LoginMain.login(loginData, loginContainer, loginButton);
        });
    }

    private static login(
        loginData: Login,
        loginContainer: HTMLDivElement,
        loginButton: HTMLButtonElement
    ) {
        LoginRequest.getLoginHash(loginData).then(res => {
            if (res.statusCode === 200) {
                const hash = res.message['hash']
                Cookie.set('hash', hash);
                document.location.replace('/');
            } else {
                loginContainer.classList.add('kazoku-error-shadow', 'animate');
            }
            loginButton.disabled = false;
        });
    }
}
