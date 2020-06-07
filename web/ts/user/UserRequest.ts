import { Response } from "../util/Response";
import { User } from "./User";
import { Request } from "../util/Request";

export class UserRequest {
    public static register(user: User): Promise<Response> {
        const data = `name=${user.name}&surname=${user.surname}&secondSurname=${user.secondSurname}` +
            `&username=${user.username}&phone=${user.phone}&email=${user.email}&password=${user.password}` +
            `&repeatPassword=${user.repeatedPassword}&rank=${user.rank}`;
        return Request.post('/xhr/user/register', data);
    }
}
