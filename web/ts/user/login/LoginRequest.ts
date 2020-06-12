import { Login } from "./Login";
import { Response } from "../../util/Response";
import { Request } from "../../util/Request";

export class LoginRequest {
    public static getLoginHash(loginData: Login): Promise<Response> {
        const data = `username=${loginData.username}&password=${loginData.password}`;
        return Request.post('/user/hash/get', data);
    }
}
