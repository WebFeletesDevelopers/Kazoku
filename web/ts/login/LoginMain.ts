import {Login} from "./Login";
import {LoginRequest} from "./LoginRequest";
import {Cookie} from "../util/Cookie";

export class LoginMain {
    public static handle(): void {
        const isLoginPage: boolean = !! document.querySelector('[data-action="login"]');

        if (isLoginPage) {
            LoginMain.handleLoginForm();
        }
    }

    private static handleLoginForm(): void {
        const formElement: HTMLFormElement = document.querySelector('div.login-form form');
        const userElement: HTMLInputElement = formElement.querySelector('input[name="username"]');
        const passwordElement: HTMLInputElement = formElement.querySelector('input[name="password"]');
        const loginButton: HTMLButtonElement = formElement.querySelector('button');

        const loginData: Login = new Login(
            userElement.value,
            passwordElement.value
        );

        userElement.addEventListener('keyup', () => {
            loginData.username = userElement.value;
        });
        passwordElement.addEventListener('keyup', () => {
            loginData.password = passwordElement.value;
        })

        loginButton.addEventListener('click', e => {
            e.preventDefault();
            LoginMain.login(loginData);
        });
    }

    private static login(loginData: Login) {
        LoginRequest.getLoginHash(loginData).then(res => {
            if (res.statusCode === 200) {
                const hash = res.message['hash']
                Cookie.set('hash', hash);
                document.location.replace('/');
            }
        });
    }
}
