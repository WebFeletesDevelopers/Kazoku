import { Response } from "../util/Response";
import { User } from "./User";
import { Request } from "../util/Request";

export class UserRequest {
    /**
     * Create an user.
     * @param user
     */
    public static register(user: User): Promise<Response> {
        const data = `name=${user.name}&surname=${user.surname}&secondSurname=${user.secondSurname}` +
            `&username=${user.username}&phone=${user.phone}&email=${user.email}&password=${user.password}` +
            `&repeatPassword=${user.repeatedPassword}&rank=${user.rank}`;
        return Request.post('/xhr/user/register', data);
    }

    /**
     * Activate an user by a trainer.
     * @param userId
     */
    public static confirmByTrainer(userId: number): Promise<Response> {
        const data = `userId=${userId}`;
        return Request.post('/xhr/user/activatebytrainer', data);
    }

    /**
     * Delete an user by a trainer.
     * @param userId
     */
    public static deleteByTrainer(userId: number): Promise<Response> {
        const data = `userId=${userId}`;
        return Request.post('/xhr/user/deletebytrainer', data);
    }
}
