import { Request } from "../util/Request";
import { Center } from "./Center";
import { Response } from "../util/Response";

export class CenterRequest {
    /**
     * Add a center to the database
     * @param center
     */
    public static addCenter(center: Center): Promise<Response>
    {
        const data = `name=${center.name}&direction=${center.direction}&zip=${center.zip}&phone=${center.phone}`;
        return Request.post('/center/add', data);
    }
    public static deleteCenter(codCenter): Promise<Response>
    {
        const data = `centerId=${codCenter}`;
        return Request.post('/center/delete', data);
    }
}
