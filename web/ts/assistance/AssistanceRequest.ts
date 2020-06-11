import { Request } from "../util/Request";
import { Assistance } from "./Assistance";
import { Response } from "../util/Response";

export class AssistanceRequest {
    /**
     * Add an assistance to the database
     * @param assistance
     */
    public static send(assistance: Assistance): Promise<Response> {
        const data = `userId=${assistance.userId}&classId=${assistance.classId}&date=${assistance.date}`;
        return Request.post('/assistance/send', data);
    }
}
