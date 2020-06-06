import { Request } from "../util/Request";
import { Classes } from "./Classes";
import { Response } from "../util/Response";

export class ClassRequest {
    /**
     * Add a new to the database
     * @param classes
     */
    public static addClass(classes: Classes): Promise<Response>
    {
        const data = `name=${classes.name}&trainer=${classes.trainer}&days=${classes.days}&schedule=${classes.schedule}&minAge=${classes.minAge}&maxAge=${classes.maxAge}&centerId=${classes.centerId}`;
        return Request.post('/class/add', data);
    }
    public static deleteClass(codClass): Promise<Response>
    {
        const data = `codClase=${codClass}`;
        return Request.post('/class/delete', data);
    }
}
