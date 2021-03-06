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

    /**
     *
     * @param classes
     * @param classId
     */
    public static modifyClass(classes: Classes, classId: number): Promise<Response>
    {
        const data = `name=${classes.name}&trainer=${classes.trainer}&days=${classes.days}&schedule=${classes.schedule}&minAge=${classes.minAge}&maxAge=${classes.maxAge}&centerId=${classes.centerId}&classId=${classId}`;
        return Request.post('/class/modify', data);
    }
    /**
     * Deletes a class from the database
     * @param codClass
     */
    public static deleteClass(codClass): Promise<Response>
    {
        const data = `codClase=${codClass}`;
        return Request.post('/class/delete', data);
    }

    /**
     * Deletes a judoka from the class
     * @param judokaId
     */
    public static deleteJudokaFromClass(judokaId): Promise<Response>
    {
        const data = `judokaId=${judokaId}`;
        return Request.post('/class/deleteJudoka', data);
    }


    /**
     * Obtains a class from the database
     * @param codClass
     */
    public static classDetail(codClass): Promise<Response>
    {
        const data = `codClase=${codClass}`;
        return Request.post('/classDetail', data);
    }
}
